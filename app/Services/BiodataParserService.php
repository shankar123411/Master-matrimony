<?php

namespace App\Services;

class BiodataParserService
{
    /**
     * Tamil text normalization (preserves standard Unicode logical order)
     */
    public static function normalizeTamilVisualOrder(string $text): string
    {
        if (empty($text)) return '';

        // Map null bytes after Tamil consonants to vowel sign "i" (\x{0BBF}) and strip stray nulls
        $text = preg_replace('/([\x{0B85}-\x{0BB9}])\x00+/u', '$1' . "\xE0\xAE\xBF", $text);
        $text = str_replace(["\x00", "\xE2\x97\x8C", "\xEF\xBB\xBF"], '', $text);
        $text = preg_replace('/(^|[\s\t])[\x{0BBE}-\x{0BCD}\x{0BD7}]+/u', '$1', $text);

        // 1. Two-part vowels in visual order (at start of syllable or space):
        // ெ + consonant + ா -> consonant + ொ (\x{0BCA})
        $text = preg_replace('/(^|[\s\t])\x{0BC6}[\s\t]*([\x{0B95}-\x{0BB9}])[\s\t]*\x{0BBE}/u', '$1$2' . "\u{0BCA}", $text);
        // ே + consonant + ா -> consonant + ோ (\x{0BCB})
        $text = preg_replace('/(^|[\s\t])\x{0BC7}[\s\t]*([\x{0B95}-\x{0BB9}])[\s\t]*\x{0BBE}/u', '$1$2' . "\u{0BCB}", $text);
        // ெ + consonant + ௗ -> consonant + ௌ (\x{0BCC})
        $text = preg_replace('/(^|[\s\t])\x{0BC6}[\s\t]*([\x{0B95}-\x{0BB9}])[\s\t]*\x{0BD7}/u', '$1$2' . "\u{0BCC}", $text);

        // 2. Single pre-vowels: space/start + ெ, ே, ை before consonant
        $text = preg_replace('/(^|[\s\t])([\x{0BC6}\x{0BC7}\x{0BC8}])[\s\t]*([\x{0B95}-\x{0BB9}])/u', '$1$3$2', $text);

        // 3. Remove horizontal space between consonant and pulli/vowel-sign
        $text = preg_replace('/([\x{0B95}-\x{0BB9}])[\s\t]+([\x{0BBE}-\x{0BCD}\x{0BD7}])/u', '$1$2', $text);

        // 4. Deduplicate repeated vowel signs (e.g. \u0BBF\u0BBF -> \u0BBF)
        $text = preg_replace('/([\x{0BBE}-\x{0BCD}\x{0BD7}])\1+/u', '$1', $text);

        // 5. Safely normalize key Tamil phrases with internal spacing or OCR splits
        $phrases = [
            ['/எ\s*தி\s*்?\s*ர?\s*்?\s*ப\s*்?\s*ப\s*ா\s*்?\s*ர?\s*்?\s*ப\s*்?\s*ப\s*ு\s*க\s*ள\s*்?/u', 'எதிர்பார்ப்புகள்'],
            ['/உ\s*ற\s*வ\s*ி\s*ன\s*ர\s*்?\s*வ\s*ி\s*ப\s*ர\s*ம\s*்?/u', 'உறவினர் விபரம்'],
            ['/ச\s*க\s*ோ\s*த\s*ர\s*ர\s*்\s*க\s*ள\s*்/u', 'சகோதரர்கள்'],
            ['/ச\s*க\s*ோ\s*த\s*ர\s*ி\s*க\s*ள\s*்/u', 'சகோதரிகள்'],
            ['/உ\s*ட\s*ன\s*்\s*ப\s*ி\s*ற\s*ந\s*்\s*த\s*ோ\s*ர\s*்/u', 'உடன்பிறந்தோர்'],
            ['/ம\s*ற்\s*று\s*ம\s*்/u', 'மற்றும்'],
            ['/இ\s*த\s*ர\s*க\s*ு\s*ற\s*ி\s*ப\s*்\s*ப\s*ு\s*க\s*ள\s*்/u', 'இதர குறிப்புகள்'],
            ['/க\s*ு\s*ற\s*ி\s*ப\s*்\s*ப\s*ி\s*ட\s*வ\s*ு\s*ம\s*்/u', 'குறிப்பிடவும்'],
        ];
        foreach ($phrases as $p) {
            $text = preg_replace($p[0], $p[1], $text);
        }

        return $text;
    }

    /**
     * Splits multi-column PDF table lines into cleanly delimited single-field lines
     */
    public static function cleanMatrimonyMultiColumnText(string $text): string
    {
        if (empty($text)) return '';

        $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');

        // 1. Replace tabs and pipe delimiters with newlines
        $text = str_replace(["\t", "|"], "\n", $text);

        // 2. Fix compound labels broken across lines
        $text = preg_replace('/(குடும்ப\s*வருமானம்[\/\s]*)\s*[\r\n]+\s*(வசதிகள்)/ui', '$1$2', $text);
        $text = preg_replace('/(தந்தையின்|தாயின்|வரனின்)\s*[\r\n]+\s*(பணி|படிப்பு|பெயர்|வேலை|தொழில்)/ui', '$1 $2', $text);
        $text = preg_replace('/(மாத|குடும்ப)\s*[\r\n]+\s*(வருமானம்|வசதிகள்)/ui', '$1 $2', $text);
        $text = preg_replace('/(பிறந்த)\s*[\r\n]+\s*(தேதி|நேரம்|ஊர்)/ui', '$1 $2', $text);

        // 3. Known field labels
        $labels = [
            'வரன்\s*பெயர்', 'வரனின்\s*படிப்பு', 'படிப்பு', 'கல்வி', 'Education', 'Qualification',
            'வேலை\s*பணி', 'வேலை', 'பணி', 'தொழில்', 'Job', 'Occupation', 'Profession', 'Designation',
            'Company\s*Name\s*&\s*Location', 'Company\s*&\s*Town', 'Company\s*&\s*Location', 'Company\s*Name', 'Company', 'நிறுவனம்\s*பெயர்\s*&\s*ஊர்', 'நிறுவனம்\s*பெயர்', 'நிறுவனம்',
            'மாத\s*வருமானம்', 'வருமானம்', 'Income', 'Monthly\s*Income', 'Salary',
            'உயரம்', 'Height', 'எடை', 'Weight', 'நிறம்', 'Complexion', 'Color', 'Colour',
            'குலதெய்வம்[,\s]*ஊர்', 'குலதெய்வம்', 'Kuladeivam\s*&\s*Town', 'Kuladeivam',
            'கோத்திரம்', 'Gothram', 'கூட்டம்', 'Kootam', 'Clan',
            'தந்தை\s*பெயர்', 'Father\s*Name', 'தந்தையின்\s*பணி', 'தந்தை\s*பணி', 'Father\s*Job',
            'தாய்\s*பெயர்', 'Mother\s*Name', 'தாயின்\s*பணி', 'தாய்\s*பணி', 'Mother\s*Job',
            'அலைபேசி', 'கைபேசி', 'Mobile', 'Phone', 'Cell',
            'பூர்வீகம்', 'Native\s*Place', 'Native', 'முகவரி', 'Address',
            'குடும்ப\s*வருமானம்[\/\s]*வசதிகள்', 'குடும்ப\s*வருமானம்', 'வசதிகள்', 'Family\s*Wealth',
            'உடன்\s*பிறந்தோர்[,\s]*உறவினர்\s*விபரம்', 'உடன்\s*பிறந்தோர்', 'உடன்பிறந்தோர்', 'சகோதரர்கள்', 'சகோதரிகள்', 'Siblings',
            'ராசி', 'இராசி', 'Rasi', 'நட்சத்திரம்', 'நட்சத்திர', 'Star', 'Natchathiram',
            'லக்னம்', 'Lagnam', 'தோஷம்', 'தோஷ\s*விபரம்', 'Dosham',
            'திசை\s*இருப்பு', 'திசை', 'Dasa',
            'எதிர்ப்பார்ப்புகள்\s*மற்றும்\s*இதர\s*குறிப்புகள்\s*குறிப்பிடவும்', 'எதிர்ப்பார்ப்புகள்', 'எதிர்பார்ப்புகள்', 'இதர\s*குறிப்புகள்', 'Expectations',
            'பிறந்த\s*தேதி', 'DOB', 'பிறந்த\s*நேரம்', 'நேரம்', 'Time', 'பிறந்த\s*ஊர்', 'Place'
        ];

        usort($labels, function($a, $b) { return mb_strlen($b) - mb_strlen($a); });

        $pattern = '/(?<![\r\n])(?<!வரனின்\s)(?<!தந்தையின்\s)(?<!தாயின்\s)(?<!மாத\s)(?<!குடும்ப\s)(?<!பிறந்த\s)(?<!Native\s)(?<!Native)(?<!Birth\s)(' . implode('|', $labels) . ')\s*[:=–\-]/ui';
        $text = preg_replace($pattern, "\n$1:", $text);

        return $text;
    }

    /**
     * Powerful OCR Space Normalizer for Tamil text (collapses broken diacritics, spaces in keywords, and splits multi-column lines)
     */
    public static function normalizeTamilOcrText(string $text): string
    {
        if (empty($text)) return '';
        $s = str_replace(["\x00", "\x0B", "\r", "\xef\xbf\xbd", "\u{FFFD}"], '', $text);

        for ($k = 0; $k < 3; $k++) {
            $s = preg_replace('/([\x{0B85}-\x{0BB9}])\s+([\x{0BBE}-\x{0BCD}\x{0BD7}])/u', '$1$2', $s);
            $s = preg_replace('/([\x{0BBE}-\x{0BCD}\x{0BD7}])\s+([\x{0BCD}])/u', '$1$2', $s);
        }

        $knownWords = [
            'மீ\s*ன\s*ம்' => 'மீனம்',
            'மே\s*ஷ\s*ம்' => 'மேஷம்',
            'ரி\s*ஷ\s*ப\s*ம்' => 'ரிஷபம்',
            'மி\s*து\s*ன\s*ம்' => 'மிதுனம்',
            'க\s*ட\s*க\s*ம்' => 'கடகம்',
            'சி\s*ம்\s*ம\s*ம்' => 'சிம்மம்',
            'க\s*ன்\s*னி' => 'கன்னி',
            'து\s*லா\s*ம்' => 'துலாம்',
            'வி\s*ரு\s*ச்\s*சி\s*க\s*ம்' => 'விருச்சிகம்',
            'த\s*னு\s*சு' => 'தனுசு',
            'ம\s*க\s*ர\s*ம்' => 'மகரம்',
            'கு\s*ம்\s*ப\s*ம்' => 'கும்பம்',
            'ரா\s*சி' => 'ராசி',
            'ந\s*வா\s*ம்\s*ச\s*ம்' => 'நவாம்சம்',
            'ந\s*வா\s*ம்\s*சம்' => 'நவாம்சம்',
            'ல\s*க்\s*ன\s*ம்' => 'லக்னம்',
            'ல\s*க்' => 'லக்',
            'சூ\s*ரி\s*ய\s*ன்' => 'சூரியன்',
            'சூ\s*ரி' => 'சூரி',
            'ச\s*ந்\s*தி\s*ர\s*ன்' => 'சந்திரன்',
            'ச\s*ந்' => 'சந்',
            'செ\s*வ்\s*வா\s*ய்' => 'செவ்வாய்',
            'செ\s*வ்' => 'செவ்',
            'பு\s*த\s*ன்' => 'புதன்',
            'பு\s*த' => 'புத',
            'கு\s*ரு' => 'குரு',
            'சு\s*க்\s*கி\s*ர\s*ன்' => 'சுக்கிரன்',
            'சு\s*க்' => 'சுக்',
            'ச\s*னீ\s*ஸ்\s*வ\s*ர\s*ன்' => 'சனீஸ்வரன்',
            'ச\s*னி' => 'சனி',
            'ரா\s*கு' => 'ராகு',
            'கே\s*து' => 'கேது',
            'மா\s*ந்\s*தி' => 'மாந்தி',
            'மா\s*ந்' => 'மாந்',
            'வ\s*ர\s*ன்\s*பெ\s*ய\s*ர்' => 'வரன் பெயர்',
            'பெ\s*ய\s*ர்' => 'பெயர்',
            'பி\s*ற\s*ந்\s*த\s*தே\s*தி' => 'பிறந்த தேதி',
            'தே\s*தி' => 'தேதி',
            'நே\s*ர\s*ம்' => 'நேரம்',
            'பி\s*ற\s*ந்\s*த\s*ஊ\s*ர்' => 'பிறந்த ஊர்',
            'ப\s*டி\s*ப்\s*பு' => 'படிப்பு',
            'வே\s*லை' => 'வேலை',
            'தொ\s*ழி\s*ல்' => 'தொழில்',
            'ப\s*ணி' => 'பணி',
            'நி\s*று\s*வ\s*ன\s*ம்' => 'நிறுவனம்',
            'வ\s*ரு\s*மா\s*ன\s*ம்' => 'வருமானம்',
            'உ\s*ய\s*ர\s*ம்' => 'உயரம்',
            'எ\s*டை' => 'எடை',
            'நி\s*ற\s*ம்' => 'நிறம்',
            'கு\s*ல\s*தெ\s*ய்\s*வ\s*ம்' => 'குலதெய்வம்',
            'கோ\s*த்\s*தி\s*ர\s*ம்' => 'கோத்திரம்',
            'கூ\s*ட்\s*ட\s*ம்' => 'கூட்டம்',
            'த\s*ந்\s*தை\s*பெ\s*ய\s*ர்' => 'தந்தை பெயர்',
            'த\s*ந்\s*தை\s*வே\s*லை' => 'தந்தை வேலை',
            'த\s*ந்\s*தை\s*தொ\s*ழி\s*ல்' => 'தந்தை தொழில்',
            'த\s*ந்\s*தை\s*ப\s*ணி' => 'தந்தை பணி',
            'த\s*ந்\s*தை\s*ஊ\s*ர்' => 'தந்தை ஊர்',
            'தா\s*ய்\s*பெ\s*ய\s*ர்' => 'தாய் பெயர்',
            'தா\s*யா\s*ர்\s*பெ\s*ய\s*ர்' => 'தாயார் பெயர்',
            'தா\s*ய்\s*வே\s*லை' => 'தாய் வேலை',
            'தா\s*யா\s*ர்\s*வே\s*லை' => 'தாயார் வேலை',
            'தா\s*ய்\s*தொ\s*ழி\s*ல்' => 'தாய் தொழில்',
            'தா\s*யா\s*ர்\s*ப\s*ணி' => 'தாயார் பணி',
            'தா\s*ய்\s*ஊ\s*ர்' => 'தாய் ஊர்',
            'கை\s*பே\s*சி' => 'கைபேசி',
            'தொ\s*லை\s*பே\s*சி' => 'தொலைபேசி',
            'அ\s*லை\s*பே\s*சி' => 'அலைபேசி',
            'பூ\s*ர்\s*வீ\s*க\s*ம்' => 'பூர்வீகம்',
            'மு\s*க\s*வ\s*ரி' => 'முகவரி',
            'ந\s*ட்\s*ச\s*த்\s*தி\s*ர\s*ம்' => 'நட்சத்திரம்',
            'தோ\s*ஷ\s*ம்' => 'தோஷம்',
            'தி\s*சை\s*இ\s*ரு\s*ப்\s*பு' => 'திசை இருப்பு',
            'எ\s*தி\s*ர்\s*பா\s*ர்\s*ப்\s*பு' => 'எதிர்பார்ப்பு',
            'செ\s*ங்\s*கு\s*ந்\s*த\s*ர்' => 'செங்குந்தர்',
            'கை\s*க்\s*கோ\s*ள\s*ர்' => 'கைக்கோளர்',
            'சி\s*வ\s*ப்\s*பு' => 'சிவப்பு',
            'மா\s*நி\s*ற\s*ம்' => 'மாநிறம்',
            'க\s*ரு\s*ப்\s*பு' => 'கருப்பு',
            'அ\s*ட\s*ர்' => 'அடர்',
            'மு\s*த\s*ல்\s*ம\s*ண\s*ம்' => 'முதல் மணம்',
            'ம\s*று\s*ம\s*ண\s*ம்' => 'மறுமணம்',
            'சு\s*த்\s*த\s*ம்' => 'சுத்தம்'
        ];
        foreach ($knownWords as $pattern => $replacement) {
            $s = preg_replace('/' . $pattern . '/u', $replacement, $s);
        }

        $labels = 'வரன்\s*பெயர்|பெயர்|Name|மணமகன்\s*பெயர்|மணமகள்\s*பெயர்|பிறந்த\s*தேதி|தேதி|DOB|Date|நேரம்|பிறந்த\s*நேரம்|Time|பிறந்த\s*ஊர்|ஊர்|Place|படிப்பு|கல்வி|Education|வேலை|தொழில்|பணி|Job|நிறுவனம்\s*பெயர்\s*&\s*ஊர்|நிறுவனம்\s*பெயர்|நிறுவனம்|Company|மாத\s*வருமானம்|வருமானம்|Income|Salary|உயரம்|Height|எடை|Weight|நிறம்|Complexion|குலதெய்வம்\s*,\s*ஊர்|குலதெய்வம்|Kuladeivam|கோத்திரம்|Gothram|கூட்டம்|Kootam|தந்தை\s*பெயர்|Father\s*Name|தந்தை\s*வேலை|தந்தை\s*தொழில்|தந்தை\s*பணி|Father\s*Job|தந்தை\s*ஊர்|Father\s*Native|தாய்\s*பெயர்|Mother\s*Name|தாய்\s*வேலை|தாயார்\s*வேலை|Mother\s*Job|தாய்\s*ஊர்|Mother\s*Native|உடன்பிறந்தோர்|Siblings|சகோதரர்கள்|Brothers|சகோதரிகள்|Sisters|குடும்ப\s*வருமானம்|வசதிகள்|சொத்து|Family\s*Wealth|முகவரி|Address|கைபேசி|அலைபேசி|தொலைபேசி|Mobile|Phone|Cell|பூர்வீகம்|Native|ராசி|Rasi|நட்சத்திரம்|Star|லக்னம்|Lagnam|தோஷம்|Dosham|திசை\s*இருப்பு|Dasa\s*Balance';
        $s = preg_replace('/([^\r\n]+?)\s+(' . $labels . ')\s*[:=–\-\.·~]/ui', "$1\n$2:", $s);

        return $s;
    }

    /**
     * Comprehensive PDF OCR Tamil text normalizer (solves split glyphs, spaces inside words, and double viramas)
     */
    public static function normalizeTamilPdfText(string $text): string
    {
        if (empty($text)) return '';

        $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        $text = self::normalizeTamilOcrText($text);
        $text = self::normalizeTamilVisualOrder($text);

        $replacements = [
            '/ப\s*ற\s*ந்\s*த\s*ேத\s*(?:தி|த)(?:\s*[:=–\-])?/u' => 'பிறந்த தேதி: ',
            '/ப\s*ற\s*ந்\s*த\s*ஊர்(?:\s*[:=–\-])?/u' => 'பிறந்த ஊர்: ',
            '/ப\s*ற\s*ந்\s*த/u' => 'பிறந்த',
            '/ேத\s*(?:தி|த)(?:\s*[:=–\-])?/u' => 'தேதி: ',
            '/ேந\s*ரம்(?:\s*[:=–\-])?/u' => 'நேரம்: ',
            '/ேவ\s*ைல(?:\s*[:=–\-])?/u' => 'வேலை: ',
            '/எ\s*ைட(?:\s*[:=–\-])?/u' => 'எடை: ',
            '/(?:நி\s*றம்|ந\s*றம்)(?:\s*[:=–\-])?/u' => 'நிறம்: ',
            '/அ\s*ைல\s*ேப\s*(?:சி|ச)(?:\s*[:=–\-])?/u' => 'அலைபேசி: ',
            '/ேகா\s*த்\s*(?:தி|த)\s*ரம்(?:\s*[:=–\-])?/u' => 'கோத்திரம்: ',
            '/கூ\s*ட்\s*டம்\s*[:=–\-]/u' => 'கூட்டம்: ',
            '/கூ\s*ட்\s*ட\s*ம்/u' => 'கூட்டம்',
            '/(?:^|[\r\n\s\t])(?:இ\s*ரா\s*சி|ரா\s*சி|ரா\s*ச)\s*[:=–\-]/u' => "\nராசி: ",
            '/நட்\s*சத்\s*(?:தி|த)\s*ரம்(?:\s*[:=–\-])?/u' => 'நட்சத்திரம்: ',
            '/த\s*ருப்\s*பூர்/u' => 'திருப்பூர்',
            '/(?:சி|ச)\s*வப்\s*பு/u' => 'சிவப்பு',
            '/வ\s*வ\s*சா\s*யம்/u' => 'விவசாயம்',
            '/இல்\s*லத்\s*தர\s*(?:சி|ச)(?:\s*[:=–\-])?/u' => 'இல்லத்தரசி',
            '/வச\s*(?:தி|த)\s*கள்/u' => 'வசதிகள்',
            '/உற\s*வ\s*னர்/u' => 'உறவினர்',
            '/வ\s*பரம்/u' => 'விபரம்',
            '/தந்\s*ைத\s*ய\s*ன்\s*ப\s*ணி(?:\s*[:=–\-])?/u' => 'தந்தை பணி: ',
            '/தந்\s*ைத\s*ெப\s*யர்(?:\s*[:=–\-])?/u' => 'தந்தை பெயர்: ',
            '/தா\s*ய\s*ன்\s*ப\s*ணி(?:\s*[:=–\-])?/u' => 'தாய் பணி: ',
            '/தா\s*ய்\s*ெப\s*யர்(?:\s*[:=–\-])?/u' => 'தாய் பெயர்: ',
            '/வர\s*னி\s*ன்\s*படிப்\s*பு(?:\s*[:=–\-])?/u' => 'வரனின் படிப்பு: ',
            '/வரன்\s*ெப\s*யர்(?:\s*[:=–\-])?/u' => 'வரன் பெயர்: ',
            '/ந\s*றுவனம்\s*ெப\s*யர்\s*&\s*ஊர்(?:\s*[:=–\-])?/u' => 'நிறுவனம் பெயர் & ஊர்: ',
            '/மா\s*த\s*வரு\s*மா\s*னம்(?:\s*[:=–\-])?/u' => 'மாத வருமானம்: ',
            '/குல\s*ெத\s*ய்\s*வம்\s*,\s*ஊர்(?:\s*[:=–\-])?/u' => 'குலதெய்வம் & ஊர்: ',
            '/பூர்வீ\s*கம்(?:\s*[:=–\-])?/u' => 'பூர்வீகம்: ',
            '/முகவ\s*ரி(?:\s*[:=–\-])?/u' => 'முகவரி: ',
            '/குடும்\s*ப\s*வரு\s*மா\s*னம்\s*\/\s*வச\s*(?:தி|த)\s*கள்(?:\s*[:=–\-])?/u' => 'குடும்ப வருமானம் / வசதிகள்: ',
            '/உடன்\s*ப\s*ற\s*ந்\s*ேதா\s*ர்\s*,\s*உற\s*வ\s*னர்\s*வ\s*பரம்(?:\s*[:=–\-])?/u' => 'உடன்பிறந்தோர்: ',
            '/பெ\s*ய\s*ர்(?:\s*:\s*ர்)?/u' => 'பெயர்: ',
            '/தா\s*ய்/u' => 'தாய்',
            '/த\s*ந்\s*தை/u' => 'தந்தை',
            '/அ\s*லை\s*பே\s*சி/u' => 'அலைபேசி',
            '/பூ\s*ர்\s*வீ\s*ர்?\s*க\s*ம்/u' => 'பூர்வீகம்',
            '/த\s*ந்\s*தை\s*(?:யின்)?\s*ப\s*ணி/u' => 'தந்தையின் பணி',
            '/தா\s*(?:ய்|யின்)?\s*ப\s*ணி/u' => 'தாயின் பணி',
            '/த\s*ந்\s*தை\s*பெ\s*ய\s*ர்/u' => 'தந்தை பெயர்',
            '/தா\s*ய்\s*பெ\s*ய\s*ர்/u' => 'தாய் பெயர்',
            '/தே\s*தி/u' => 'தேதி',
            '/நே\s*ர\s*ம்/u' => 'நேரம்',
            '/பி\s*ற\s*ந்\s*த\s*ஊ\s*ர்/u' => 'பிறந்த ஊர்',
            '/பி\s*ற\s*ந்\s*த\s*தே\s*தி/u' => 'பிறந்த தேதி',
            '/வ\s*ர\s*னி\s*ன்\s*ப\s*டி\s*ப்\s*பு/u' => 'வரனின் படிப்பு',
            '/வ\s*ர\s*ன்\s*பெ\s*ய\s*ர்/u' => 'வரன் பெயர்',
            '/உ\s*ட\s*ன்\s*பி\s*ற\s*ந்\s*தோ\s*ர்/u' => 'உடன் பிறந்தோர்',
            '/செ\s*ங்\s*கு\s*ந்\s*த\s*ர்/u' => 'செங்குந்தர்',
            '/கை\s*க்\s*கோ\s*ள\s*ர்/u' => 'கைக்கோளர்',
            '/மு\s*த\s*ல்\s*ம\s*ண\s*ம்/u' => 'முதல் மணம்',
            '/ம\s*று\s*ம\s*ண\s*ம்/u' => 'மறுமணம்',
            '/எ\s*தி\s*ர்\s*ப்\s*ர்?\s*ப்\s*பா\s*ர்\s*ப்\s*ர்?\s*ப்\s*பு\s*க\s*ள்/u' => 'எதிர்பார்ப்புகள்',
            '/கு\s*டும்\s*ப\s*வ\s*ரு\s*மா\s*னம்/u' => 'குடும்ப வருமானம்',
            '/வ\s*ச\s*தி\s*க\s*ள்/u' => 'வசதிகள்',
            '/கு\s*ல\s*தெ\s*ய்\s*வ\s*ம்/u' => 'குலதெய்வம்',
            '/கோ\s*த்\s*தி\s*ர\s*ம்/u' => 'கோத்திரம்',
            '/கூ\s*ட்\s*ட\s*ம்/u' => 'கூட்டம்',
            '/ந\s*ட்\s*ச\s*த்\s*தி\s*ர\s*ம்/u' => 'நட்சத்திரம்',
            '/ல\s*க்\s*ன\s*ம்/u' => 'லக்னம்',
            '/சு\s*த்\s*த\s*ம்/u' => 'சுத்தம்',
            '/தி\s*சை\s*இ\s*ரு\s*ப்\s*பு/u' => 'திசை இருப்பு',
            '/மு\s*க\s*வ\s*ரி/u' => 'முகவரி',
            '/நி\s*று\s*வ\s*ன\s*ம்/u' => 'நிறுவனம்',
            '/வே\s*லை/u' => 'வேலை',
            '/மா\s*த\s*வ\s*ரு\s*மா\s*னம்/u' => 'மாத வருமானம்',
        ];
        foreach ($replacements as $pat => $rep) {
            $text = preg_replace($pat, $rep, $text);
        }

        // Spaced syllables collapsing for Tamil words
        $text = preg_replace('/([\x{0B95}-\x{0BB9}])[\s\t]+([\x{0BBE}-\x{0BCD}\x{0BD7}])/u', '$1$2', $text);
        $text = preg_replace('/([\x{0B85}-\x{0BB9}])\s+([\x{0B95}-\x{0BB9}]\x{0BCD})/u', '$1$2', $text);
        $text = preg_replace('/(\x{0BCD})\s+([\x{0B80}-\x{0BFF}])/u', '$1$2', $text);

        $compounds = [
            'பர ணி' => 'பரணி',
            'ஈ ரோ டு' => 'ஈரோடு',
            'க ணி னி' => 'கணினி',
            'பயன்பா ட்டியல்' => 'பயன்பாட்டியல்',
            'டா ட்டா' => 'டாடா',
            'கம்பெ னி' => 'கம்பெனி',
            'செ ன்னை' => 'சென்னை',
            'செ ல்வ' => 'செல்வ',
            'நா ய க' => 'நாயக',
            'கீ ரனூர்' => 'கீரனூர்',
            'முத்து ராசர்' => 'முத்துராசர்',
            'மா ணி க்கம்' => 'மாணிக்கம்',
            'லட்சு மி' => 'லட்சுமி',
            'செ ன்னி ம லை' => 'சென்னிமலை',
            'ரோ டு' => 'ரோடு',
            'சொ ந்த' => 'சொந்த',
            'வீ டு' => 'வீடு',
            'தோ ட்டம்' => 'தோட்டம்',
            'மே ஷம்' => 'மேஷம்',
        ];
        foreach ($compounds as $from => $to) {
            $text = str_replace($from, $to, $text);
        }

        // Deduplicate viramas
        $text = preg_replace('/\x{0BCD}{2,}/u', "\u{0BCD}", $text);
        return $text;
    }

    /**
     * Clean individual extracted value (strips stray leading virama, colons, duplicate viramas)
     */
    public static function cleanExtractedTamilValue(string $val): string
    {
        if (empty($val)) return '';
        $val = trim($val);

        // 1. Deduplicate viramas
        $val = preg_replace('/\x{0BCD}{2,}/u', "\u{0BCD}", $val);
        $val = preg_replace('/([\x{0B95}-\x{0BB9}]\x{0BCD})\x{0BCD}+/u', '$1', $val);

        // 2. Fix spaced Tamil words (e.g. "ஈரோ டு" -> "ஈரோடு", "விவசா யம்" -> "விவசாயம்", "பொ றியியல்" -> "பொறியியல்")
        $val = preg_replace('/([\x{0B95}-\x{0BB9}])[\s\t]+([\x{0BBE}-\x{0BCD}\x{0BD7}])/u', '$1$2', $val);
        $val = preg_replace('/([\x{0B85}-\x{0BB9}])\s+([\x{0B95}-\x{0BB9}]\x{0BCD})/u', '$1$2', $val);
        $val = preg_replace('/(ஈரோ)\s+(டு)/u', '$1$2', $val);
        $val = preg_replace('/(விவசா)\s+(யம்)/u', '$1$2', $val);
        $val = preg_replace('/(பொ)\s+(றியியல்)/u', '$1$2', $val);
        $val = preg_replace('/(பெ)\s+(ங்களூரு)/u', '$1$2', $val);
        $val = preg_replace('/(சொ)\s+(ந்த)/u', '$1$2', $val);
        $val = preg_replace('/(தோ)\s+(ட்டம்)/u', '$1$2', $val);
        $val = preg_replace('/(கா)\s+(டை)/u', '$1$2', $val);
        $val = preg_replace('/(நந்தகுமா)\s+(ர்)/u', '$1$2', $val);
        $val = preg_replace('/(ஆசிரி)\s+(யர்)/u', '$1$2', $val);
        $val = preg_replace('/(பட்டதா)\s+(ரி)/u', '$1$2', $val);
        $val = preg_replace('/(வே)\s+(ண்டும்)/u', '$1$2', $val);

        // Keep 'None' or '-' if that's the only value
        if (preg_match('/^\s*(?:none|nil)\s*$/ui', $val)) {
            return 'None';
        }
        if (preg_match('/^[\x{0BBE}-\x{0BCC}\x{0BCD}\s:=–\.]+\s*(-)\s*$/u', $val)) {
            return '-';
        }

        // 4. Remove leading colon, dash, semicolon, or invalid leading combining marks (virama / vowel signs)
        $val = preg_replace('/[\[\(\{][\s\.·…_–\-\x{2026}]+[\]\)\}]/u', ' ', $val);
        $val = preg_replace('/(?:[\.·…_–\-\x{2026}]\s*){2,}/u', ' ', $val);
        $val = preg_replace('/^[\x{0BBE}-\x{0BCC}\x{0BCD}\s:=–\.\/&\[\]\(\)\x{2026}]+/u', '', $val);
        $val = preg_replace('/^(?:பெயர்|ஊர்|நிறுவனம்)[\s:& ஊர்ர்:=–\-]+/u', '', $val);
        $val = preg_replace('/^ர்[\s:=–\.]+/u', '', $val);

        // 5. Remove trailing garbage (preserves valid attached pulli like ர், ம், ன்)
        $val = preg_replace('/(?<![\x{0B95}-\x{0BB9}])\x{0BCD}+$/u', '', $val);
        $val = preg_replace('/[\s:=–\.\/&\[\]\(\)\x{2026}]+$/u', '', $val);
        $val = preg_replace('/\s{2,}/u', ' ', $val);

        return trim($val);
    }


    /**
     * Check if a line is a section banner or watermark header
     */
    public static function isSectionHeader(string $line): bool
    {
        $clean = mb_strtolower(preg_replace('/[\s,\/–\-\._\(\)&]+/u', '', $line));
        $headers = [
            'குடும்பவிபரம்', 'familyparticulars', 'familydetails',
            'ராசிவிபரம்', 'astrologicalparticulars', 'astrologydetails',
            'வரன்விபரம்', 'candidatedetails', 'candidateparticulars',
            'மணமகள்விபரகுறிப்பு', 'மணமகன்விபரகுறிப்பு',
            'bridebiodataparticulars', 'groombiodataparticulars',
            'பிறந்தஊர்நேரம்கிழமைதமிழ்வருடம்', 'birthplacetimedaytamilyear',
            'ஈரோடுஸ்ரீஅங்காளம்மன்மணமாலை', 'erodesriangalammanmanamalai',
            'ஸ்ரீஅங்காளம்மன்மணமாலை', 'sriangalammanmanamalai',
            'செங்குந்தர்திருமணதகவல்மையம்', 'senguntharmatrimonialinformationcenter',
            'அலுவல்நேரம்', 'officehours', 'ஞாயிறுவிடுமுறை', 'sundayholiday',
            'முஆறுமுகம்', 'marumugam'
        ];
        foreach ($headers as $h) {
            if ($clean === $h || str_contains($clean, $h)) return true;
        }
        return false;
    }

    /**
     * Parse raw text into structured matrimony bio-data dictionary
     */
        public static function isBaminiEncoded(string $text): bool
    {
        return (bool)preg_match('/(?:µ\s*°\s*©\s*Í|ª\s*Æ\s*¯\s*°\s*Í|š\s*Æ\s*™\s*Í|¤\s*¨\s*Í\s*¤\s*È|¤\s*¾\s*¯\s*Í|ˆ\s*°\s*Ë\s*Ÿ\s*Á|µ\s*°\s*©\s*¿\s*©\s*Í|ª\s*¿\s*±\s*¨\s*Í\s*¤|¨\s*Ç\s*°\s*®\s*Í|•\s*Á\s*²\s*¤\s*Æ\s*¯\s*Í\s*µ\s*®\s*Í|µ°©Í|ªÆ¯°Í|šÆ™Í|¤¨Í¤È|¤¾¯Í|ˆ°ËŸÁ|µ°©¿©Í|ª¿±¨Í¤|¨Ç°®Í|•Á²¤Æ¯Íµ®Í)/u', $text);
    }

    public static function normalizeBaminiPdfText(string $text): string
    {
        $text = str_replace(["\x00", "\x0B", "\r"], "", $text);
        $chars = 'µ°©ÍªÆ¯¤Ç¿¨ŠŸ²È®¾‰Ž•ÁËÂ…š£À‡†›´³±Ê¸';
        for ($k = 0; $k < 4; $k++) {
            $text = preg_replace('/([' . $chars . ']) ([' . $chars . '])/u', '$1$2', $text);
        }
        $text = preg_replace('/([0-9]) ([0-9])/u', '$1$2', $text);

        $baminiMap = [
            'µ°©Í\s*ªÆ¯°Í' => 'வரன் பெயர்',
            'µ°©¿©Í\s*ªŸ¿ªÍªÁ' => 'வரனின் படிப்பு',
            'ª¿±¨Í¤\s*¤Ç¤¿' => 'பிறந்த தேதி',
            'ª¿±¨Í¤\s*Š°Í' => 'பிறந்த ஊர்',
            '¨¿±Áµ©®Í\s*ªÆ¯°Í\s*&\s*Š°Í' => 'நிறுவனம் பெயர் & ஊர்',
            '®¾¤\s*µ°Á®¾©®Í' => 'மாத வருமானம்',
            '•Á²¤Æ¯Íµ®Í\s*,\s*Š°Í' => 'குலதெய்வம் , ஊர்',
            '•Á²¤Æ¯Íµ®Í' => 'குலதெய்வம்',
            '¤¨Í¤È\s*ªÆ¯°Í' => 'தந்தை பெயர்',
            '¤¨Í¤È¯¿©Í\s*ª£¿' => 'தந்தையின் பணி',
            '¤¨Í¤È\s*ª£¿' => 'தந்தை பணி',
            '¤¾¯Í\s*ªÆ¯°Í' => 'தாய் பெயர்',
            '¤¾¯¿©Í\s*ª£¿' => 'தாயின் பணி',
            '¤¾¯Í\s*ª£¿' => 'தாய் பணி',
            '•ÁŸÁ®Íª\s*µ°Á®¾©®Í\s*\/\s*µš¤¿•³Í' => 'குடும்ப வருமானம் / வசதிகள்',
            '‰Ÿ©Í\s*ª¿±¨Í¤Ë°Í\s*,\s*‰±µ¿©°Í\s*µ¿ª°®Í' => 'உடன் பிறந்தோர் , உறவினர் விபரம்',
            '‰Ÿ©Í\s*ª¿±¨Í¤Ë°Í' => 'உடன் பிறந்தோர்',
            'ˆ°ËŸÁ\s*¸Í°À\s*…™Í•¾³®Í®©Í\s*®£®¾²È' => 'ஈரோடு ஸ்ரீ அங்காளம்மன் மணமாலை',
            'šÆ™Í•Á¨Í¤°Í\s*¤¿°Á®£\s*¤•µ²Í\s*®È¯®Í' => 'செங்குந்தர் திருமண தகவல் மையம்',
            '†£Í\s*µ°©Í' => 'ஆண் வரன்',
            '…£Í\s*µ°©Í' => 'ஆண் வரன்',
            'ªª£Í\s*µ°©Í' => 'பெண் வரன்',
            '12\s*®À©®Í' => '12 மீனம்',
            '1\s*®Ç·®Í' => '1 மேஷம்',
            '2\s*°¿·ª®Í' => '2 ரிஷபம்',
            '3\s*®¿¤Á©®Í' => '3 மிதுனம்',
            '4\s*•Ÿ•®Í' => '4 கடகம்',
            '5\s*š¿®Í®®Í' => '5 சிம்மம்',
            '6\s*•©Í©¿' => '6 கன்னி',
            '7\s*¤Á²¾®Í' => '7 துலாம்',
            '8\s*µ¿±¿šÍš¿•®Í' => '8 விருச்சிகம்',
            '9\s*¤©ÁšÁ' => '9 தனுசு',
            '10\s*®•°®Í' => '10 மகரம்',
            '11\s*•Á®Íª®Í' => '11 கும்பம்',
            '¨µ¾®Íš®Í' => 'நவாம்சம்',
            '¨Ç°®Í' => 'நேரம்',
            'µÇ²È' => 'வேலை',
            '‰¯°®Í' => 'உயரம்',
            'ŽŸÈ' => 'எடை',
            '¨¿±®Í' => 'நிறம்',
            '•Ë¤Í¤¿°®Í' => 'கோத்திரம்',
            '•ÂŸÍŸ®Í' => 'கூட்டம்',
            '…²ÈªÇš¿' => 'அலைபேசி',
            'ªÂ°ÍµÀ•®Í' => 'பூர்வீகம்',
            '®Á•µ°¿' => 'முகவரி',
            '°¾š¿' => 'ராசி',
            '¨ŸÍš¤Í¤¿°®Í' => 'நட்சத்திரம்',
            '²•Í©®Í' => 'லக்னம்',
            '¤¿šÈ\s*‡°ÁªÍªÁ' => 'திசை இருப்பு',
            '¤¿šÈ' => 'திசை',
            '‡¤°\s*•Á±¿ªÍªÁ•³Í' => 'இதர குறிப்புகள்',
            '•Á±¿ªÍª¿ŸµÁ®Í' => 'குறிப்பிடவும்',
            '®Á¤²Í\s*®£®Í' => 'முதல் மணம்',
            '®±®£®Í' => 'மறுமணம்',
            'šÁ¤Í¤®Í' => 'சுத்தம்',
            'šÆµÍµ¾¯Í' => 'செவ்வாய்',
            'šÆ™Í•Á¨Í¤°Í' => 'செங்குந்தர்',
            '•È•Í•Ë³°Í' => 'கைக்கோளர்',
            '®¾¨¿±®Í' => 'மாநிறம்',
            '®¾' => 'மா',
            '•Á®Íª®Í' => 'கும்பம்',
            '…µ¿ŸÍŸ®Í' => 'அவிட்டம்',
            '²•Í' => 'லக்',
            'šÂ°¿' => 'சூரி',
            'š¨Í' => 'சந்',
            'šÆµÍ' => 'செவ்',
            'ªÁ¤' => 'புத',
            '•Á°Á' => 'குரு',
            'šÁ•Í' => 'சுக்',
            'š©¿' => 'சனி',
            '°¾•Á' => 'ராகு',
            '•Ç¤Á' => 'கேது',
            '®¾¨Í' => 'மாந்',
            '®À©®Í' => 'மீனம்',
            '®Ç·®Í' => 'மேஷம்',
            '°¿·ª®Í' => 'ரிஷபம்',
            '®¿¤Á©®Í' => 'மிதுனம்',
            '•Ÿ•®Í' => 'கடகம்',
            'š¿®Í®®Í' => 'சிம்மம்',
            '•©Í©¿' => 'கன்னி',
            '¤Á²¾®Í' => 'துலாம்',
            'µ¿°ÁšÍš¿•®Í' => 'விருச்சிகம்',
            '¤©ÁšÁ' => 'தனுசு',
            '®•°®Í' => 'மகரம்'
        ];

        $res = $text;
        foreach ($baminiMap as $bamini => $tamil) {
            $res = preg_replace('/' . $bamini . '/u', $tamil, $res);
        }
        return $res;
    }

    public static function parseText(string $text): array
    {
        $text = preg_replace('/[\x00-\x08\x0b\x0c\x0e-\x1f]/', '', $text);
        $text = @iconv('UTF-8', 'UTF-8//IGNORE', $text);
        $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        if (self::isBaminiEncoded($text)) {
            $text = self::normalizeBaminiPdfText($text);
        }
        $text = str_replace(["\x00", "\xef\xbf\xbd", "\u{FFFD}"], '', $text);
        $text = self::normalizeTamilOcrText($text);
        $rawText = $text;
        $data = [];
        if (empty(trim($text))) {
            return $data;
        }

        $text = @iconv("UTF-8", "UTF-8//IGNORE", $text);
        $text = self::cleanMatrimonyMultiColumnText($text);
        $text = self::normalizeTamilPdfText($text);
        $text = self::cleanMatrimonyMultiColumnText($text);

        // 0. Check for Embedded Varan JSON Payload (100% Round-trip Precision)
        if (str_contains($text, '###VARAN_EMBED_START###')) {
            if (preg_match('/###VARAN_EMBED_START###([\s\S]*?)###VARAN_EMBED_END###/u', $text, $matches)) {
                $b64 = preg_replace('/\s+/', '', $matches[1]);
                $decoded = json_decode(base64_decode($b64), true);
                if (is_array($decoded) && (!empty($decoded['name']) || !empty($decoded['reg_no']))) {
                    return $decoded;
                }
            }
        }

        // 1. Safe line-restricted cleaning so candidate data is never accidentally deleted
        $text = preg_replace('/(?:அலுவல்\s*நேரம்|Office\s*Hours)[^\r\n]*(?:[\r\n]+[^\r\n]*(?:ஞாயிறு|Sunday)[^\r\n]*(?:விடுமுறை|Holiday)[^\r\n]*)?/ui', '', $text);
        $text = preg_replace('/பிறந்த\s*[-–]\s*ஊர்,\s*நேரம்,\s*கிழமை,\s*தமிழ்\s*வருடம்[^\r\n]*/ui', '', $text);
        $text = preg_replace('/Birth\s*[-–]\s*Place,\s*Time,\s*Day,\s*Tamil\s*Year[^\r\n]*/ui', '', $text);
        $text = preg_replace('/\(?தொலைபேசி\s*மூலமாகவே[^\r\n]*(?:[\r\n]+[^\r\n]*(?:இல்லை\b[.)]?|\)))?/ui', '', $text);
        $text = preg_replace('/\(?Registration\s*can\s*be\s*done[^\r\n]*(?:[\r\n]+[^\r\n]*(?:person\b[.)]?|\)))?/ui', '', $text);

        // Clean watermark contacts & founders (strictly line-restricted)
        $text = preg_replace('/(?:நிறுவனர்\s*[:=\-–]?\s*)?மு\.\s*ஆறுமுகம்[,\s]*ஈரோடு[.]?\s*(?:Cell|Ph|அலைபேசி|Mobile)?\s*[:=\-–]?\s*90808\s*49042[^\r\n]*/ui', '', $text);
        $text = preg_replace('/(?:Founder\s*[:=\-–]?\s*)?M\.\s*Arumugam[,\s]*Erode[.]?\s*(?:Cell|Ph|Mobile)?\s*[:=\-–]?\s*90808\s*49042[^\r\n]*/ui', '', $text);
        $text = preg_replace('/(?:ஈரோடு\s*)?ஸ்ரீ\s*அங்காளம்மன்\s*மணமாலை[^\r\n]*/ui', '', $text);
        $text = preg_replace('/(?:ERODE\s*)?SRI\s*ANGALAMMAN\s*MANAMALAI[^\r\n]*/ui', '', $text);
        $text = preg_replace('/செங்குந்தர்\s*திருமண\s*தகவல்\s*மையம்[^\r\n]*/ui', '', $text);
        $text = preg_replace('/Sengunthar\s*Matrimonial\s*Information\s*Center[^\r\n]*/ui', '', $text);
        $text = preg_replace('/ARUMUGAM\s*ANGALAMMAN[^\r\n]*/ui', '', $text);

        // Clean 12-house chart grid lines without discarding the rest of the document
        $text = preg_replace('/(?:12\s*மீனம்|1\s*மே\s*ஷம்|2\s*ரிஷபம்|3\s*மிதுனம்|11\s*கும்பம்|4\s*கடகம்|10\s*மகரம்|5\s*சிம்மம்|9\s*தனுசு|8\s*விருச்சிகம்|7\s*துலாம்|6\s*கன்னி)[^\r\n]*/ui', '', $text);

        $cleanVal = function($val) {
            if (!$val) return '';
            $val = trim($val);
            $val = preg_replace('/(?:[\.·…_–\-]\s*){2,}/u', ' ', $val);
            $val = preg_replace('/^[\s:\/–\-&=,]+/u', '', $val);
            $val = preg_replace('/^(?:சமூகம்|தொழில்|பணி|ஊர்|வசதிகள்|குறிப்புகள்|விபரம்)[\s:\/–\-&=,]+/u', '', $val);
            $val = preg_replace('/(?<=\s)[\x{0BBE}-\x{0BCD}\x{0BD7}]+/u', '', $val);
            $val = preg_replace('/\s+[\x{0BBE}-\x{0BCD}\x{0BD7}]+$/u', '', $val);
            return trim($val);
        };

        // Collapse single-character glyph spaces in Tamil words ONLY when single letters are spaced out (e.g. "கீ தா" -> "கீதா")
        $collapseTamilSpacedLetters = function($str) {
            if (!$str) return '';
            $trimmed = trim($str);
            if (preg_match('/^(?:[\x{0B80}-\x{0BFF}]{1,2}\s+){2,}[\x{0B80}-\x{0BFF}]{1,2}$/u', $trimmed) ||
                preg_match('/^[\x{0B80}-\x{0BFF}]{1,2}\s+[\x{0B80}-\x{0BFF}]{1,2}$/u', $trimmed)) {
                return preg_replace('/\s+/u', '', $trimmed);
            }
            return $trimmed;
        };

        // 1. Gender / வரன் பிரிவு (Header check is 100% authoritative for Candidate Gender)
        $headerSlice = mb_substr($text, 0, 2500);

        if (preg_match('/(?:பெண்\s*வரன்|பெண்\s*மறுமணம்|Bride\s*Biodata|Bride\s*Remarriage|\bBride\b|\bD\/o\b)/ui', $headerSlice)) {
            $data['varan_type'] = 'penn';
        } elseif (preg_match('/(?:ஆண்\s*வரன்|ஆண்\s*மறுமணம்|Groom\s*Biodata|Groom\s*Remarriage|\bGroom\b|\bS\/o\b)/ui', $headerSlice)) {
            $data['varan_type'] = 'aan';
        } elseif (preg_match('/(?:மணமகன்\s*எதிர்பார்ப்பு|மணமகன்\s*தேவை|Groom\s*Wanted|Wanted\s*Groom|Looking\s*for\s*Groom)/ui', $text)) {
            $data['varan_type'] = 'penn';
        } elseif (preg_match('/(?:மணமகள்\s*எதிர்பார்ப்பு|மணமகள்\s*தேவை|Bride\s*Wanted|Wanted\s*Bride|Looking\s*for\s*Bride)/ui', $text)) {
            $data['varan_type'] = 'aan';
        } elseif (preg_match('/(?:பாலினம்|Gender|Sex)\s*[:=–\-]?\s*(?:பெண்|Female|Bride)/ui', $text)) {
            $data['varan_type'] = 'penn';
        } elseif (preg_match('/(?:பாலினம்|Gender|Sex)\s*[:=–\-]?\s*(?:ஆண்|Male|Groom)/ui', $text)) {
            $data['varan_type'] = 'aan';
        }

        // Global Reg No scan
        if (preg_match('/(?:பதிவு\s*எண்|Reg\s*No|Registration\s*No)\s*[:=\-–]?\s*([A-Za-z0-9\-_]+)/ui', $text, $m)) {
            $data['reg_no'] = trim($m[1]);
        }

        // Two-pass line tokenizer: Handles both single-line "Label: Value" and multi-line:
        // Line 1: Label
        // Line 2: : Value
        $rawLines = preg_split('/[\r\n]+/u', $text);
        $pairs = [];
        $pendingLabel = '';

        foreach ($rawLines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            if (self::isSectionHeader($line)) {
                $pendingLabel = '';
                continue;
            }

            // Handle compound line: Date & Reg No together
            if (preg_match('/(?:தே\s*தி|Date).*?(?:பதிவு\s*எண்|Reg\s*No)/ui', $line)) {
                if (preg_match('/(?:தே\s*தி|Date)\s*[:=–\-]?\s*([0-9]{1,2}[.\/-][0-9]{1,2}[.\/-][0-9]{2,4})/ui', $line, $dm)) {
                    $p = explode('-', str_replace(['/', '.'], '-', $dm[1]));
                    if (count($p) === 3) {
                        $data['reg_date'] = strlen($p[2]) === 4 ? sprintf('%04d-%02d-%02d', $p[2], $p[1], $p[0]) : sprintf('%04d-%02d-%02d', $p[0], $p[1], $p[2]);
                    }
                }
                if (preg_match('/(?:பதிவு\s*எண்|Reg\s*No)\s*[:=–\-]?\s*([A-Za-z0-9\-_]+)/ui', $line, $rm)) {
                    $data['reg_no'] = trim($rm[1]);
                }
                $pendingLabel = '';
                continue;
            }

            // Handle multi-colon compound lines (e.g. "ராசி: மகர ராசி  நட்சத்திரம்: உத்திராடம்  லக்னம்: சிம்மம்")
            // Composite Father / Mother lines
            if (preg_match('/(?:Father\s*Name|தந்தை\s*பெயர்)\s*[:=–\-]?\s*(.*?)\s+(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-]?\s*([0-9]{8,12})/ui', $line, $fm)) {
                $data['father_name'] = trim($fm[1]);
                $data['father_mobile'] = trim($fm[2]);
                $pendingLabel = '';
                continue;
            }
            if (preg_match('/(?:Father\s*Job|Father\s*Occupation|தந்தை\s*வேலை|தந்தை\s*தொழில்)\s*[:=–\-]?\s*(.*?)\s+(?:Native\s*Place|Native|பூர்வீகம்)\s*[:=–\-]?\s*([^\r\n]+)/ui', $line, $fj)) {
                $data['father_job'] = trim($fj[1]);
                $data['father_native'] = trim($fj[2]);
                $pendingLabel = '';
                continue;
            }
            if (preg_match('/(?:Mother\s*Name|தாய்\s*பெயர்|தாயார்\s*பெயர்)\s*[:=–\-]?\s*(.*?)\s+(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-]?\s*([0-9]{8,12})/ui', $line, $mm)) {
                $data['mother_name'] = trim($mm[1]);
                $data['mother_mobile'] = trim($mm[2]);
                $pendingLabel = '';
                continue;
            }
            if (preg_match('/(?:Mother\s*Job|Mother\s*Occupation|தாய்\s*வேலை|தாயார்\s*வேலை)\s*[:=–\-]?\s*(.*?)\s+(?:Native\s*Place|Native|பூர்வீகம்)\s*[:=–\-]?\s*([^\r\n]+)/ui', $line, $mj)) {
                $data['mother_job'] = trim($mj[1]);
                $data['mother_native'] = trim($mj[2]);
                $pendingLabel = '';
                continue;
            }

            $colonCount = substr_count($line, ':');
            if ($colonCount > 1) {
                $knownLabels = 'வரன்\s*பெயர்|மணமகள்\s*பெயர்|மணமகன்\s*பெயர்|ராசி|இராசி|Rasi|நட்சத்திரம்|நட்சத்திர|Star|Natchathiram|லக்னம்|Lagnam|தோஷம்|தோஷ\s*விபரம்|Dosham|திசை\s*இருப்பு|Dasa|உயரம்|Height|எடை|Weight|நிறம்|Complexion|படிப்பு|வரனின்\s*படிப்பு|Education|வேலை|பணி|தொழில்|Job|Company\s*Name\s*&\s*Location|Company\s*&\s*Town|Company\s*&\s*Location|Company\s*Name|Company|நிறுவனம்\s*பெயர்\s*&\s*ஊர்|நிறுவனம்|மாத\s*வருமானம்|வருமானம்|Income|பிறந்த\s*தேதி|DOB|பிறந்த\s*ஊர்|Place|பிறந்த\s*நேரம்|நேரம்|Time|தேதி|Date|பதிவு\s*எண்|Reg\s*No|Mobile|கைபேசி|அலைபேசி|தொலைபேசி|Native\s*Place|Native|பூர்வீகம்|Kootam|கூட்டம்|Gothram|கோத்திரம்|Father\s*Name|தந்தை\s*பெயர்|Father\s*Job|தந்தை\s*வேலை|தந்தையின்\s*பணி|Mother\s*Name|தாய்\s*பெயர்|Mother\s*Job|தாய்\s*வேலை|தாயின்\s*பணி|குடும்ப\s*வருமானம்[\/\s]*வசதிகள்|வசதிகள்|உடன்\s*பிறந்தோர்[,\s]*உறவினர்\s*விபரம்|உடன்\s*பிறந்தோர்|உடன்பிறந்தோர்|சகோதரர்கள்|சகோதரிகள்|எதிர்[ப்]*பார்ப்புகள்|எதிர்[ப்]*பார்ப்பு|Expectations';
                if (preg_match_all('/(?:^|[\s\t]+)(' . $knownLabels . ')\s*:\s*([^:]+?)(?=\s*(?:' . $knownLabels . ')\s*:|$)/ui', $line, $multiMatches, PREG_SET_ORDER)) {
                    foreach ($multiMatches as $m) {
                        $pairs[] = [trim($m[1]), trim($m[2])];
                    }
                    $pendingLabel = '';
                    continue;
                }
            }

            $knownRegex = '/^(வரன்\s*பெயர்|பெயர்|Name|மணமகன்\s*பெயர்|மணமகள்\s*பெயர்|பிறந்த\s*தேதி|தேதி|DOB|Date|நேரம்|பிறந்த\s*நேரம்|Time|பிறந்த\s*ஊர்|ஊர்|Place|படிப்பு|கல்வி|Education|வேலை|தொழில்|பணி|Job|நிறுவனம்\s*பெயர்\s*&\s*ஊர்|நிறுவனம்\s*பெயர்|நிறுவனம்|Company|மாத\s*வருமானம்|வருமானம்|Income|Salary|உயரம்|Height|எடை|Weight|நிறம்|Complexion|குலதெய்வம்\s*,\s*ஊர்|குலதெய்வம்|Kuladeivam|கோத்திரம்|Gothram|கூட்டம்|Kootam|தந்தை\s*பெயர்|Father\s*Name|தந்தை\s*வேலை|தந்தை\s*தொழில்|தந்தை\s*பணி|Father\s*Job|தந்தை\s*ஊர்|Father\s*Native|தாய்\s*பெயர்|Mother\s*Name|தாய்\s*வேலை|தாயார்\s*வேலை|Mother\s*Job|தாய்\s*ஊர்|Mother\s*Native|உடன்பிறந்தோர்|Siblings|சகோதரர்கள்|Brothers|சகோதரிகள்|Sisters|குடும்ப\s*வருமானம்|வசதிகள்|சொத்து|Family\s*Wealth|முகவரி|Address|கைபேசி|அலைபேசி|தொலைபேசி|Mobile|Phone|Cell|பூர்வீகம்|Native|ராசி|Rasi|நட்சத்திரம்|Star|லக்னம்|Lagnam|தோஷம்|Dosham|திசை\s*இருப்பு|Dasa\s*Balance|மறுமண\s*விபரம்|திருமண\s*நிலை|Marriage\s*Type|எதிர்பார்ப்பு|Expectations)\s*[:=–\-\.·~]?\s*(.*)$/ui';
            if (preg_match($knownRegex, $line, $km)) {
                $lblPart = trim($km[1]);
                $valPart = trim($km[2]);
                if (!empty($valPart)) {
                    $pairs[] = [$lblPart, $valPart];
                    $pendingLabel = '';
                    continue;
                } else {
                    $pendingLabel = $lblPart;
                    continue;
                }
            }

            $colonIdx = mb_strpos($line, ':');
            if ($colonIdx !== false) {
                $beforeColon = trim(mb_substr($line, 0, $colonIdx));
                $afterColon = trim(mb_substr($line, $colonIdx + 1));

                if (!empty($beforeColon)) {
                    if ($afterColon === '') {
                        // Label is on this line, but value is on next line (e.g. Expectations / Notes)
                        $pendingLabel = $beforeColon;
                    } else {
                        $pairs[] = [$beforeColon, $afterColon];
                        $pendingLabel = '';
                    }
                } else {
                    // Colon is at start of line
                    if (!empty($pendingLabel)) {
                        $pairs[] = [$pendingLabel, $afterColon];
                        $pendingLabel = '';
                    }
                }
            } else {
                // Check if this line is a ticked checkbox item (e.g. ✓செங்குந்தர் கைக்கோளர் or ✓முதல் மணமா)
                if (preg_match('/[✓✔]\s*([^\r\n]+)/u', $line, $chkM)) {
                    $pairs[] = ['CHECKBOX', trim($chkM[1])];
                    $pendingLabel = '';
                    continue;
                }

                // If waiting for value from previous line
                if (!empty($pendingLabel)) {
                    $pairs[] = [$pendingLabel, $line];
                    $pendingLabel = '';
                } elseif (!empty($pairs)) {
                    // Check if previous pair was a multi-line field (siblings, address, expectations, etc.)
                    $lastIdx = count($pairs) - 1;
                    $lastLbl = mb_strtolower(preg_replace('/[\s,\/–\-\._\(\)&]+/u', '', $pairs[$lastIdx][0]));
                    $isContinuationTarget = (
                        str_contains($lastLbl, 'siblings') || 
                        str_contains($lastLbl, 'உடன்பிறந்தோர்') || 
                        str_contains($lastLbl, 'brother') || 
                        str_contains($lastLbl, 'sister') || 
                        str_contains($lastLbl, 'address') || 
                        str_contains($lastLbl, 'முகவரி') || 
                        str_contains($lastLbl, 'expectation') || 
                        str_contains($lastLbl, 'எதிர்பார்ப்பு') ||
                        str_contains($lastLbl, 'wealth') ||
                        str_contains($lastLbl, 'சொத்து')
                    );
                    if ($isContinuationTarget) {
                        $pairs[$lastIdx][1] .= ' ' . trim($line);
                    } else {
                        $pendingLabel = $line;
                    }
                } else {
                    $pendingLabel = $line;
                }
            }
        }

        // Process all extracted (Label, Value) pairs
        $currentSection = '';
        foreach ($pairs as [$rawLbl, $rawVal]) {
            if ($rawLbl === 'CHECKBOX') {
                if (preg_match('/(கைக்கோளர்|kaikkolar)/ui', $rawVal)) {
                    $data['community'] = 'கைக்கோளர்';
                } elseif (preg_match('/(செங்குந்தர்|sengunthar)/ui', $rawVal)) {
                    $data['community'] = 'செங்குந்தர்';
                } elseif (preg_match('/^(?:முதல்\s*மண(?:ம்|மா)?|1st)/ui', trim($rawVal)) || preg_match('/(?:முதல்\s*மண(?:ம்|மா)?|1st)\s*[✓✔☑]/ui', $rawVal)) {
                    $data['marriage_type'] = 'mudhal_manama';
                } elseif (preg_match('/^(?:ம\s*று\s*ம\s*ண\s*ம்|மறுமண(?:ம்|மா)?|2nd|remarriage)/ui', trim($rawVal)) || preg_match('/(?:ம\s*று\s*ம\s*ண\s*ம்|மறுமண(?:ம்|மா)?|2nd|remarriage)\s*[✓✔☑]/ui', $rawVal)) {
                    $data['marriage_type'] = 'marumanam';
                }
                continue;
            }

            $lbl = mb_strtolower(preg_replace('/[\s,\/–\-\._\(\)&]+/u', '', $rawLbl));
            if (empty($lbl)) continue;

            if (str_contains($lbl, 'தந்தை') || str_contains($lbl, 'father') || str_contains($lbl, 'தகப்பனார்')) {
                $currentSection = 'father';
            } elseif (str_contains($lbl, 'தாய்') || str_contains($lbl, 'mother') || str_contains($lbl, 'தாயார்')) {
                $currentSection = 'mother';
            }

            if (str_contains($lbl, 'பதிவுஎண்') || str_contains($lbl, 'regno') || str_contains($lbl, 'registrationno')) {
                $data['reg_no'] = trim(preg_replace('/[^A-Za-z0-9\-_]/', '', $rawVal));
            } elseif (str_contains($lbl, 'பிறந்ததேதி') || str_contains($lbl, 'dateofbirth') || str_contains($lbl, 'dob') || str_contains($lbl, 'birthdate')) {
                $cleanedVal = trim($rawVal);
                if (preg_match('/\b(19\d\d|20[0-2]\d)[.\/-](\d{1,2})[.\/-](\d{1,2})\b/', $cleanedVal, $m)) {
                    $y = (int)$m[1]; $mo = (int)$m[2]; $d = (int)$m[3];
                    if (checkdate($mo, $d, $y)) {
                        $data['dob'] = sprintf('%04d-%02d-%02d', $y, $mo, $d);
                    }
                } elseif (preg_match('/\b(\d{1,2})[.\/-](\d{1,2})[.\/-](19\d\d|20[0-2]\d)\b/', $cleanedVal, $m)) {
                    $d = (int)$m[1]; $mo = (int)$m[2]; $y = (int)$m[3];
                    if (checkdate($mo, $d, $y)) {
                        $data['dob'] = sprintf('%04d-%02d-%02d', $y, $mo, $d);
                    }
                } elseif (preg_match('/\b(\d{1,2})[.\/-](\d{1,2})[.\/-](\d{2})\b/', $cleanedVal, $m)) {
                    $d = (int)$m[1]; $mo = (int)$m[2]; $y2 = (int)$m[3];
                    $y = ($y2 > 30) ? 1900 + $y2 : 2000 + $y2;
                    if (checkdate($mo, $d, $y)) {
                        $data['dob'] = sprintf('%04d-%02d-%02d', $y, $mo, $d);
                    }
                }
            } elseif ($lbl === 'நேரம்' || str_contains($lbl, 'பிறந்தநேரம்') || str_contains($lbl, 'birthtime') || str_contains($lbl, 'நேரம்கிழமை')) {
                if (preg_match('/([0-9]{1,2}\s*[:.]\s*[0-9]{2}(?:\s*(?:AM|PM|am|pm))?)/i', $rawVal, $tm)) {
                    $data['birth_time'] = preg_replace('/\s*:\s*/', ':', trim($tm[1]));
                } else {
                    $data['birth_time'] = $cleanVal($rawVal);
                }
            } elseif (str_contains($lbl, 'பிறந்தஊர்') || str_contains($lbl, 'birthplace')) {
                $data['birth_place'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif ($lbl === 'தேதி' || $lbl === 'date') {
                $cleanedVal = trim($rawVal);
                if (preg_match('/\b(19\d\d|20[0-2]\d)[.\/-](\d{1,2})[.\/-](\d{1,2})\b/', $cleanedVal, $m)) {
                    $y = (int)$m[1]; $mo = (int)$m[2]; $d = (int)$m[3];
                    if (checkdate($mo, $d, $y)) {
                        $data['reg_date'] = sprintf('%04d-%02d-%02d', $y, $mo, $d);
                    }
                } elseif (preg_match('/\b(\d{1,2})[.\/-](\d{1,2})[.\/-](19\d\d|20[0-2]\d)\b/', $cleanedVal, $m)) {
                    $d = (int)$m[1]; $mo = (int)$m[2]; $y = (int)$m[3];
                    if (checkdate($mo, $d, $y)) {
                        $data['reg_date'] = sprintf('%04d-%02d-%02d', $y, $mo, $d);
                    }
                } elseif (preg_match('/\b(\d{1,2})[.\/-](\d{1,2})[.\/-](\d{2})\b/', $cleanedVal, $m)) {
                    $d = (int)$m[1]; $mo = (int)$m[2]; $y2 = (int)$m[3];
                    $y = ($y2 > 30) ? 1900 + $y2 : 2000 + $y2;
                    if (checkdate($mo, $d, $y)) {
                        $data['reg_date'] = sprintf('%04d-%02d-%02d', $y, $mo, $d);
                    }
                }
            } elseif (str_contains($lbl, 'தந்தைபெயர்') || str_contains($lbl, 'தகப்பனார்பெயர்') || str_contains($lbl, 'fathername')) {
                $data['father_name'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'தந்தைவேலை') || str_contains($lbl, 'தந்தைதொழில்') || str_contains($lbl, 'தந்தையின்பணி') || str_contains($lbl, 'தந்தைபணி') || str_contains($lbl, 'fatherjob') || str_contains($lbl, 'fatheroccupation')) {
                $data['father_job'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'தாயார்பெயர்') || str_contains($lbl, 'தாய்ப்பெயர்') || str_contains($lbl, 'தாய்பெயர்') || str_contains($lbl, 'mothername')) {
                $data['mother_name'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'தாயார்வேலை') || str_contains($lbl, 'தாயார்தொழில்') || str_contains($lbl, 'தாயின்பணி') || str_contains($lbl, 'தாய்தொழில்') || str_contains($lbl, 'தாய்வேலை') || str_contains($lbl, 'தாய்பணி') || str_contains($lbl, 'motherjob') || str_contains($lbl, 'motheroccupation')) {
                $data['mother_job'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif ((!str_contains($lbl, 'தந்தை') && !str_contains($lbl, 'தாய்') && !str_contains($lbl, 'நிறுவனம்') && !str_contains($lbl, 'company') && !str_contains($lbl, 'father') && !str_contains($lbl, 'mother')) && (str_contains($lbl, 'வரன்பெயர்') || str_contains($lbl, 'மணமகள் பெயர்') || str_contains($lbl, 'மணமகன் பெயர்') || str_contains($lbl, 'பெயர்') || $lbl === 'name' || str_contains($lbl, 'candidatename'))) {
                if (empty($data['name'])) {
                    $nm = preg_replace('/^(?:செல்வி|செல்வன்|திருமதி|திரு|Ms\.?|Mr\.?)\s+/ui', '', $collapseTamilSpacedLetters($cleanVal($rawVal)));
                    $nm = preg_replace('/[★✦■●▲▼♦♣♠✓✔☑]/u', '', $nm);
                    $nm = preg_replace('/^[0-9\s:–\.\-_]+/u', '', $nm);
                    $nm = preg_replace('/[\(\[\{][0-9✓✔☑\s\-_–\.\/\*]*[\)\]\}]?/u', '', $nm);
                    $nm = preg_replace('/\s*[\(\[]?\s*[0-9]+\s*[\)\]]?\s*$/u', '', $nm);
                    $nm = preg_replace('/(?:\s*\[[ ✓xX0-9]*\]\s*|\s+[✓✔☑]\s*|\s+)(?:Sengunthar|Kaikkolar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|கை\s*க்\s*கோ\s*ள\s*ர்|செங்குந்தர்|கைக்கோளர்)\s*.*$/ui', '', $nm);
                    $data['name'] = trim($nm);
                }
            } elseif (str_contains($lbl, 'படிப்பு') || str_contains($lbl, 'கல்வி') || str_contains($lbl, 'education') || str_contains($lbl, 'qualification')) {
                $data['education'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'நிறுவனம்வருமானம்') || str_contains($lbl, 'companyincome') || (str_contains($lbl, 'company') && str_contains($lbl, 'income')) || (str_contains($lbl, 'நிறுவனம்') && str_contains($rawVal, 'ரூ'))) {
                $parts = preg_split('/\s*\/\s*/u', $rawVal);
                $data['company_details'] = $collapseTamilSpacedLetters($cleanVal($parts[0] ?? ''));
                foreach ($parts as $part) {
                    if (preg_match('/(?:ரூ[.]?|rs[.]?)\s*([0-9,]+)/ui', $part, $nm) || preg_match('/([0-9]{4,})/', $part, $nm)) {
                        $data['monthly_income'] = trim(str_replace(',', '', $nm[1]));
                        break;
                    }
                }
            } elseif (str_contains($lbl, 'நிறுவனம்') || str_contains($lbl, 'company') || str_contains($lbl, 'organization')) {
                $data['company_details'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'மாதவருமானம்') || $lbl === 'வருமானம்' || str_contains($lbl, 'income') || str_contains($lbl, 'salary')) {
                $data['monthly_income'] = preg_replace('/[^\d,]/', '', $cleanVal($rawVal));
            } elseif (!str_contains($lbl, 'தந்தை') && !str_contains($lbl, 'தாய்') && !str_contains($lbl, 'father') && !str_contains($lbl, 'mother') && (str_contains($lbl, 'வேலை') || str_contains($lbl, 'தொழில்') || str_contains($lbl, 'பணி') || str_contains($lbl, 'job') || str_contains($lbl, 'occupation') || str_contains($lbl, 'profession') || str_contains($lbl, 'designation'))) {
                if ($currentSection === 'father' && empty($data['father_job'])) {
                    $data['father_job'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
                } elseif ($currentSection === 'mother' && empty($data['mother_job'])) {
                    $data['mother_job'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
                } else {
                    $data['job_title'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
                }
            } elseif (str_contains($lbl, 'உயரம்எடை') || str_contains($lbl, 'heightweight')) {
                if (preg_match('/([0-9\.]+\s*cm)/i', $rawVal, $cmM)) {
                    $data['height'] = trim($cmM[1]);
                } elseif (preg_match('/([0-9]+\s*ft[^\,]*)/i', $rawVal, $ftM)) {
                    $data['height'] = trim($ftM[1]);
                } elseif (preg_match('/([0-9\.]+)/i', $rawVal, $hm)) {
                    $data['height'] = trim($hm[1]);
                }
                if (preg_match('/,\s*([0-9\.]+\s*(?:kg)?)/i', $rawVal, $wm)) {
                    $data['weight'] = trim($wm[1]);
                }
            } elseif ($lbl === 'உயரம்' || $lbl === 'height') {
                $data['height'] = $cleanVal($rawVal);
            } elseif (str_contains($lbl, 'எடை') || $lbl === 'weight') {
                $data['weight'] = $cleanVal($rawVal);
            } elseif (str_contains($lbl, 'நிறம்') || str_contains($lbl, 'complexion') || str_contains($lbl, 'color') || str_contains($lbl, 'colour')) {
                $cVal = self::matchComplexion($rawVal);
                $data['complexion'] = $cVal ?: $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'சாதி') || str_contains($lbl, 'இனம்') || str_contains($lbl, 'சமூகம்') || str_contains($lbl, 'ஜாதி') || str_contains($lbl, 'caste') || str_contains($lbl, 'community')) {
                $commVal = $cleanVal($rawVal);
                if (preg_match('/\s+([A-Za-z]{1,6}[-_\s]?[A-Za-z0-9]+[-_\s]?[0-9]{1,6})\s*$/i', $commVal, $rTr, PREG_OFFSET_CAPTURE)) {
                    if (empty($data['reg_no'])) {
                        $data['reg_no'] = trim($rTr[1][0]);
                    }
                    $commVal = trim(substr($commVal, 0, $rTr[0][1]));
                }
                if (!empty($data['reg_no'])) {
                    $commVal = trim(preg_replace('/\b' . preg_quote($data['reg_no'], '/') . '\b/i', '', $commVal));
                }
                $data['community'] = $collapseTamilSpacedLetters($commVal);
            } elseif (str_contains($lbl, 'சகோதரர்கள்') || str_contains($lbl, 'brothers')) {
                $bVal = $cleanVal($rawVal);
                $bVal = preg_replace('/^(?:உறவினர்\s*விபரம்|Relatives?\s*Details?)[\s:=–\-]+/ui', '', $bVal);
                $data['brothers'] = $collapseTamilSpacedLetters($bVal);
            } elseif (str_contains($lbl, 'சகோதரிகள்') || str_contains($lbl, 'sisters')) {
                $sVal = $cleanVal($rawVal);
                $sVal = preg_replace('/^(?:உறவினர்\s*விபரம்|Relatives?\s*Details?)[\s:=–\-]+/ui', '', $sVal);
                $data['sisters'] = $collapseTamilSpacedLetters($sVal);
            } elseif (str_contains($lbl, 'உடன்பிறந்தோர்') || str_contains($lbl, 'உடன்பிறப்பு') || str_contains($lbl, 'siblings')) {
                $sibVal = $cleanVal($rawVal);
                $sibVal = preg_replace('/^(?:உறவினர்\s*விபரம்|Relatives?\s*Details?)[\s:=–\-]+/ui', '', $sibVal);
                $data['siblings_details'] = $collapseTamilSpacedLetters($sibVal);
            } elseif (str_contains($lbl, 'தந்தை') && (str_contains($lbl, 'கைபேசி') || str_contains($lbl, 'மொபைல்') || str_contains($lbl, 'தொலைபேசி') || str_contains($lbl, 'mobile') || str_contains($lbl, 'cell') || str_contains($lbl, 'phone'))) {
                $rawPh = preg_replace('/[^\d+]/', '', $cleanVal($rawVal));
                $data['father_mobile'] = $rawPh;
            } elseif ((str_contains($lbl, 'தாய்') || str_contains($lbl, 'mother')) && (str_contains($lbl, 'கைபேசி') || str_contains($lbl, 'மொபைல்') || str_contains($lbl, 'தொலைபேசி') || str_contains($lbl, 'mobile') || str_contains($lbl, 'cell') || str_contains($lbl, 'phone'))) {
                $rawPh = preg_replace('/[^\d+]/', '', $cleanVal($rawVal));
                $data['mother_mobile'] = $rawPh;
            } elseif (str_contains($lbl, 'அலைபேசி') || str_contains($lbl, 'தொலைபேசி') || str_contains($lbl, 'கைபேசி') || str_contains($lbl, 'மொபைல்') || str_contains($lbl, 'telephone') || str_contains($lbl, 'mobile') || str_contains($lbl, 'cell') || str_contains($lbl, 'phone')) {
                $rawPh = preg_replace('/[^\d+]/', '', $cleanVal($rawVal));
                if ($currentSection === 'father') {
                    $data['father_mobile'] = $rawPh;
                } elseif ($currentSection === 'mother') {
                    $data['mother_mobile'] = $rawPh;
                } elseif (empty($data['father_mobile'])) {
                    $data['father_mobile'] = $rawPh;
                } else {
                    $data['mother_mobile'] = $rawPh;
                }
            } elseif (str_contains($lbl, 'சொத்து') || str_contains($lbl, 'familywealth') || str_contains($lbl, 'property') || str_contains($lbl, 'வசதிகள்') || str_contains($lbl, 'assets')) {
                $fw = $collapseTamilSpacedLetters($cleanVal($rawVal));
                $fw = preg_replace('/^[\s\{\[\(]*[வள][சஸ][ததிஜஜி][களக்][ளள்]?[ \t]*[:=–\-]?[\s\}\]\)]*\s*/ui', '', $fw);
                $data['family_wealth'] = trim($fw);
            } elseif ($lbl === 'முகவரி' || $lbl === 'address') {
                $data['address'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'எதிர்பார்ப்பு') || str_contains($lbl, 'expectations')) {
                $data['expectations'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'பூர்வீகம்குலதெய்வம்') || str_contains($lbl, 'nativedeity')) {
                $parts = array_map(function($p) use ($cleanVal, $collapseTamilSpacedLetters) {
                    return $collapseTamilSpacedLetters($cleanVal($p));
                }, explode(',', $rawVal));
                if (count($parts) >= 2) {
                    $data['father_native'] = $parts[0];
                    $data['mother_native'] = $parts[0];
                    $data['kuladeivam'] = implode(', ', array_slice($parts, 1));
                } elseif (count($parts) === 1) {
                    $data['father_native'] = $parts[0];
                    $data['kuladeivam'] = $parts[0];
                }
            } elseif (str_contains($lbl, 'குலதெய்வம்') || str_contains($lbl, 'kuladeivam') || str_contains($lbl, 'deity')) {
                $data['kuladeivam'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'தந்தைபூர்வீகம்') || str_contains($lbl, 'fathernative')) {
                $data['father_native'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'தாய்பூர்வீகம்') || str_contains($lbl, 'mothernative')) {
                $data['mother_native'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'nativeplace') || $lbl === 'native' || $lbl === 'பூர்வீகம்') {
                $natVal = $collapseTamilSpacedLetters($cleanVal($rawVal));
                if ($currentSection === 'father') {
                    $data['father_native'] = $natVal;
                } elseif ($currentSection === 'mother') {
                    $data['mother_native'] = $natVal;
                } elseif (empty($data['father_native'])) {
                    $data['father_native'] = $natVal;
                } elseif (empty($data['mother_native'])) {
                    $data['mother_native'] = $natVal;
                }
            } elseif ($lbl === 'கோத்திரம்' || $lbl === 'gothram') {
                $data['gothram'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif ($lbl === 'கூட்டம்' || $lbl === 'kootam' || $lbl === 'clan') {
                $data['kootam'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'லக்னம்') || str_contains($lbl, 'lagnam')) {
                $lVal = self::matchRasi($rawVal);
                $cleaned = $collapseTamilSpacedLetters($cleanVal($rawVal));
                $data['lagnam'] = $lVal ?: (!in_array($cleaned, ['-', 'இல்லை', '']) ? $cleaned : '');
            } elseif (str_contains($lbl, 'இராசி') || str_contains($lbl, 'ராசி') || str_contains($lbl, 'rasi')) {
                $rVal = self::matchRasi($rawVal);
                if ($rVal) {
                    $data['rasi'] = $rVal;
                }
            } elseif (str_contains($lbl, 'நட்சத்திர') || str_contains($lbl, 'star') || str_contains($lbl, 'natchathiram') || str_contains($lbl, 'nakshatra')) {
                $sVal = self::matchNatchathiram($rawVal);
                $data['natchathiram'] = $sVal ?: $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'தோஷ') || str_contains($lbl, 'dosham')) {
                $dVal = self::matchDosham($rawVal);
                $data['dosham'] = $dVal ?: $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'பிறந்தஊர்') || str_contains($lbl, 'birthplace')) {
                $data['birth_place'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'நேரம்கிழமை') || str_contains($lbl, 'பிறந்தநேரம்') || str_contains($lbl, 'birthtime') || $lbl === 'time' || str_contains($lbl, 'timeday')) {
                if (preg_match('/([0-9]{1,2}\s*[:.]\s*[0-9]{2}(?:\s*(?:AM|PM|am|pm|a\.m\.?|p\.m\.?))?)/i', $rawVal, $tm)) {
                    $data['birth_time'] = preg_replace('/\s*:\s*/', ':', trim($tm[1]));
                } else {
                    $data['birth_time'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
                }
            } elseif (str_contains($lbl, 'தமிழ்மாதம்') || str_contains($lbl, 'tamilmonth')) {
                $mVal = self::matchTamilMonth($rawVal);
                $data['tamil_month'] = $mVal ?: $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'தமிழ்வருடம்') || str_contains($lbl, 'tamilyear')) {
                $yVal = self::matchTamilYear($rawVal);
                $data['tamil_year'] = $yVal ?: $collapseTamilSpacedLetters($cleanVal($rawVal));
            } elseif (str_contains($lbl, 'திசா') || str_contains($lbl, 'திசை') || str_contains($lbl, 'thisai') || str_contains($lbl, 'dasa') || str_contains($lbl, 'iruppu')) {
                $tVal = $collapseTamilSpacedLetters($cleanVal($rawVal));
                $tVal = preg_replace('/^(?:திசை\s*இருப்பு|Dasa\s*Balance)\s*[:=–\-]?\s*/ui', '', $tVal);
                $tVal = preg_replace('/\s*(?:சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு\s*[\/\-]?\s*கே\s*து|ராகு\s*[\/\-]?\s*கேது|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|[✓✔☑■]).*$/uis', '', $tVal);
                $tVal = preg_replace('/(?:எதிர்[ப்]*பார்ப்பு(?:கள்)?|Expectations|இதர\s*குறிப்புகள்).*$/uis', '', $tVal);
                if (!str_contains($tVal, '_ மகாதிசை')) {
                    $data['thisai_iruppu'] = trim($tVal);
                }
            } elseif ($lbl === 'குறிப்பு' || $lbl === 'note') {
                if (empty($data['expectations'])) $data['expectations'] = $collapseTamilSpacedLetters($cleanVal($rawVal));
            }
        }

        // Post-process siblings summary
        if (!empty($data['brothers']) || !empty($data['sisters'])) {
            $sParts = [];
            if (!empty($data['brothers'])) $sParts[] = $data['brothers'];
            if (!empty($data['sisters'])) $sParts[] = $data['sisters'];
            $data['siblings_details'] = implode(', ', $sParts);
        }

        // Fallback for Blood Group & Email
        if (empty($data['blood_group'])) {
            if (preg_match('/(?:ரத்த\s*வகை|Blood\s*Group)\s*[:=–\-]?\s*([A-Za-z0-9+-]+)/ui', $text, $bgM)) {
                $data['blood_group'] = strtoupper(trim($bgM[1]));
            } elseif (preg_match('/(?:^|[\s:])(A1B\+|A1B\-|A1\+|A1\-|A\+|A\-|B\+|B\-|O\+|O\-|AB\+|AB\-)(?=[\s\r\n,]|$)/i', $text, $bgM2)) {
                $data['blood_group'] = strtoupper(trim($bgM2[1]));
            }
        }
        if (empty($data['email'])) {
            if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $emM)) {
                $data['email'] = strtolower($emM[0]);
            }
        }

        // Clean any Reg No that accidentally got absorbed into other fields due to horizontal layout alignment
        if (!empty($data['reg_no'])) {
            $escapedReg = preg_quote($data['reg_no'], '/');
            foreach (['name', 'community', 'education', 'job_title', 'company_details', 'complexion', 'kuladeivam', 'gothram', 'kootam', 'height', 'weight'] as $f) {
                if (!empty($data[$f]) && is_string($data[$f])) {
                    $data[$f] = trim(preg_replace('/\s*\b' . $escapedReg . '\b\s*/i', ' ', $data[$f]));
                    $data[$f] = trim(preg_replace('/\s+\b([A-Z]{1,6}[-_\s]?[A-Z0-9]+[-_\s]?[0-9]{1,6})\b\s*$/i', '', $data[$f]));
                }
            }
        }

        // High-precision astrology fallback scanner (Handles multi-field lines, spaced text, and adjectival rasis)
        if (empty($data['rasi'])) {
            if (preg_match('/(?:இராசி|ராசி|Rasi)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s*(?:நட்சத்திரம்|Star|லக்னம்|Lagnam|தோஷம்|Dosham)|[\r\n,;]|$)/ui', $text, $rm)) {
                $matchedR = self::matchRasi($rm[1]);
                if ($matchedR) {
                    $data['rasi'] = $matchedR;
                }
            }
            if (empty($data['rasi'])) {
                $rList = ['மேஷம்' => 'மேஷ', 'ரிஷபம்' => 'ரிஷப', 'மிதுனம்' => 'மிதுன', 'கடகம்' => 'கடக', 'சிம்மம்' => 'சிம்ம', 'கன்னி' => 'கன்னி', 'துலாம்' => 'துலா', 'விருச்சிகம்' => 'விருச்சிக', 'தனுசு' => 'தனு', 'மகரம்' => 'மகர', 'கும்பம்' => 'கும்ப', 'மீனம்' => 'மீன'];
                foreach ($rList as $taR => $baseR) {
                    if (preg_match('/(?:^|[\s,\/–\-\._\(\)&])(' . preg_quote($taR, '/') . '|' . preg_quote($baseR, '/') . ')(?:\s*ராசி|\b)/ui', $text)) {
                        $data['rasi'] = $taR;
                        break;
                    }
                }
            }
        }
        if (empty($data['rasi']) && !empty($data['natchathiram'])) {
            $starRasiMap = [
                'அஸ்வினி' => 'மேஷம்', 'பரணி' => 'மேஷம்', 'கார்த்திகை' => 'மேஷம்',
                'ரோகிணி' => 'ரிஷபம்', 'மிருகசீரிடம்' => 'ரிஷபம்',
                'திருவாதிரை' => 'மிதுனம்', 'புனர்பூசம்' => 'மிதுனம்',
                'பூசம்' => 'கடகம்', 'ஆயில்யம்' => 'கடகம்',
                'மகம்' => 'சிம்மம்', 'பூரம்' => 'சிம்மம்', 'உத்திரம்' => 'சிம்மம்',
                'அஸ்தம்' => 'கன்னி', 'சித்திரை' => 'கன்னி',
                'சுவாதி' => 'துலாம்', 'விசாகம்' => 'துலாம்',
                'அனுஷம்' => 'விருச்சிகம்', 'கேட்டை' => 'விருச்சிகம்',
                'மூலம்' => 'தனுசு', 'பூராடம்' => 'தனுசு', 'உத்திராடம்' => 'தனுசு',
                'திருவோணம்' => 'மகரம்', 'அவிட்டம்' => 'மகரம்',
                'சதயம்' => 'கும்பம்', 'பூரட்டாதி' => 'கும்பம்',
                'உத்திரட்டாதி' => 'மீனம்', 'ரேவதி' => 'மீனம்'
            ];
            foreach ($starRasiMap as $st => $rs) {
                if (mb_strpos($data['natchathiram'], $st) !== false) {
                    $data['rasi'] = $rs;
                    break;
                }
            }
        }
        if (empty($data['natchathiram'])) {
            if (preg_match('/(?:நட்சத்திரம்|நட்சத்திர|Star|Natchathiram)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s+(?:இராசி|ராசி|Rasi|லக்னம்|Lagnam|தோஷம்|Dosham)|[\r\n,;]|$)/ui', $text, $sm)) {
                $data['natchathiram'] = self::matchNatchathiram($sm[1]) ?: $collapseTamilSpacedLetters($cleanVal($sm[1]));
            }
        }
        if (empty($data['lagnam'])) {
            if (preg_match('/(?:லக்னம்|Lagnam)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s+(?:இராசி|ராசி|Rasi|நட்சத்திரம்|Star|தோஷம்|Dosham)|[\r\n,;]|$)/ui', $text, $lm)) {
                $data['lagnam'] = self::matchRasi($lm[1]) ?: $collapseTamilSpacedLetters($cleanVal($lm[1]));
            }
        }
        if (empty($data['dosham'])) {
            if (preg_match('/(?:தோஷ\s*விபரம்|தோஷம்|Dosham)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s+(?:இராசி|ராசி|Rasi|நட்சத்திரம்|Star|லக்னம்|Lagnam)|[\r\n,;]|$)/ui', $text, $dm)) {
                $data['dosham'] = self::matchDosham($dm[1]) ?: $collapseTamilSpacedLetters($cleanVal($dm[1]));
            }
        }
        // Merge Sri Angalamman specific extracted rows (high precision for standard Sri Angalamman templates)
        $angalamman = self::parseSriAngalammanRows($rawText);
        if (empty($angalamman['dosham'])) {
            $angFall = self::parseSriAngalammanRows($text);
            if (!empty($angFall['dosham'])) $angalamman['dosham'] = $angFall['dosham'];
        }
        if (!empty($angalamman)) {
            foreach ($angalamman as $k => $v) {
                if ($v !== '' && $v !== null) {
                    $data[$k] = $v;
                }
            }
        }

        // Apply cleanExtractedTamilValue across all extracted string fields
        foreach ($data as $k => $v) {
            if (is_string($v) && !in_array($k, ['email', 'reg_no', 'dob', 'reg_date', 'marriage_type', 'varan_type'])) {
                $data[$k] = self::cleanExtractedTamilValue($v);
            }
        }

        // Post-clean weight bleed & extract complexion if embedded in weight string
        if (!empty($data['weight']) && preg_match('/(?:நி\s*ற\s*ம்|complexion)\s*[:=–\-]?\s*([^\r\n]+)/ui', $data['weight'], $cM)) {
            if (empty($data['complexion'])) {
                $data['complexion'] = self::cleanExtractedTamilValue($cM[1]);
            }
            $data['weight'] = trim(preg_replace('/(?:நி\s*ற\s*ம்|complexion)\s*[:=–\-]?\s*[^\r\n]+/ui', '', $data['weight']));
        }
        if (!empty($data['company_details'])) {
            $data['company_details'] = preg_replace('/^(?:பெயர்|ஊர்|நிறுவனம்)[\s:& ஊர்ர்:=–\-]+/u', '', $data['company_details']);
        }
        if (!empty($data['birth_place'])) {
            $data['birth_place'] = preg_replace('/^ர்[\s:=–\.]+/u', '', $data['birth_place']);
        }
        if (!empty($data['kuladeivam'])) {
            $data['kuladeivam'] = preg_replace('/^ர்[\s:=–\.]+/u', '', $data['kuladeivam']);
        }
        if (!empty($data['name'])) {
            $data['name'] = preg_replace('/^(?:[\x{0BCD}\s:=–\.\-]|(?:[ர்ல்ன்]|பெயர்)[\s:=–\.\-]+)+/u', '', $data['name']);
            $data['name'] = preg_replace('/^[0-9\s:–\.\-_]+/u', '', $data['name']);
            $data['name'] = preg_replace('/[\(\[\{][0-9✓✔☑\s\-_–\.]*[\)\]\}]$/u', '', $data['name']);
            $data['name'] = preg_replace('/[\(\[\{]?[0-9✓✔☑\s\-_–\.]*$/u', '', $data['name']);
            $data['name'] = trim($data['name']);
        }
        if (!empty($data['expectations'])) {
            $data['expectations'] = preg_replace('/^(?:\(to\s*be\s*specified\)|to\s*be\s*specified|குறிப்பிடவும்|(?:எதிர்பார்ப்புகள்|எதிர்ப்பார்ப்புகள்)?(?:\s*மற்றும்)?(?:\s*இதர\s*குறிப்புகள்)?(?:\s*குறிப்பிடவும்)?)\s*[:=–\-]?\s*/ui', '', $data['expectations']);
        }

        // Final sibling fallback if brothers/sisters are still empty
        if ((empty($data['brothers']) || empty($data['sisters'])) && !empty($data['siblings_details'])) {
            $rawSib = $data['siblings_details'];
            $hasBro = preg_match('/(?:தம்பி|அண்ணன்|brother|younger\s*brother|elder\s*brother)/ui', $rawSib);
            $hasSis = preg_match('/(?:அக்கா|தங்கை|sister|younger\s*sister|elder\s*sister)/ui', $rawSib);
            $isDocTa = preg_match('/[\x{0B80}-\x{0BFF}]/u', $rawSib);
            $noneVal = $isDocTa ? 'இல்லை' : 'None';
            if ($hasBro && !$hasSis) {
                if (empty($data['brothers'])) $data['brothers'] = $rawSib;
                if (empty($data['sisters'])) $data['sisters'] = $noneVal;
            } elseif ($hasSis && !$hasBro) {
                if (empty($data['sisters'])) $data['sisters'] = $rawSib;
                if (empty($data['brothers'])) $data['brothers'] = $noneVal;
            }
        }

        // Preserve explicit "None" answers across all fields
        foreach ($data as $k => $v) {
            if (is_string($v) && preg_match('/^\s*(?:none|nil)\s*$/ui', $v)) {
                $data[$k] = 'None';
            }
        }

        foreach ($data as $k => $v) {
            if (is_string($v)) {
                $v = preg_replace('/(?<=\s)[\x{0BBE}-\x{0BCD}\x{0BD7}]+/u', '', $v);
                $v = preg_replace('/\s+[\x{0BBE}-\x{0BCD}\x{0BD7}]+$/u', '', $v);
                $data[$k] = trim($v);
            }
        }

        return $data;
    }

    public static function matchRasi(string $rawVal): string
    {
        if (empty($rawVal)) return '';
        $clean = mb_strtolower(preg_replace('/\s+/u', '', self::normalizeTamilVisualOrder($rawVal)));
        $clean = preg_replace('/([\x{0BBE}-\x{0BCD}\x{0BD7}])\1+/u', '$1', $clean);
        $rasis = [
            'மேஷம்' => ['mesham', 'aries', 'மேஷ'],
            'ரிஷபம்' => ['rishabam', 'taurus', 'ரிஷப'],
            'மிதுனம்' => ['mithunam', 'gemini', 'மிதுன'],
            'கடகம்' => ['kadagam', 'cancer', 'கடக'],
            'சிம்மம்' => ['simmam', 'leo', 'சிம்ம'],
            'கன்னி' => ['kanni', 'virgo'],
            'துலாம்' => ['thulam', 'libra', 'துலா', 'துல'],
            'விருச்சிகம்' => ['viruchigam', 'scorpio', 'விருச்சி', 'விருச்சிக'],
            'தனுசு' => ['dhanusu', 'sagittarius', 'தனு'],
            'மகரம்' => ['magaram', 'capricorn', 'மகர'],
            'கும்பம்' => ['kumbam', 'aquarius', 'கும்ப'],
            'மீனம்' => ['meenam', 'pisces', 'மீன'],
        ];
        foreach ($rasis as $ta => $enList) {
            $taClean = mb_strtolower(preg_replace('/\s+/u', '', $ta));
            if (str_contains($clean, $taClean)) return $ta;
            foreach ($enList as $e) {
                if (str_contains($clean, $e)) return $ta;
            }
        }
        return '';
    }

    public static function matchTamilMonth(string $rawVal): string
    {
        if (empty($rawVal)) return '';
        $clean = mb_strtolower(preg_replace('/\s+/u', '', $rawVal));
        $months = [
            'சித்திரை' => 'chithirai',
            'வைகாசி' => 'vaikasi',
            'ஆனி' => 'aani',
            'ஆடி' => 'aadi',
            'ஆவணி' => 'avani',
            'புரட்டாசி' => 'purattasi',
            'ஐப்பசி' => 'aippasi',
            'கார்த்திகை' => 'karthigai',
            'மார்கழி' => 'margazhi',
            'தை' => 'thai',
            'மாசி' => 'masi',
            'பங்குனி' => 'panguni',
        ];
        $month = '';
        foreach ($months as $ta => $en) {
            $taClean = mb_strtolower(preg_replace('/\s+/u', '', $ta));
            if (str_contains($clean, $taClean) || str_contains($clean, $en)) {
                $month = $ta;
                break;
            }
        }
        $date = '';
        if (preg_match('/\b([0-9]{1,2})\b/', $rawVal, $dM)) {
            $date = $dM[1];
        }
        return trim($month . ' ' . $date);
    }

    public static function matchTamilYear(string $rawVal): string
    {
        if (empty($rawVal)) return '';
        $clean = mb_strtolower(preg_replace('/\s+/u', '', $rawVal));
        $years = [
            'பிரபவ' => 'prabhava', 'விபவ' => 'vibhava', 'சுக்கில' => 'sukla', 'பிரமோதூத' => 'pramodhootha',
            'பிரஜோற்பத்தி' => 'prajopathi', 'ஆங்கீரச' => 'angirasa', 'ஸ்ரீமுக' => 'srimukha', 'பவ' => 'bhava',
            'யுவ' => 'yuva', 'தாது' => 'dhadhu', 'ஈஸ்வர' => 'eswara', 'வெகுதானிய' => 'vehudhanya',
            'பிரமாதி' => 'pramathi', 'விக்ரம' => 'vikrama', 'விஷு' => 'vrusha', 'சித்திரபானு' => 'chitrabhanu',
            'சுபானு' => 'subhanu', 'தாரண' => 'tharana', 'பார்த்திப' => 'parthiba', 'விய' => 'viya',
            'சர்வஜித்' => 'sarvajith', 'சர்வதாரி' => 'sarvadhari', 'விரோதி' => 'virodhi', 'விக்ருதி' => 'vikruthi',
            'கர' => 'kara', 'நந்தன' => 'nandhana', 'விஜய' => 'vijaya', 'ஜய' => 'jaya',
            'மன்மத' => 'manmatha', 'துன்முகி' => 'dunmukhi', 'ஹேவிளம்பி' => 'hevilambi', 'விளம்பி' => 'vilambi',
            'விகாரி' => 'vikari', 'சார்வரி' => 'sarvari', 'பிலவ' => 'plava', 'சுபகிருது' => 'subhakrithu',
            'சோபகிருது' => 'sobhakrithu', 'குரோதி' => 'krodhi', 'விசுவாசுவ' => 'viswavasu', 'பராபவ' => 'parabhava',
            'பிலவங்க' => 'plavanga', 'கீலக' => 'keelaka', 'சௌமிய' => 'saumya', 'சாதாரண' => 'sadharana',
            'விரோதிகிருது' => 'virodhakrithu', 'பரிதாபி' => 'paridhabhi', 'பிரமாதீச' => 'pramadheesa', 'ஆனந்த' => 'anandha',
            'ராட்சச' => 'rakshasa', 'நள' => 'nala', 'பிங்கள' => 'pingala', 'காளயுக்தி' => 'kalayukthi',
            'சித்தார்த்தி' => 'siddharthi', 'ரௌத்திரி' => 'raudhri', 'துன்மதி' => 'dunmathi', 'துந்துபி' => 'dhundhubhi',
            'ருத்ரோத்காரி' => 'rudhrodhkari', 'ரக்தாட்சி' => 'raktakshi', 'குரோதன' => 'krodhana', 'அட்சய' => 'akshaya',
        ];
        foreach ($years as $ta => $en) {
            $taClean = mb_strtolower(preg_replace('/\s+/u', '', $ta));
            if (str_contains($clean, $taClean) || str_contains($clean, $en)) {
                return $ta;
            }
        }
        return '';
    }

    public static function matchComplexion(string $rawVal): string
    {
        if (empty($rawVal)) return '';
        $clean = mb_strtolower(preg_replace('/\s+/u', '', $rawVal));
        if (str_contains($clean, 'veryfair') || str_contains($clean, 'அடர்சிவப்பு') || str_contains($clean, 'அடர்')) {
            return 'அடர் சிவப்பு';
        }
        if (str_contains($clean, 'fair') || str_contains($clean, 'சிவப்பு')) {
            return 'சிவப்பு';
        }
        if (str_contains($clean, 'wheatish') || str_contains($clean, 'medium') || str_contains($clean, 'மாநிறம்') || str_contains($clean, 'மாநிற')) {
            return 'மாநிறம்';
        }
        if (str_contains($clean, 'dark') || str_contains($clean, 'கருப்பு') || str_contains($clean, 'கறுப்பு') || str_contains($clean, 'கருமை') || str_contains($clean, 'கறுத்த')) {
            return 'கருப்பு';
        }
        return '';
    }


    public static function matchNatchathiram(string $rawVal): string
    {
        if (empty($rawVal)) return '';
        $clean = mb_strtolower(preg_replace('/[\s\._\-\–\d\(\)]+/u', '', self::normalizeTamilVisualOrder($rawVal)));
        if (empty($clean)) return '';

        $stars = [
            'அஸ்வினி' => ['ashwini', 'aswini', 'aswathi'],
            'பரணி' => ['bharani', 'barani'],
            'கார்த்திகை' => ['krittika', 'krithika', 'karthigai', 'karthika'],
            'ரோகிணி' => ['rohini'],
            'மிருகசீரிடம்' => ['mrigashira', 'mrigasira', 'mirugaseeridam', 'mirugasirisham'],
            'திருவாதிரை' => ['ardra', 'arudra', 'thiruvathirai', 'thiruvathira'],
            'புனர்பூசம்' => ['punarvasu', 'punarpoosam'],
            'பூசம்' => ['pushya', 'poosam'],
            'ஆயில்யம்' => ['ashlesha', 'aslesha', 'ayilyam', 'aayilyam'],
            'மகம்' => ['magha', 'makha', 'magam'],
            'பூரம்' => ['purva phalguni', 'pooram', 'purvaphalguni'],
            'உத்திரம்' => ['uttara phalguni', 'uthiram', 'uttaraphalguni'],
            'அஸ்தம்' => ['hastha', 'hastham', 'astham'],
            'சித்திரை' => ['chitra', 'chithirai'],
            'சுவாதி' => ['swathi', 'swati'],
            'விசாகம்' => ['vishakha', 'visakam', 'visakha'],
            'அனுஷம்' => ['anuradha', 'anusham'],
            'கேட்டை' => ['jyeshtha', 'jyeshta', 'kettai'],
            'மூலம்' => ['moola', 'moolam'],
            'பூராடம்' => ['purvashadha', 'pooradam', 'purvaashadha'],
            'உத்திராடம்' => ['uttarashadha', 'uthiradam', 'uttaraashadha'],
            'திருவோணம்' => ['shravana', 'sravana', 'thiruvonam', 'thiruonam'],
            'அவிட்டம்' => ['dhanishta', 'avittam'],
            'சதயம்' => ['shatabhisha', 'satabhisha', 'sadhayam', 'sathayam'],
            'பூரட்டாதி' => ['purva bhadrapada', 'poorattathi', 'purvabhadra'],
            'உத்திரட்டாதி' => ['uttara bhadrapada', 'uthirattathi', 'uttarabhadra'],
            'ரேவதி' => ['revathi', 'revati'],
        ];

        // Sort keys by multibyte length descending so compound star names (e.g. பூரட்டாதி, பூராடம்) match before short roots (பூரம்)
        uksort($stars, function($a, $b) {
            return mb_strlen($b, 'UTF-8') <=> mb_strlen($a, 'UTF-8');
        });

        foreach ($stars as $ta => $enList) {
            $taClean = mb_strtolower(preg_replace('/\s+/u', '', $ta));
            if (str_contains($clean, $taClean) || str_contains($taClean, $clean)) {
                return $ta;
            }
            if (mb_strlen($clean, 'UTF-8') >= 4 && (str_starts_with($taClean, mb_substr($clean, 0, 4, 'UTF-8')) || str_starts_with($clean, mb_substr($taClean, 0, 4, 'UTF-8')))) {
                return $ta;
            }
            foreach ($enList as $e) {
                $eClean = mb_strtolower(preg_replace('/\s+/u', '', $e));
                if (str_contains($clean, $eClean) || str_contains($eClean, $clean)) {
                    return $ta;
                }
            }
        }
        return '';
    }

    public static function matchDosham(string $rawVal): string
    {
        if (empty($rawVal)) return '';
        $clean = mb_strtolower(preg_replace('/[\s\._\-\–\(\)]+/u', '', self::normalizeTamilVisualOrder($rawVal)));
        if (empty($clean) || $clean === '-') return '';

        if (str_contains($clean, 'நிவர்த்தி') || str_contains($clean, 'nivarthi')) {
            return 'சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி';
        }
        if (str_contains($clean, 'செவ்வாய்') || str_contains($clean, 'chevvai') || str_contains($clean, 'sevva') || str_contains($clean, 'mars')) {
            return 'செவ்வாய் தோஷம்';
        }
        if (str_contains($clean, 'ராகு') || str_contains($clean, 'கேது') || str_contains($clean, 'rahu') || str_contains($clean, 'ketu')) {
            return 'ராகு கேது தோஷம்';
        }
        if (str_contains($clean, 'சுத்தம்') || str_contains($clean, 'இல்லை') || str_contains($clean, 'clean') || str_contains($clean, 'clear') || str_contains($clean, 'no') || str_contains($clean, 'nil') || str_contains($clean, 'none')) {
            return 'சுத்தம்';
        }
        return '';
    }

        /**
     * High-precision 12-house Kundali chart extractor from PDF text (Rasi & Navamsam)
     */
        /**
     * High-precision 12-house Kundali chart extractor from PDF text (Rasi & Navamsam)
     */
    public static function parseHoroscopeFromPdfText(string $text): array
    {
        $planetsList = [
            'லக்' => ['லக்', 'லக்னம்', 'Asc', 'Ascendant', 'Lagna', 'Lag', 'Lagnam'],
            'சூரி' => ['சூரி', 'சூரியன்', 'Sun', 'Surya', 'Suriya'],
            'சந்' => ['சந்', 'சந்திரன்', 'Moon', 'Chandra', 'Chandran'],
            'செவ்' => ['செவ்', 'செவ்வாய்', 'செவ', 'செ.', 'செ', 'Mars', 'Sevvai', 'Chev', 'குஜ', 'குஜன்', 'Kuja'],
            'புத' => ['புத', 'புதன்', 'Merc', 'Mer', 'Mercury', 'Budha', 'Budhan'],
            'குரு' => ['குரு', 'வியாழன்', 'Jup', 'Jupiter', 'Guru'],
            'சுக்' => ['சுக்', 'சுக்கிரன்', 'Ven', 'Venus', 'Sukra', 'Sukran'],
            'சனி' => ['சனி', 'சனீஸ்வரன்', 'மந்தன்', 'Sat', 'Saturn', 'Sani', 'Shani'],
            'ராகு' => ['ராகு', 'ரா', 'Rahu', 'Raghu'],
            'கேது' => ['கேது', 'கெது', 'கே.', 'கே', 'Ketu', 'Kethu', 'Ket'],
            'மாந்' => ['மாந்', 'மாந்தி', 'Gulika', 'Mand', 'Mandi']
        ];

        // Sanitize UTF-8 & normalize OCR spaces
        $cleanText = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        $cleanText = self::normalizeTamilOcrText($cleanText);
        $cleanText = str_replace("\r", "", $cleanText);
        $lines = explode("\n", $cleanText);

        $extractTokens = function($str) use ($planetsList) {
            $tokens = [];
            $matched = [];
            foreach ($planetsList as $canonical => $aliases) {
                foreach ($aliases as $al) {
                    $pos = 0;
                    while (($found = mb_stripos($str, $al, $pos, 'UTF-8')) !== false) {
                        $matched[] = ['canonical' => $canonical, 'pos' => $found];
                        $pos = $found + mb_strlen($al, 'UTF-8');
                    }
                }
            }
            usort($matched, fn($a, $b) => $a['pos'] <=> $b['pos']);
            foreach ($matched as $m) {
                if (!in_array($m['canonical'], $tokens)) {
                    $tokens[] = $m['canonical'];
                }
            }
            return $tokens;
        };

        $parse4RowGrid = function($fourLines) use ($extractTokens) {
            $chart = array_fill(1, 12, []);
            if (count($fourLines) !== 4) return $chart;
            // Row 1: Houses 12, 1, 2, 3
            $r1 = $extractTokens($fourLines[0]);
            if (count($r1) === 4) {
                $chart[12][] = $r1[0]; $chart[1][] = $r1[1]; $chart[2][] = $r1[2]; $chart[3][] = $r1[3];
            }
            // Row 2: Houses 11 (left), 4 (right)
            $r2 = $extractTokens($fourLines[1]);
            if (count($r2) === 1) {
                $chart[11][] = $r2[0];
            } elseif (count($r2) >= 2) {
                $chart[11][] = $r2[0]; $chart[4][] = $r2[1];
            }
            // Row 3: Houses 10 (left), 5 (right)
            $r3 = $extractTokens($fourLines[2]);
            if (count($r3) === 1) {
                $chart[10][] = $r3[0];
            } elseif (count($r3) >= 2) {
                $chart[10][] = $r3[0]; $chart[5][] = $r3[1];
            }
            // Row 4: Houses 9, 8, 7, 6
            $r4 = $extractTokens($fourLines[3]);
            if (count($r4) === 4) {
                $chart[9][] = $r4[0]; $chart[8][] = $r4[1]; $chart[7][] = $r4[2]; $chart[6][] = $r4[3];
            }
            return $chart;
        };

        // Strategy 1: Explicit House Labels on lines (e.g. "1 மேஷம்: சூரி", "12: லக்")
        $mapGridLines = function($gridLines) use ($extractTokens, $planetsList) {
            $chart = array_fill(1, 12, []);
            if (empty($gridLines)) return $chart;

            $houseMap = [
                'மேஷம்' => 1, 'ரிஷபம்' => 2, 'மிதுனம்' => 3, 'கடகம்' => 4,
                'சிம்மம்' => 5, 'கன்னி' => 6, 'துலாம்' => 7, 'விருச்சிகம்' => 8,
                'தனுசு' => 9, 'மகரம்' => 10, 'கும்பம்' => 11, 'மீனம்' => 12,
                'Aries' => 1, 'Taurus' => 2, 'Gemini' => 3, 'Cancer' => 4,
                'Leo' => 5, 'Virgo' => 6, 'Libra' => 7, 'Scorpio' => 8,
                'Sagittarius' => 9, 'Capricorn' => 10, 'Aquarius' => 11, 'Pisces' => 12
            ];

            $matchedByHouseLabel = false;
            foreach ($gridLines as $lineIdx => $l) {
                $occurrences = [];
                foreach ($houseMap as $name => $hNum) {
                    $pos = 0;
                    while (($found = mb_stripos($l, $name, $pos, 'UTF-8')) !== false) {
                        $occurrences[] = ['hNum' => $hNum, 'pos' => $found, 'len' => mb_strlen($name, 'UTF-8')];
                        $pos = $found + mb_strlen($name, 'UTF-8');
                    }
                }
                if (preg_match_all('/\b([1-9]|1[0-2])\s*[:=\-–\.]/u', $l, $numMatches, PREG_OFFSET_CAPTURE)) {
                    foreach ($numMatches[0] as $idx => $m) {
                        $occurrences[] = ['hNum' => intval($numMatches[1][$idx][0]), 'pos' => $m[1], 'len' => mb_strlen($m[0], 'UTF-8')];
                    }
                }

                if (!empty($occurrences)) {
                    usort($occurrences, fn($a, $b) => $a['pos'] <=> $b['pos']);
                    for ($i = 0; $i < count($occurrences); $i++) {
                        $curr = $occurrences[$i];
                        $startPos = $curr['pos'] + $curr['len'];
                        $endPos = ($i + 1 < count($occurrences)) ? $occurrences[$i + 1]['pos'] : mb_strlen($l, 'UTF-8');
                        $segment = mb_substr($l, $startPos, $endPos - $startPos, 'UTF-8');
                        $planets = $extractTokens($segment);
                        if (empty($planets) && $i === count($occurrences) - 1 && isset($gridLines[$lineIdx + 1])) {
                            $nextLine = trim($gridLines[$lineIdx + 1]);
                            $nextHasHouse = false;
                            foreach ($houseMap as $name => $hNum) {
                                if (mb_stripos($nextLine, $name, 0, 'UTF-8') !== false) {
                                    $nextHasHouse = true; break;
                                }
                            }
                            if (!$nextHasHouse) {
                                $planets = $extractTokens($nextLine);
                            }
                        }
                        foreach ($planets as $p) {
                            if (!in_array($p, $chart[$curr['hNum']])) {
                                $chart[$curr['hNum']][] = $p;
                                $matchedByHouseLabel = true;
                            }
                        }
                    }
                }
            }

            if ($matchedByHouseLabel) {
                $seen = [];
                for ($h = 1; $h <= 12; $h++) {
                    $chart[$h] = array_values(array_filter($chart[$h], function($p) use (&$seen) {
                        if (isset($seen[$p])) return false;
                        $seen[$p] = true;
                        return true;
                    }));
                }
                return $chart;
            }

            return array_fill(1, 12, []);
        };

        $inRasi = false;
        $inNav = false;
        $inBoth = false;
        $rasiLines = [];
        $navLines = [];
        $allPlanetLines = [];

        foreach ($lines as $line) {
            $trim = trim($line);
            if (empty($trim)) continue;
            if (preg_match('/^(?:ராசி|Rasi)\s*[:=–\-]/ui', $trim)) continue;

            if (preg_match('/(?:ராசி|Rasi)[\s\t]+(?:நவாம்சம்|Navamsam)/ui', $trim)) {
                $inBoth = true; $inRasi = false; $inNav = false;
                continue;
            }
            if (preg_match('/^(?:நவாம்சம்|Navamsam|நவாம்ச)(?:\s*கட்டம்|\s*Chart)?$/ui', $trim) || 
                (preg_match('/(?:நவாம்சம்|Navamsam)/ui', $trim) && !preg_match('/[:=–\-]/', $trim))) {
                $inBoth = false; $inRasi = false; $inNav = true;
                $rem = trim(preg_replace('/^(?:நவாம்சம்|Navamsam|நவாம்ச)(?:\s*கட்டம்|\s*Chart)?/ui', '', $trim));
                if (!empty($rem) && $rem !== 'நவா' && !preg_match('/^[0-9\s]+$/', $rem)) {
                    $navLines[] = $rem;
                }
                continue;
            }
            if (preg_match('/^(?:ராசி|Rasi)(?:\s*கட்டம்|\s*Chart)?$/ui', $trim) || 
                (preg_match('/^(?:ராசி|Rasi)$/ui', $trim))) {
                $inBoth = false; $inRasi = true; $inNav = false;
                $rem = trim(preg_replace('/^(?:ராசி|Rasi)(?:\s*கட்டம்|\s*Chart)?/ui', '', $trim));
                if (!empty($rem) && $rem !== 'ராசி' && !preg_match('/^[0-9\s]+$/', $rem)) {
                    $rasiLines[] = $rem;
                }
                continue;
            }
            if (preg_match('/(?:திசை\s*இருப்\s*பு|திசை\s*இருப்பு|Dasa\s*Balance|இதர\s*குறிப்\s*புகள்|இதர\s*குறிப்புகள்|Other\s*Notes|எதிர்பார்ப்பு)/ui', $trim)) {
                $inBoth = false; $inRasi = false; $inNav = false;
            }

            if ($inBoth) {
                if (count($extractTokens($trim)) > 0) {
                    $allPlanetLines[] = $trim;
                }
                if (strpos($trim, "\t") !== false) {
                    $parts = explode("\t", $trim);
                    $p0 = trim($parts[0]);
                    $p1 = trim($parts[count($parts) - 1]);
                    if (!empty($p0)) $rasiLines[] = $p0;
                    if (!empty($p1)) $navLines[] = $p1;
                } else {
                    $rasiLines[] = $trim;
                }
            } elseif ($inRasi) {
                if ($trim !== 'ராசி' && !preg_match('/^[0-9\s]+$/', $trim)) {
                    $rasiLines[] = $trim;
                }
            } elseif ($inNav) {
                if ($trim !== 'நவா' && $trim !== 'நவாம்சம்' && !preg_match('/^[0-9\s]+$/', $trim)) {
                    $navLines[] = $trim;
                }
            }
        }

        $rChart = $mapGridLines($rasiLines);
        $nChart = $mapGridLines($navLines);

        $rCount = count(array_filter($rChart));
        $nCount = count(array_filter($nChart));

        // Strategy 2: 4-Row South Indian Grid Fallback
        if (($rCount < 4 || $nCount < 4) && count($allPlanetLines) === 8) {
            $rGrid = array_slice($allPlanetLines, 0, 4);
            $nGrid = array_slice($allPlanetLines, 4, 4);
            $rChart = $parse4RowGrid($rGrid);
            $nChart = $parse4RowGrid($nGrid);
        } elseif ($rCount < 4 && count($allPlanetLines) === 4) {
            $rChart = $parse4RowGrid($allPlanetLines);
        }

        // Strategy 3: Side-by-side dual chart line scan & global document scan
        $rCount = count(array_filter($rChart));
        $nCount = count(array_filter($nChart));
        if ($rCount < 4 || $nCount < 4) {
            $houseNames = [
                'மேஷம்' => 1, 'ரிஷபம்' => 2, 'மிதுனம்' => 3, 'கடகம்' => 4,
                'சிம்மம்' => 5, 'கன்னி' => 6, 'துலாம்' => 7, 'விருச்சிகம்' => 8,
                'தனுசு' => 9, 'மகரம்' => 10, 'கும்பம்' => 11, 'மீனம்' => 12,
                'Aries' => 1, 'Taurus' => 2, 'Gemini' => 3, 'Cancer' => 4,
                'Leo' => 5, 'Virgo' => 6, 'Libra' => 7, 'Scorpio' => 8,
                'Sagittarius' => 9, 'Capricorn' => 10, 'Aquarius' => 11, 'Pisces' => 12
            ];
            foreach ($lines as $line) {
                $t = trim($line);
                if (!$t || preg_match('/^(?:ராசி|Rasi)\s*[:=–\-]/ui', $t)) continue;
                $hasHouse = false;
                foreach ($houseNames as $hn => $h) {
                    if (mb_strpos($t, $hn) !== false) { $hasHouse = true; break; }
                }
                if (!$hasHouse) continue;

                $rPart = $t;
                $nPart = '';
                foreach ([12 => 'மீனம்', 11 => 'கும்பம்', 10 => 'மகரம்', 9 => 'தனுசு'] as $hNum => $hName) {
                    $pos1 = mb_strpos($t, $hName);
                    if ($pos1 !== false) {
                        $pos2 = mb_strpos($t, $hName, $pos1 + mb_strlen($hName));
                        if ($pos2 !== false) {
                            $cut = $pos2;
                            $prefix = mb_substr($t, 0, $pos2);
                            if (preg_match('/\b(?:' . $hNum . ')\s*$/u', $prefix, $pm)) {
                                $cut -= mb_strlen($pm[0]);
                            }
                            $rPart = trim(mb_substr($t, 0, $cut));
                            $nPart = trim(mb_substr($t, $cut));
                            break;
                        }
                    }
                }
                if (empty($nPart)) {
                    if (preg_match('/^(.*?)(?:\s{4,}|\t|\s*\|\s*|(?:(?<=\s)நவாம்சம்|(?<=\s)Navamsam))(.*)$/ui', $t, $sp)) {
                        $rPart = trim($sp[1]);
                        $nPart = trim($sp[2]);
                    }
                }
                if ($rPart) {
                    $mR = $mapGridLines([$rPart]);
                    foreach ($mR as $h => $pl) {
                        if (!empty($pl) && empty($rChart[$h])) $rChart[$h] = $pl;
                    }
                }
                if ($nPart) {
                    $mN = $mapGridLines([$nPart]);
                    foreach ($mN as $h => $pl) {
                        if (!empty($pl) && empty($nChart[$h])) $nChart[$h] = $pl;
                    }
                }
            }
        }

        $rCount = count(array_filter($rChart));
        if ($rCount < 4) {
            $globalChart = $mapGridLines($lines);
            if (count(array_filter($globalChart)) >= 1) {
                $rChart = $globalChart;
            }
        }

        return [
            'rasi_chart' => $rChart,
            'navamsam_chart' => $nChart
        ];
    }

    public static function parseSriAngalammanRows(string $text): array
    {
        $rawPdfText = $text;
        $data = [];

        // 1. Name & Community
        if (preg_match('/(?:Name|வரன்\s*பெயர்|மணமகன்\s*பெயர்|மணமகள்\s*பெயர்)\s*[:=–\-]?\s*([^\r\n]+)/ui', $text, $nm) || (preg_match('/(?:^|[\r\n])(?:பெயர்)\s*[:=–\-]?\s*([^\r\n]+)/ui', $text, $nm) && !str_contains($nm[0], 'நிறுவனம்') && !str_contains($nm[0], 'தந்தை') && !str_contains($nm[0], 'தாய்'))) {
            $line = trim($nm[1]);
            if (preg_match('/(?:Sengunthar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|செங்குந்தர்)\s*[✓✔]/ui', $text) || preg_match('/[✓✔]\s*(?:Sengunthar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|செங்குந்தர்)/ui', $text)) {
                $data['community'] = 'செங்குந்தர்';
            } elseif (preg_match('/(?:Kaikkolar|கை\s*க்\s*கோ\s*ள\s*ர்|கைக்கோளர்)\s*[✓✔]/ui', $text) || preg_match('/[✓✔]\s*(?:Kaikkolar|கை\s*க்\s*கோ\s*ள\s*ர்|கைக்கோளர்)/ui', $text)) {
                $data['community'] = 'கைக்கோளர்';
            } elseif (preg_match('/Sengunthar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்/ui', $line) || preg_match('/Sengunthar|செங்குந்தர்/ui', $text)) {
                $data['community'] = 'செங்குந்தர்';
            } elseif (preg_match('/Kaikkolar|கை\s*க்\s*கோ\s*ள\s*ர்/ui', $line)) {
                $data['community'] = 'கைக்கோளர்';
            }

            $cleanNm = preg_replace('/(?:\s*\[[ ✓xX0-9]*\]\s*|\s+[✓✔☑]\s*|\s+)(?:Sengunthar|Kaikkolar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|கை\s*க்\s*கோ\s*ள\s*ர்|செங்குந்தர்|கைக்கோளர்)\s*.*$/ui', '', $line);
            $cleanNm = preg_replace('/^(?:Mr\.?|Ms\.?|செல்வன்|செல்வி|திரு|திருமதி)\s+/ui', '', $cleanNm);
            $cleanNm = preg_replace('/[★✦■●▲▼♦♣♠✓✔☑]/u', '', $cleanNm);
            $cleanNm = preg_replace('/^[0-9\s:–\.\-_]+/u', '', $cleanNm);
            $cleanNm = preg_replace('/[\(\[\{][0-9✓✔☑\s\-_–\.\/\*]*[\)\]\}]?/u', '', $cleanNm);
            $cleanNm = preg_replace('/\s*[\(\[]?\s*[0-9]+\s*[\)\]]?\s*$/u', '', $cleanNm);
            $data['name'] = trim($cleanNm);
        }

        // 2. DOB, Time, Place
        if (empty($data['dob']) && preg_match('/(?:DOB|பிறந்த\s*தேதி)\s*[:=–\-\.·~]?\s*([0-9]{1,2}[-\/.][0-9]{1,2}[-\/.][0-9]{2,4})/ui', $text, $dm)) {
            $p = preg_split('/[-\/.]/', $dm[1]);
            if (count($p) === 3) {
                $data['dob'] = strlen($p[2]) === 4 ? sprintf('%04d-%02d-%02d', $p[2], $p[1], $p[0]) : sprintf('%04d-%02d-%02d', $p[0], $p[1], $p[2]);
            }
        }
        if (empty($data['birth_time']) && preg_match('/(?:Time|நேரம்|பிறந்த\s*நேரம்)\s*[:=–\-\.·~]?\s*([0-9]{1,2}\s*[:.]\s*[0-9]{2}(?:\s*(?:AM|PM|am|pm))?)/ui', $text, $tm)) {
            $data['birth_time'] = preg_replace('/\s*:\s*/', ':', trim($tm[1]));
        }
        if (empty($data['birth_place']) && preg_match('/(?:Place|பிறந்த\s*ஊர்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Education|படிப்பு|கல்வி)|[\r\n]|$)/ui', $text, $pm)) {
            $data['birth_place'] = trim($pm[1]);
        }

        // 3. Education & Job
        if (empty($data['education']) && preg_match('/(?:Education|படிப்பு|கல்வி)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=(?:Job|வேலை|பணி|தொழில்)\s*[:=–\-\.·~]|[\r\n]|$)/ui', $text, $em)) {
            $data['education'] = trim($em[1]);
        }
        if (empty($data['job_title'])) {
            $textLines = explode("\n", $text);
            foreach ($textLines as $idx => $jl) {
                if ((mb_stripos($jl, 'படிப்பு') !== false || mb_stripos($jl, 'வேலை') !== false || mb_stripos($jl, 'education') !== false || mb_stripos($jl, 'job') !== false) && !str_contains($jl, 'தந்தை') && !str_contains($jl, 'தாய்') && !mb_stripos($jl, 'father') && !mb_stripos($jl, 'mother')) {
                    if (preg_match('/(?:Job|வேலை|பணி|தொழில்|Designation|Occupation)\s*[:=–\-]\s*([^\r\n:]+?)(?=\s+(?:Company|நிறுவனம்)|$)/ui', $jl, $jm)) {
                        $jVal = trim($jm[1]);
                        if (!empty($jVal) && $jVal !== ':') {
                            $data['job_title'] = $jVal;
                            break;
                        }
                    } elseif (preg_match('/^(?:Job|வேலை|பணி|தொழில்|Designation|Occupation)\s*[:=–\-]?$/ui', trim($jl))) {
                        $nextL = trim($textLines[$idx + 1] ?? '');
                        if (!empty($nextL) && !str_contains($nextL, ':')) {
                            $data['job_title'] = $nextL;
                            break;
                        }
                    }
                }
            }
        }
        if (empty($data['job_title']) && preg_match('/(?:^|[\r\n\s])(?:Job|Designation|Occupation|வேலை|பணி|தொழில்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s*(?:Company\s*&|Company|நிறுவனம்)|[\r\n]|$)/ui', $text, $sJm)) {
            $data['job_title'] = trim($sJm[1]);
        }

        // 4. Company & Income
        if (empty($data['company_details']) && preg_match('/(?:Company\s*Name\s*&\s*Location|Company\s*&\s*Town|Company\s*&\s*Location|Company\s*Name|Company|நிறுவனம்\s*பெயர்\s*&\s*ஊர்|நிறுவனம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Monthly\s*Income|Income|மாத\s*வருமானம்|வருமானம்)|[\r\n]|$)/ui', $text, $cm)) {
            $data['company_details'] = trim($cm[1]);
        }

        // Sanity guard: Check if job and company got swapped (e.g. Employee in company_details)
        $isJobDesig = function($str) {
            return preg_match('/^(?:Employee|Self\s*Employed|Business|Software\s*Engineer|Engineer|Manager|Doctor|Teacher|Lawyer|Officer|Clerk|Coolie|Farmer|Driver|Police|Army|Navy|Banker|Auditor|Accountant|Private\s*Employee|Govt\s*Employee)$/ui', trim($str));
        };
        $hasCompanyLoc = function($str) {
            return preg_match('/(?:Tech|Technologies|Software|Solutions|Systems|Services|Pvt|Ltd|Limited|Corp|Erode|Chennai|Coimbatore|Salem|Bangalore|Bengaluru|Tirupur|Namakkal|\.com|\.in)/ui', trim($str));
        };

        if (!empty($data['company_details']) && ($isJobDesig($data['company_details']) || ($hasCompanyLoc($data['job_title'] ?? '') && $isJobDesig($data['company_details'])))) {
            if (empty($data['job_title']) || $data['job_title'] === $data['company_details']) {
                $data['job_title'] = $data['company_details'];
                $data['company_details'] = '';
            } else {
                $temp = $data['job_title'];
                $data['job_title'] = $data['company_details'];
                $data['company_details'] = $temp;
            }
        } elseif (!empty($data['job_title']) && $hasCompanyLoc($data['job_title']) && (empty($data['company_details']) || $data['company_details'] === '-')) {
            $data['company_details'] = $data['job_title'];
            $data['job_title'] = 'Employee';
        }

        if (empty($data['monthly_income']) && preg_match('/(?:Income|மாத\s*வருமானம்|வருமானம்)\s*[:=–\-\.·~]?\s*([0-9,]+)/ui', $text, $im)) {
            $data['monthly_income'] = str_replace(',', '', trim($im[1]));
        }

        // 5. Height, Weight, Complexion
        if (empty($data['height']) && preg_match('/(?:Height|உயரம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Weight|எடை)|[\r\n]|$)/ui', $text, $hm)) {
            $data['height'] = trim($hm[1]);
        }
        if (empty($data['weight']) && preg_match('/(?:Weight|எடை)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Complexion|நிறம்)|[\r\n]|$)/ui', $text, $wm)) {
            $data['weight'] = trim($wm[1]);
        }
        if (empty($data['complexion']) && preg_match('/(?:Complexion|நிறம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Kuladeivam|குலதெய்வம்)|[\r\n]|$)/ui', $text, $cpm)) {
            $rawC = trim($cpm[1]);
            if (preg_match('/very\s*fair|அடர்\s*சிவப்பு|மிக\s*சிவப்பு/ui', $rawC)) {
                $data['complexion'] = 'அடர் சிவப்பு';
            } elseif (preg_match('/fair|சிவப்பு/ui', $rawC)) {
                $data['complexion'] = 'சிவப்பு';
            } elseif (preg_match('/wheatish|மாநிறம்/ui', $rawC)) {
                $data['complexion'] = 'மாநிறம்';
            } elseif (preg_match('/dark|கருப்பு|கறுப்பு/ui', $rawC)) {
                $data['complexion'] = 'கருப்பு';
            } else {
                $data['complexion'] = $rawC;
            }
        }

        // 6. Kuladeivam
        if (empty($data['kuladeivam']) && preg_match('/(?:Kuladeivam\s*&\s*Town|Kuladeivam|குலதெய்வம்[,\s]*ஊர்|குலதெய்வம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Gothram|கோத்திரம்)|[\r\n]|$)/ui', $text, $km)) {
            $rawK = trim($km[1]);
            $rawK = preg_replace('/^(?:[,\s]*ஊர்\s*[:=–\-\.·~]?\s*)/ui', '', $rawK);
            $data['kuladeivam'] = trim($rawK);
        }

        // 7. Gothram & Kootam
        if (empty($data['gothram']) && preg_match('/(?:Gothram|கோத்திரம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Kootam|கூட்டம்)|[\r\n]|$)/ui', $text, $gm)) {
            $data['gothram'] = trim($gm[1]);
        }
        if (empty($data['kootam']) && preg_match('/(?:Kootam|கூட்டம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Father|தந்தை)|[\r\n]|$)/ui', $text, $ktm)) {
            $data['kootam'] = trim($ktm[1]);
        }

        // 8. Father Details
        if (empty($data['father_name']) && preg_match('/(?:Father\s*Name|தந்தை\s*பெயர்)\s*[:=–\-\.·~]?\s*([^\r\n]+)/ui', $text, $fnm)) {
            $fLine = trim($fnm[1]);
            if (preg_match('/(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-\.·~]?\s*([0-9]{8,12})/ui', $fLine, $fmm)) {
                $data['father_mobile'] = trim($fmm[1]);
                $fLine = trim(preg_replace('/(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-\.·~]?\s*[0-9]{8,12}/ui', '', $fLine));
            }
            $data['father_name'] = $fLine;
        }
        if (empty($data['father_mobile'])) {
            if (preg_match('/(?:Father\s*Name|தந்தை\s*பெயர்)[^\r\n]*[\r\n]+(?:[^\r\n]*[\r\n]+)?(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-\.·~]?\s*([0-9]{8,12})/ui', $text, $fmm2)) {
                $data['father_mobile'] = trim($fmm2[1]);
            }
        }
        if (empty($data['father_job']) && preg_match('/(?:Father\s*Job|Father\s*Occupation|தந்தை\s*வேலை|தந்தை\s*பணி|தந்தையின்\s*பணி|தந்தை\s*தொழில்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Native\s*Place|பூர்வீகம்)|[\r\n]|$)/ui', $text, $fjm)) {
            $data['father_job'] = trim($fjm[1]);
        }
        if (empty($data['father_native'])) {
            if (preg_match('/(?:Father\s*Native|தந்தை\s*ஊர்|தந்தையின்\s*ஊர்|தந்தை\s*பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+)/ui', $text, $fnpm0)) {
                $data['father_native'] = trim($fnpm0[1]);
            } elseif (preg_match('/(?:Father\s*Job|தந்தை\s*வேலை|தந்தை\s*பணி|தந்தையின்\s*பணி)[^\r\n]*?(?:Native\s*Place|பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Mother|தாய்)|[\r\n]|$)/ui', $text, $fnpm)) {
                $data['father_native'] = trim($fnpm[1]);
            } elseif (preg_match('/(?:Father\s*Job|தந்தை\s*வேலை|தந்தை\s*பணி|தந்தையின்\s*பணி)[^\r\n]*[\r\n]+(?:Native\s*Place|பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+)/ui', $text, $fnpm2)) {
                $data['father_native'] = trim($fnpm2[1]);
            }
        }

        // 9. Mother Details
        if (empty($data['mother_name']) && preg_match('/(?:Mother\s*Name|தாய்\s*பெயர்|தாயார்\s*பெயர்)\s*[:=–\-\.·~]?\s*([^\r\n]+)/ui', $text, $mnm)) {
            $mLine = trim($mnm[1]);
            if (preg_match('/(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-]?\s*([0-9]{8,12})/ui', $mLine, $mmm)) {
                $data['mother_mobile'] = trim($mmm[1]);
                $mLine = trim(preg_replace('/(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-]?\s*[0-9]{8,12}/ui', '', $mLine));
            }
            $data['mother_name'] = $mLine;
        }
        if (empty($data['mother_mobile'])) {
            if (preg_match('/(?:Mother\s*Name|தாய்\s*பெயர்|தாயார்\s*பெயர்)[^\r\n]*[\r\n]+(?:[^\r\n]*[\r\n]+)?(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-]?\s*([0-9]{8,12})/ui', $text, $mmm2)) {
                $data['mother_mobile'] = trim($mmm2[1]);
            }
        }
        if (empty($data['mother_job']) && preg_match('/(?:Mother\s*Job|Mother\s*Occupation|தாய்\s*வேலை|தாயார்\s*வேலை|தாய்\s*பணி|தாயின்\s*பணி)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Native\s*Place|பூர்வீகம்)|[\r\n]|$)/ui', $text, $mjm)) {
            $data['mother_job'] = trim($mjm[1]);
        }
        if (empty($data['mother_native'])) {
            if (preg_match('/(?:Mother\s*Native|தாய்\s*ஊர்|தாயார்\s*ஊர்|தாயின்\s*ஊர்|தாய்\s*பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+)/ui', $text, $mnpm0)) {
                $data['mother_native'] = trim($mnpm0[1]);
            } elseif (preg_match('/(?:Mother\s*Job|தாய்\s*வேலை|தாய்\s*பணி|தாயின்\s*பணி)[^\r\n]*?(?:Native\s*Place|பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Address|முகவரி)|[\r\n]|$)/ui', $text, $mnpm)) {
                $data['mother_native'] = trim($mnpm[1]);
            } elseif (preg_match('/(?:Mother\s*Job|தாய்\s*வேலை|தாய்\s*பணி|தாயின்\s*பணி)[^\r\n]*[\r\n]+(?:Native\s*Place|பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+)/ui', $text, $mnpm2)) {
                $data['mother_native'] = trim($mnpm2[1]);
            }
        }

        // Family Mobile Number Fallback (Checks all 10-digit mobile numbers in document, excluding founder)
        if (empty($data['father_mobile']) || empty($data['mother_mobile'])) {
            if (preg_match_all('/\b([6-9][0-9]{9})\b/ui', $text, $allM)) {
                $validMobiles = array_values(array_filter(array_unique($allM[1]), function($num) {
                    return $num !== '9080849042';
                }));
                if (empty($data['father_mobile']) && isset($validMobiles[0])) {
                    $data['father_mobile'] = $validMobiles[0];
                }
                if (empty($data['mother_mobile']) && isset($validMobiles[1])) {
                    $data['mother_mobile'] = $validMobiles[1];
                }
            }
        }

        // 10. Address & Wealth
        if (preg_match('/(?:Address|முகவரி)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Family\s*Wealth|குடும்ப\s*சொத்து|சொத்து)|[\r\n]|$)/ui', $text, $adm)) {
            $data['address'] = trim($adm[1]);
        }
        if (preg_match('/(?:Family\s*Wealth\s*[\/\&]\s*Assets|Family\s*Wealth|Assets|குடும்ப\s*வருமானம்\s*[\/\&]?\s*வசதிகள்|குடும்ப\s*வருமானம்|குடும்ப\s*சொத்து|சொத்து)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Siblings|உடன்பிறந்தோர்)|[\r\n]|$)/ui', $text, $awm)) {
            $rawW = trim($awm[1]);
            $rawW = preg_replace('/^[\s\{\[\(]*[வள][சஸ][ததிஜஜி][களக்][ளள்]?[ \t]*[:=–\-]?[\s\}\]\)]*\s*/ui', '', $rawW);
            $rawW = preg_replace('/^(?:[\/\&,\s]*வசதிகள்\s*[:=–\-]?\s*)/ui', '', $rawW);
            $data['family_wealth'] = trim($rawW);
        }

        // 11. Siblings
        $cleanSibText = function($s) {
            if (!$s) return '';
            $s = trim($s);
            $s = preg_replace('/^\s*(?:(?:உடன்\s*பிறந்தோர்|சகோதரர்கள்?|சகோதரிகள்?|Siblings?|Brothers?|Sisters?)[,\s]*)*(?:உறவினர்\s*விபரம்|உறவினர்|Relatives?\s*Details?)[\s:=–\-]*/ui', '', $s);
            $s = preg_replace('/(?:உறவினர்\s*விபரம்|Relatives?\s*Details?)[\s:=–\-]*/ui', '', $s);
            return trim($s, " ,;:-–\t\n\r");
        };

        if (preg_match('/(?:Siblings\s*&\s*Relatives|Siblings|உடன்\s*பிறந்தோர்(?:[,\s]*உறவினர்\s*விபரம்)?)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Family|Wealth|Assets|குடும்ப|வசதிகள்|சொத்து|முகவரி|Address|கைபேசி|Mobile|ராசி|Rasi|நட்சத்திரம்|Star|லக்னம்|Lagnam)|[\r\n]|$)/ui', $text, $sbm)) {
            $rawSib = preg_replace('/[\r\n]+/u', ' ', trim($sbm[1]));
            $rawSib = preg_replace('/\s+/u', ' ', $rawSib);
            $rawSib = $cleanSibText($rawSib);
            // Fix OCR trailing ")ர்" -> ")"
            $rawSib = preg_replace('/\)\s*[\x{0B80}-\x{0BFF}\x{0BCD}]+$/u', ')', $rawSib);
            $data['siblings_details'] = $rawSib;

            if (preg_match('/(?:Brothers|சகோதரர்கள்|சகோதரர்)\s*[:=–\-\.·~]?\s*([^,\;]+?)(?=(?:Sisters|சகோதரிகள்|சகோதரி)|[\,\;]|$)/ui', $rawSib, $brm)) {
                $data['brothers'] = $cleanSibText($brm[1]);
            }
            if (preg_match('/(?:Sisters|சகோதரிகள்|சகோதரி)\s*[:=–\-\.·~]?\s*([^,\;]+)/ui', $rawSib, $srm)) {
                $data['sisters'] = $cleanSibText($srm[1]);
            }

            if (empty($data['brothers']) && empty($data['sisters'])) {
                $hasBro = preg_match('/(?:தம்பி|அண்ணன்|brother|younger\s*brother|elder\s*brother)/ui', $rawSib);
                $hasSis = preg_match('/(?:அக்கா|தங்கை|sister|younger\s*sister|elder\s*sister)/ui', $rawSib);
                $isDocTa = preg_match('/[\x{0B80}-\x{0BFF}]/u', $rawSib);
                $noneVal = $isDocTa ? 'இல்லை' : 'None';
                if ($hasBro && !$hasSis) {
                    $data['brothers'] = $cleanSibText($rawSib);
                    $data['sisters'] = $noneVal;
                } elseif ($hasSis && !$hasBro) {
                    $data['sisters'] = $cleanSibText($rawSib);
                    $data['brothers'] = $noneVal;
                } elseif ($hasBro && $hasSis) {
                    $parts = preg_split('/[,;]|\s+மற்றும்\s+/u', $rawSib);
                    foreach ($parts as $part) {
                        $pTrim = trim($part);
                        if (preg_match('/(?:தம்பி|அண்ணன்|brother)/ui', $pTrim) && empty($data['brothers'])) {
                            $data['brothers'] = $cleanSibText($pTrim);
                        } elseif (preg_match('/(?:அக்கா|தங்கை|sister)/ui', $pTrim) && empty($data['sisters'])) {
                            $data['sisters'] = $cleanSibText($pTrim);
                        }
                    }
                }
            }
        }

        // 12. Astrology: Rasi, Star, Lagnam, Dosham, Dasa Balance
        if (preg_match('/(?:ரா\s*சி|இ\s*ரா\s*சி|Rasi)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:ந\s*ட்\s*ச\s*த்\s*தி\s*ர|Star)|[\r\n]|$)/ui', $text, $rm)) {
            $valClean = preg_replace('/[^\p{L}\p{M}]+/u', '', $rm[1]);
            $valClean = preg_replace('/([\x{0BBE}-\x{0BCD}\x{0BD7}])\1+/u', '$1', $valClean);
            $rasis = ['மேஷம்', 'ரிஷபம்', 'மிதுனம்', 'கடகம்', 'சிம்மம்', 'கன்னி', 'துலாம்', 'விருச்சிகம்', 'தனுசு', 'மகரம்', 'கும்பம்', 'மீனம்'];
            if (!empty($valClean) && mb_strlen($valClean) >= 3) {
                foreach ($rasis as $rta) {
                    $base = mb_substr($rta, 0, -1);
                    if (mb_strpos($valClean, $rta) !== false || mb_strpos($valClean, $base) !== false || mb_strpos($rta, $valClean) !== false) {
                        $data['rasi'] = $rta;
                        break;
                    }
                }
            }
            if (empty($data['rasi'])) {
                $data['rasi'] = self::matchRasi($rm[1]);
            }
        }

        if (preg_match('/(?:ந\s*ட்\s*ச\s*த்\s*தி\s*ர\s*ம்|ந\s*ட்\s*ச\s*த்\s*தி\s*ர|Star)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:ல\s*க்\s*ன\s*ம்|Lagnam)|[\r\n]|$)/ui', $text, $sm)) {
            $valClean = preg_replace('/[^\p{L}\p{M}]+/u', '', $sm[1]);
            $valClean = preg_replace('/([\x{0BBE}-\x{0BCD}\x{0BD7}])\1+/u', '$1', $valClean);
            $stars = ['பூரட்டாதி', 'உத்திரட்டாதி', 'மிருகசீரிடம்', 'திருவாதிரை', 'புனர்பூசம்', 'உத்திராடம்', 'திருவோணம்', 'கார்த்திகை', 'ஆயில்யம்', 'சித்திரை', 'விசாகம்', 'பூராடம்', 'அவிட்டம்', 'அஸ்வினி', 'ரோகிணி', 'உத்திரம்', 'கேட்டை', 'பரணி', 'பூசம்', 'சுவாதி', 'அனுஷம்', 'சதயம்', 'ரேவதி', 'பூரம்', 'மகம்', 'மூலம்', 'அஸ்தம்'];
            usort($stars, fn($a, $b) => mb_strlen($b, 'UTF-8') <=> mb_strlen($a, 'UTF-8'));
            if (!empty($valClean) && mb_strlen($valClean) >= 3) {
                foreach ($stars as $sta) {
                    if (mb_strpos($valClean, $sta) !== false || mb_strpos($sta, $valClean) !== false) {
                        $data['natchathiram'] = $sta;
                        break;
                    }
                    if (mb_strlen($valClean, 'UTF-8') >= 4 && (str_starts_with($sta, mb_substr($valClean, 0, 4, 'UTF-8')) || str_starts_with($valClean, mb_substr($sta, 0, 4, 'UTF-8')))) {
                        $data['natchathiram'] = $sta;
                        break;
                    }
                }
            }
            if (empty($data['natchathiram'])) {
                $data['natchathiram'] = self::matchNatchathiram($sm[1]);
            }
        }

        if (preg_match('/(?:ல\s*க்\s*ன\s*ம்|Lagnam)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:சு\s*த்\s*த\s*ம்|தோ\s*ஷ\s*ம்|Dosham)|[\r\n]|$)/ui', $text, $lm)) {
            $valClean = preg_replace('/[^\p{L}\p{M}]+/u', '', $lm[1]);
            $valClean = preg_replace('/([\x{0BBE}-\x{0BCD}\x{0BD7}])\1+/u', '$1', $valClean);
            $rasis = ['மேஷம்', 'ரிஷபம்', 'மிதுனம்', 'கடகம்', 'சிம்மம்', 'கன்னி', 'துலாம்', 'விருச்சிகம்', 'தனுசு', 'மகரம்', 'கும்பம்', 'மீனம்'];
            if (!empty($valClean) && mb_strlen($valClean) >= 3) {
                foreach ($rasis as $rta) {
                    $base = mb_substr($rta, 0, -1);
                    if (mb_strpos($valClean, $rta) !== false || mb_strpos($valClean, $base) !== false || mb_strpos($rta, $valClean) !== false) {
                        $data['lagnam'] = $rta;
                        break;
                    }
                }
            }
            if (empty($data['lagnam'])) {
                $data['lagnam'] = self::matchRasi($lm[1]);
            }
        }

        // Precise Dosham Checkbox & Astrology Row Matching
        $chkMarkPattern = '(?:\[\s*[✓✔☑xX*■]\s*\]|\(\s*[✓✔☑xX*■]\s*\)|[✓✔☑■])';
        $rahuPattern = '(?:ரா\s*கு\s*[\/\-]?\s*கே\s*து|ராகு\s*கேது|ராகு|Rahu|Ketu)';
        $sevvaiPattern = '(?:செ\s*வ்\s*வா\s*ய்|செவ்வாய்|Sevvai|Chevvai|Mars)';
        $suthamPattern = '(?:சு\s*த்\s*த\s*ம்|சுத்தம்|Sutham|Clean)';

        if (preg_match('/' . $chkMarkPattern . '\s*' . $sevvaiPattern . '/ui', $text)) {
            $data['dosham'] = 'செவ்வாய் தோஷம்';
        } elseif (preg_match('/' . $chkMarkPattern . '\s*' . $rahuPattern . '/ui', $text)) {
            $data['dosham'] = 'ராகு கேது தோஷம்';
        } elseif (preg_match('/' . $chkMarkPattern . '\s*' . $suthamPattern . '/ui', $text)) {
            $data['dosham'] = 'சுத்தம்';
        }

        if (empty($data['dosham'])) {
            foreach (explode("\n", $text) as $astLine) {
                if (strpos($astLine, 'ராசி:') !== false && (strpos($astLine, 'நட்சத்திரம்') !== false || strpos($astLine, 'லக்னம்') !== false)) {
                    if (preg_match('/(?:லக்னம்|Lagnam)\s*[:=–\-]?\s*[\p{L}\p{M}]+[\t\s]+([^\r\n]+)/u', $astLine, $lm)) {
                        $matchedD = self::matchDosham(trim($lm[1]));
                        if ($matchedD) {
                            $data['dosham'] = $matchedD;
                            break;
                        }
                    }
                }
            }
        }

        if (empty($data['dosham']) && preg_match('/(?:சு\s*த்\s*த\s*ம்\/ரா\s*கு\/கே\s*து\/செ\s*வ்\s*வா\s*ய்|சுத்தம்\/ராகு\/கேது\/செவ்வாய்|தோ\s*ஷ\s*ம்|Dosham)\s*[:=–\-]?\s*([^\r\n]+)/ui', $text, $dm)) {
            $matchedD = self::matchDosham($dm[1]);
            $data['dosham'] = $matchedD ?: trim($dm[1]);
        }

        if (preg_match('/(?:தி\s*சை\s*இ\s*ரு\s*ப்\s*பு|தி\s*சா\s*இ\s*ரு\s*ப்\s*பு|Dasa\s*Balance)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s*(?:\[\s*[✓✔☑xX*■\s]*\]|சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு|ராகு|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|Expectations|எதிர்பார்ப்பு|[✓✔☑■])|[\r\n]|$)/ui', $text, $dsm)) {
            $rawThisai = trim($dsm[1]);
            $rawThisai = preg_replace('/[\[\(\{][^\]\)\}]*[\]\)\}]\s*$/u', '', $rawThisai);
            // Clean up spaced Tamil letters common in PyMuPDF text
            $rawThisai = preg_replace('/தி\s*சை/u', 'திசை', $rawThisai);
            $rawThisai = preg_replace('/இ\s*ரு\s*ப்\s*பு/u', 'இருப்பு', $rawThisai);
            $rawThisai = preg_replace('/சுக்கி\s*ரன்/u', 'சுக்கிரன்', $rawThisai);
            $rawThisai = preg_replace('/மா\s*தம்/u', 'மாதம்', $rawThisai);
            $rawThisai = preg_replace('/வரு\s*டம்/u', 'வருடம்', $rawThisai);
            $rawThisai = preg_replace('/செவ்\s*வாய்/u', 'செவ்வாய்', $rawThisai);
            $rawThisai = preg_replace('/சூரி\s*யன்/u', 'சூரியன்', $rawThisai);
            $rawThisai = preg_replace('/சந்\s*திரன்/u', 'சந்திரன்', $rawThisai);
            $rawThisai = preg_replace('/பு\s*தன்/u', 'புதன்', $rawThisai);
            $rawThisai = preg_replace('/கு\s*ரு/u', 'குரு', $rawThisai);
            $rawThisai = preg_replace('/ச\s*னி/u', 'சனி', $rawThisai);
            $rawThisai = preg_replace('/ரா\s*கு/u', 'ராகு', $rawThisai);
            $rawThisai = preg_replace('/கே\s*து/u', 'கேது', $rawThisai);
            $rawThisai = preg_replace('/^(?:திசை\s*இருப்பு|Dasa\s*Balance)\s*[:=–\-\.·~]?\s*/ui', '', $rawThisai);
            $rawThisai = preg_replace('/\s*(?:சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு\s*[\/\-]?\s*கே\s*து|ராகு\s*[\/\-]?\s*கேது|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|[✓✔☑■]).*$/uis', '', $rawThisai);
            $rawThisai = preg_replace('/(?:எதிர்[ப்]*பார்ப்பு(?:கள்)?|Expectations|இதர\s*குறிப்புகள்).*$/uis', '', $rawThisai);
            $data['thisai_iruppu'] = trim($rawThisai);
        }

        // Multi-line expectations parsing: Preserves full sentences across continuation lines (Strictly excludes marital status/disclaimer)
        if (preg_match('/(?:Expectations(?:\s*and\s*other\s*notes)?|எதிர்[ப்]*பார்ப்புகள்(?:\s*(?:மற்றும்|&)?\s*இதர\s*குறிப்புகள்)?)(?:\s*[\(\[\{]?\s*(?:to\s*be\s*specified|குறிப்பிடவும்)\s*[\)\]\}]?)?\s*[:=–\-\.·~]?\s*(.+?)(?=\s*(?:ரத்த\s*வகை|Blood\s*Group|மின்னஞ்சல்|Email|Parent|வரனின்\s*பெற்றோர்|கையொப்பம்|Signature|###VARAN|\bCell\b|\bPhone\b)|$)/uis', $text, $exm)) {
            $rawEx = trim($exm[1]);
            $rawEx = preg_replace('/^(?:[\(\[\{]?\s*(?:to\s*be\s*specified|குறிப்பிடவும்|மற்றும்\s*இதர\s*குறிப்புகள்|எதிர்[ப்]*பார்ப்புகள்)\s*[\)\]\}]?\s*[:=–\-]?\s*)+/ui', '', $rawEx);
            $rawEx = preg_replace('/[.\-_–]{3,}/u', '', $rawEx);
            $lines = preg_split('/[\r\n]+/u', $rawEx);
            $validLines = [];
            foreach ($lines as $ln) {
                $cleanLn = trim($ln);
                if (!empty($cleanLn) && !preg_match('/^(?:Parent|வரனின்\s*பெற்றோர்|Cell|Phone|Signature|கையொப்பம்)/ui', $cleanLn) && !preg_match('/^(?:\*|\s)*மறுமணம்\s*என்றால்|விவாகரத்து\s*சான்றிதழ்\s*நகல்|90808\s*49042/ui', $cleanLn)) {
                    $validLines[] = $cleanLn;
                }
            }
            $rawJoined = implode(' ', $validLines);
            // Cut before Blood Group, Email, or Parent Contact
            $rawJoined = preg_replace('/(?:ரத்த\s*வகை|Blood\s*Group|மின்னஞ்சல்|Email|Parent|வரனின்\s*பெற்றோர்|கையொப்பம்|Signature).*$/ui', '', $rawJoined);
            $rawJoined = preg_replace('/(?:ரத்த\s*வகை|Blood\s*Group|மின்னஞ்சல்|Email|Parent\s*[\/\-]?\s*Guardian|வரனின்\s*பெற்றோர்\s*[\/\-]?\s*காப்பாளர்|கையொப்பம்|Signature).*$/ui', '', $rawJoined);
            $rawJoined = preg_replace('/(?:\[\s*[✓✔xX]*\s*\]|[✓✔])?\s*(?:முதல்\s*மணம்|மறுமணம்|\*|விவாகரத்து\s*சான்றிதழ்|90808|திசை\s*இருப்பு)[^\r\n]*/ui', '', $rawJoined);
            $data['expectations'] = trim($rawJoined);
        }

        // 13. Marriage Type
        $hasFirstTick = (bool)preg_match('/[✓✔☑\[\({]\s*(?:1st\s*Marriage|முதல்\s*மண(?:ம்|மா)?)/ui', $text);
        $hasRemarriageTick = (bool)preg_match('/[✓✔☑\[\({]\s*(?:Remarriage|2nd\s*Marriage|ம\s*று\s*ம\s*ண\s*ம்|மறுமண(?:ம்|மா)?)(?!\s*என்றால்)/ui', $text);
        if ($hasRemarriageTick && !$hasFirstTick) {
            $data['marriage_type'] = 'marumanam';
        } elseif ($hasFirstTick) {
            $data['marriage_type'] = 'mudhal_manama';
        }

        // 14. Gender (varan_type)
        $candidateName = mb_strtolower($data['name'] ?? '');
        $maleNames = ['namiras', 'gojo', 'gokul', 'karthik', 'karthikeyan', 'vijay', 'ajith', 'suresh', 'ramesh', 'arun', 'kumar', 'vignesh', 'dinesh', 'senthil', 'murugan', 'siva', 'saravanan', 'praveen', 'prashanth', 'muthu', 'muthusamy', 'manikandan', 'ganesh', 'surya', 'naveen', 'aravind', 'bala', 'balaji', 'vasanth', 'harish', 'sanjay', 'deepak', 'raghav', 'ashok', 'anand', 'santhosh', 'prabhu', 'venkatesh', 'rajesh', 'sathish', 'அருண்', 'குமார்', 'கார்த்திக்', 'தினேஷ்', 'விஜய்', 'சுரேஷ்', 'ரமேஷ்', 'பிரவீன்', 'சந்தோஷ்', 'பாலா', 'பாலாஜி', 'விவேக்', 'ஹரிஷ்', 'சஞ்சய்', 'தீபக்', 'ராஜா', 'ராஜேஷ்', 'பிரபு', 'கோஜோ', 'நமிராஸ்'];
        $femaleNames = ['barani', 'பரணி', 'amirthavadivu', 'priya', 'divya', 'anitha', 'deepa', 'lakshmi', 'soundarya', 'keerthana', 'kavitha', 'sandhya', 'gayathri', 'swetha', 'pavithra', 'bhuvaneshwari', 'revathi', 'radha', 'shanthi', 'latha', 'பிரியா', 'திவ்யா', 'அனிதா', 'தீபா', 'லட்சுமி', 'கீதா', 'கவிதா', 'சந்தியா', 'காயத்ரி', 'ரேவதி', 'ராதா', 'சாந்தி', 'லதா', 'ஸ்வேதா', 'பவித்ரா', 'அமிர்தவடிவு'];

        if (empty($data['varan_type'])) {
            $nameTokens = preg_split('/[\s,\.\-_]+/u', $candidateName, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($nameTokens as $tok) {
                if (in_array($tok, $maleNames)) {
                    $data['varan_type'] = 'aan';
                    break;
                }
                if (in_array($tok, $femaleNames)) {
                    $data['varan_type'] = 'penn';
                    break;
                }
            }
        }

        if (empty($data['varan_type'])) {
            // Correct Expectations Orientation:
            // Candidate looking for guy/groom -> Candidate is female (penn)
            // Candidate looking for girl/bride -> Candidate is male (aan)
            if (preg_match('/(?:^|[\s\r\n\t.,;:!?"\'()\[\]{}])(?:Wanted\s*IT\s*Guy|IT\s*Guy|Good\s*Guy|Guy\s*Wanted|Groom\s*Wanted|Boy\s*Wanted|Handsome|Gentleman|மணமகன்\s*தேவை|ஆண்\s*வேண்டும்|பையன்\s*வேண்டும்|ஆண்\s*தேவை)(?:$|[\s\r\n\t.,;:!?"\'()\[\]{}])/ui', $text)) {
                $data['varan_type'] = 'penn';
            } elseif (preg_match('/(?:^|[\s\r\n\t.,;:!?"\'()\[\]{}])(?:Good\s*Girl|Girl\s*Wanted|Bride\s*Wanted|Homely\s*Girl|Homely|Good\s*IT\s*Girl|மணமகள்\s*தேவை|பெண்\s*வேண்டும்|பெண்\s*தேவை)(?:$|[\s\r\n\t.,;:!?"\'()\[\]{}])/ui', $text)) {
                $data['varan_type'] = 'aan';
            }
        }
        $skipOldGenderService = true;
        if (false) {
        $maleNames = ['gokul', 'karthik', 'karthikeyan', 'vijay', 'ajith', 'suresh', 'ramesh', 'arun', 'kumar', 'vignesh', 'dinesh', 'senthil', 'murugan', 'siva', 'saravanan', 'praveen', 'prashanth', 'muthu', 'muthusamy', 'manikandan', 'ganesh', 'surya', 'naveen', 'aravind', 'bala', 'balaji', 'vasanth', 'harish', 'sanjay', 'deepak', 'raghav', 'ashok', 'anand', 'santhosh', 'prabhu', 'venkatesh', 'rajesh', 'sathish'];
        $femaleNames = ['priya', 'divya', 'anitha', 'deepa', 'lakshmi', 'soundarya', 'keerthana', 'kavitha', 'sandhya', 'gayathri', 'swetha', 'pavithra', 'bhuvaneshwari', 'revathi', 'radha', 'shanthi', 'latha'];

        if (in_array($firstName, $maleNames)) {
            $data['varan_type'] = 'aan';
        } elseif (in_array($firstName, $femaleNames)) {
            $data['varan_type'] = 'penn';
        }
        if (empty($data['varan_type'])) {
            if (preg_match('/\b(?:Good\s*Guy|Guy|Boy|Handsome|Gentleman)\b/i', $text)) {
                $data['varan_type'] = 'aan';
        } } }

        foreach ($data as $k => $v) {
            if (is_string($v)) {
                $v = preg_replace('/(?<=\s)[\x{0BBE}-\x{0BCD}\x{0BD7}]+/u', '', $v);
                $v = preg_replace('/\s+[\x{0BBE}-\x{0BCD}\x{0BD7}]+$/u', '', $v);
                $data[$k] = trim($v);
            }
        }

                // Extract 12-house Kundali chart from PDF text if present
        $charts = self::parseHoroscopeFromPdfText($rawPdfText);
        if (!empty($charts['rasi_chart']) && array_filter($charts['rasi_chart'])) {
            $data['rasi_chart'] = $charts['rasi_chart'];
        }
        if (!empty($charts['navamsam_chart']) && array_filter($charts['navamsam_chart'])) {
            $data['navamsam_chart'] = $charts['navamsam_chart'];
        }
        return $data;
    }
}
