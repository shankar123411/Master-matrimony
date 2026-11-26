<!DOCTYPE html>
{{-- Updated Multi-Line Ruled Support --}}
<html lang="{{ $lang ?? 'ta' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    @php
        $gender = strtolower(trim($varan->varan_type ?? $varan->gender ?? ''));
        $marriageType = strtolower(trim($varan->marriage_type ?? ''));
        $isLangTa = (($lang ?? 'ta') !== 'en');
        
        // 1. Remarriage Detection
        $reqGender = strtolower(trim(request()->query('gender', '')));
        $isRemarriage = !empty($isRemarriage)
                     || in_array($gender, ['marumanam', 'remarriage', 're_marriage'])
                     || request()->query('gender') === 'marumanam'
                     || str_contains($reqGender, 'maru')
                     || str_contains($reqGender, 'remarriage')
                     || request()->query('type') === 'marumanam' 
                     || request()->query('pages') === '2'
                     || str_contains($marriageType, 'maru') 
                     || str_contains($marriageType, 'மறுமணம்')
                     || str_contains($marriageType, 'second')
                     || str_contains($marriageType, 're_marr')
                     || str_contains($marriageType, '2');

        $isPenn = ($gender === 'penn' || str_contains($reqGender, 'penn') || str_contains($reqGender, 'female') || str_contains($reqGender, 'bride'));
        $isMale = !$isPenn;

        $cName = trim($varan->name ?? '');
        $typePrefix = $isRemarriage ? 'REMARRIAGE' : ($isMale ? 'GROOM' : 'BRIDE');
        $centerBrand = 'Master Matrimony';
        if ($cName !== '') {
            $docTitle = $cName . ' - ' . $typePrefix . ' - ' . $centerBrand;
        } else {
            $docTitle = $typePrefix . ' - ' . $centerBrand;
        }
    @endphp
    <title>{{ $docTitle }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar:wght@400;600;700;800;900&family=Noto+Serif+Tamil:wght@700;800;900&family=Baloo+Thambi+2:wght@700;800&family=Plus+Jakarta+Sans:wght@700;800;900&display=swap" rel="stylesheet">
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script>
        if (typeof html2canvas === 'undefined') {
            document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"><\/script>');
        }
    </script>
    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <script>
        if (typeof window.jspdf === 'undefined' && typeof jsPDF === 'undefined') {
            document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"><\/script>');
        }
    </script>
    <script>window.__SERVER_PRINT_STYLES__ = {!! json_encode($savedPrintStyles ?? (object)[]) !!};</script>
    
    @php
        $gender = strtolower(trim($varan->varan_type ?? $varan->gender ?? ''));
        $marriageType = strtolower(trim($varan->marriage_type ?? ''));
        $isLangTa = (($lang ?? 'ta') !== 'en');
        
        // 1. Remarriage Detection
        $reqGender = strtolower(trim(request()->query('gender', '')));
        $isRemarriage = !empty($isRemarriage)
                     || in_array($gender, ['marumanam', 'remarriage', 're_marriage'])
                     || request()->query('gender') === 'marumanam'
                     || str_contains($reqGender, 'maru')
                     || str_contains($reqGender, 'remarriage')
                     || request()->query('type') === 'marumanam' 
                     || request()->query('pages') === '2'
                     || str_contains($marriageType, 'maru') 
                     || str_contains($marriageType, 'மறுமணம்')
                     || str_contains($marriageType, 'second') 
                     || str_contains($marriageType, 're_marr')
                     || str_contains($marriageType, '2');

        $isPenn = ($gender === 'penn' || str_contains($reqGender, 'penn') || str_contains($reqGender, 'female') || str_contains($reqGender, 'bride'));
        $isMale = !$isPenn;
        $isBlank = !empty($isBlank) || request()->query('blank') === '1' || request()->has('blank') || (($varan->id ?? 0) === 0);
        if ($isBlank) {
            $showPhoto = false;
        }
        $dash = $isBlank ? '' : '-';
        $themeLabelColor = $isRemarriage ? '#0369a1' : ($isMale ? '#14532d' : '#881337');

        $hlConfig = [];
        $getHlStyle = function($fieldKey = null, $isVal = true) { return ''; };
        $themeAnswerColor = '#000000';

        // 2. Theme Colors & Borders (Dark Yellow Outer Border matching Image 1 for all themes)
        $darkYellowBorder = '#ffe600';
        $borderColor = '#ffe600';     // Dark Yellow Outer Frame for all 3 themes
        $bannerBg = '#ffe600';        // Dark Golden Yellow Banner matching Kattams

        if ($isRemarriage) {
            $theme = 'blue';
            $pageBgColor = '#e0f2fe';     // Light Sky Blue
            $chartBorder = '#0284c7';
            $categoryTitleTa = 'ஆண் / பெண் மறுமணம்';
            $categoryTitleEn = 'Groom / Bride Remarriage';
        } elseif ($isMale) {
            $theme = 'green';
            $pageBgColor = '#9ED083';     // Light Pastel Olive Green (Exact client hex code: #9ED083)
            $chartBorder = '#15803d';
            $categoryTitleTa = 'ஆண் வரன்';
            $categoryTitleEn = 'Groom Biodata';
        } else {
            $theme = 'pink';
            $pageBgColor = '#F5CAA8';     // Warm Pastel Peach (Exact client hex code: #F5CAA8)
            $chartBorder = '#db2777';
            $categoryTitleTa = 'பெண் வரன்';
            $categoryTitleEn = 'Bride Biodata';
        }

        $groomAvatarSrc = file_exists(public_path('images/avatar_groom.png')) ? asset('images/avatar_groom.png') : '/images/avatar_groom.png';
        $brideAvatarSrc = file_exists(public_path('images/avatar_bride.png')) ? asset('images/avatar_bride.png') : '/images/avatar_bride.png';

        if ($isRemarriage) {
            $varanAvatarSrc = $isMale ? $groomAvatarSrc : $brideAvatarSrc;
            if ($isLangTa) {
                $varanBadgeLabel = $isMale ? 'ஆண் மறுமணம்' : 'பெண் மறுமணம்';
            } else {
                $varanBadgeLabel = $isMale ? 'Groom Remarriage' : 'Bride Remarriage';
            }
        } elseif ($isMale) {
            $varanAvatarSrc = $groomAvatarSrc;
            $varanBadgeLabel = $isLangTa ? 'ஆண் வரன்' : 'Groom Biodata';
        } else {
            $varanAvatarSrc = $brideAvatarSrc;
            $varanBadgeLabel = $isLangTa ? 'பெண் வரன்' : 'Bride Biodata';
        }

        // Show candidate photo setting (Strictly respects admin panel setting)
        if (!isset($showPhoto)) {
            $dbPhotoPref = \App\Models\MatrimonyMasterOption::where('category', 'setting')->where('name_ta', 'show_photo')->value('name_en');
            if (request()->has('show_photo')) {
                $showPhoto = (request()->query('show_photo') == '1');
            } elseif ($dbPhotoPref !== null) {
                $showPhoto = ($dbPhotoPref === '1');
            } else {
                $showPhoto = true;
            }
        }

        // Community Checkboxes (Handles both Tamil & English variants accurately)
        $comm = trim($varan->community ?? '');
        $commLower = strtolower($comm);
        $isSengunthar = (str_contains($comm, 'செங்குந்த') || str_contains($commLower, 'sengunth'));
        $isKaikkolar = (str_contains($comm, 'கைக்கோள') || str_contains($commLower, 'kaikolar') || str_contains($commLower, 'kaikkolar'));

        // Marital status
        $isMudhalManam = !$isRemarriage;

        // Assets Paths
        $logoSrc = file_exists(public_path('images/logo.svg')) ? asset('images/logo.svg') : '/images/logo.svg';
        $coupleSrc = '';
        $googlePlaySrc = '';
        $rasiEarthSrc = file_exists(public_path('images/chart_rasi_earth.png')) ? asset('images/chart_rasi_earth.png') : '/images/chart_rasi_earth.png';
        $navYantraSrc = file_exists(public_path('images/chart_navamsam_yantra.png')) ? asset('images/chart_navamsam_yantra.png') : '/images/chart_navamsam_yantra.png';
        $wmFile = public_path('images/watermark_seal.svg');
        $wmVer = file_exists($wmFile) ? filemtime($wmFile) : '20261126';
        $watermarkSrc = (file_exists($wmFile) ? asset('images/watermark_seal.svg') : '/images/watermark_seal.svg') . '?v=' . $wmVer;
        $bannerSrc = '';
        $avatarSrc = $isMale 
            ? (file_exists(public_path('images/avatar_groom.png')) ? asset('images/avatar_groom.png') : '/images/avatar_groom.png')
            : (file_exists(public_path('images/avatar_bride.png')) ? asset('images/avatar_bride.png') : '/images/avatar_bride.png');

        $photoSrc = $varan->photo_url ?? asset($varan->photo_path ?? '');

        // Date of Birth Formatting
        $dobFormatted = $isBlank ? '' : '-';
        if (!empty($varan->dob)) {
            try {
                $dobFormatted = \Carbon\Carbon::parse($varan->dob)->format('d-m-Y');
            } catch (\Throwable $e) {
                $dobFormatted = $varan->dob;
            }
        }

        // Complexion Language Translation (Robust Regex for Tamil & English variants)
        $cVal = trim($varan->complexion ?? '');
        $complexionDisplay = $isBlank ? '' : '-';
        if (!empty($cVal)) {
            if (!$isLangTa) {
                // English mode
                if (preg_match('/(கருப்பு|கறுப்பு|கருமை|கறுத்த|dark)/iu', $cVal)) {
                    $complexionDisplay = 'Dark';
                } elseif (preg_match('/(அடர்\s*சிவப்பு|மிக\s*சிவப்பு|very\s*fair)/iu', $cVal)) {
                    $complexionDisplay = 'Very Fair';
                } elseif (preg_match('/(சிவப்பு|fair)/iu', $cVal)) {
                    $complexionDisplay = 'Fair';
                } elseif (preg_match('/(மாநிறம்|மாநிற|wheatish|medium)/iu', $cVal)) {
                    $complexionDisplay = 'Wheatish';
                } else {
                    $complexionDisplay = $cVal;
                }
            } else {
                // Tamil mode
                if (preg_match('/(dark|கருப்பு|கறுப்பு|கருமை|கறுத்த)/iu', $cVal)) {
                    $complexionDisplay = 'கருப்பு';
                } elseif (preg_match('/(very\s*fair|அடர்\s*சிவப்பு|மிக\s*சிவப்பு)/iu', $cVal)) {
                    $complexionDisplay = 'அடர் சிவப்பு';
                } elseif (preg_match('/(fair|சிவப்பு)/iu', $cVal)) {
                    $complexionDisplay = 'சிவப்பு';
                } elseif (preg_match('/(wheatish|medium|மாநிறம்|மாநிற)/iu', $cVal)) {
                    $complexionDisplay = 'மாநிறம்';
                } else {
                    $complexionDisplay = $cVal;
                }
            }
        }

        // Decode Horoscope Charts
        $rasiChart = is_array($varan->rasi_chart) ? $varan->rasi_chart : json_decode($varan->rasi_chart ?? '{}', true);
        $navamsamChart = is_array($varan->navamsam_chart) ? $varan->navamsam_chart : json_decode($varan->navamsam_chart ?? '{}', true);

        // House Names mapping
        $houseNames = [
            1 => '1 மேஷம்', 2 => '2 ரிஷபம்', 3 => '3 மிதுனம்', 4 => '4 கடகம்',
            5 => '5 சிம்மம்', 6 => '6 கன்னி', 7 => '7 துலாம்', 8 => '8 விருச்சிகம்',
            9 => '9 தனுசு', 10 => '10 மகரம்', 11 => '11 கும்பம்', 12 => '12 மீனம்'
        ];

        // Robust Planet Split & Render Function (Ensures 3 rows x 3 columns inside each square cell)
        $getCellPlanets = function($chart, $h) {
            if (!is_array($chart)) return [];
            return $chart[$h] ?? ($chart[(string)$h] ?? []);
        };

        $renderChartCell = function($houseNum, $planets) use ($houseNames, $isBlank) {
            $pList = [];
            if (!empty($planets)) {
                if (is_array($planets)) {
                    foreach ($planets as $item) {
                        if (is_string($item)) {
                            $parts = preg_split('/[,\\s\\/]+/', $item, -1, PREG_SPLIT_NO_EMPTY);
                            foreach ($parts as $p) {
                                $pTrim = trim($p);
                                if ($pTrim !== '' && $pTrim !== 'null') {
                                    $pList[] = $pTrim;
                                }
                            }
                        }
                    }
                } elseif (is_string($planets)) {
                    $parts = preg_split('/[,\\s\\/]+/', $planets, -1, PREG_SPLIT_NO_EMPTY);
                    foreach ($parts as $p) {
                        $pTrim = trim($p);
                        if ($pTrim !== '' && $pTrim !== 'null') {
                            $pList[] = $pTrim;
                        }
                    }
                }
            }
            $hName = $houseNames[$houseNum] ?? (string)$houseNum;
            $html = '<div class="kattam-cell cell-h-' . $houseNum . '">';
            $html .= '<span class="kattam-house-name">' . $hName . '</span>';
            $html .= '<div class="kattam-planets-grid">';
            if (!empty($pList)) {
                $pList = array_slice($pList, 0, 9);
                foreach ($pList as $p) {
                    $html .= '<span class="kattam-planet-slot">' . htmlspecialchars($p) . '</span>';
                }
            } else {
                if (!$isBlank) {
                    $html .= '<span class="kattam-empty-dash">-</span>';
                }
            }
            $html .= '</div></div>';
            return $html;
        };

        // Auto-expanding ruled lines splitter for Address, Wealth, Siblings
        $splitFieldIntoLines = function($text, $firstLineMaxChars = 62, $contLineMaxChars = 75, $maxTotalLines = 15) use ($isBlank) {
            $text = trim($text ?? '');
            if ($text === '' || $text === '-') {
                return $isBlank ? [''] : ['-'];
            }

            // If text contains newlines, check if they are bullet points or just soft line breaks
            $hasBullets = preg_match('/(?:^|[\r\n])\s*(?:[•\-\*]|\d+[\.\)])/u', $text);
            $rawParagraphs = $hasBullets ? preg_split('/\r\n|\r|\n/u', $text) : [preg_replace('/\s*[\r\n]+\s*/u', ' ', $text)];
            $lines = [];

            foreach ($rawParagraphs as $para) {
                $para = trim($para);
                if ($para === '') continue;

                // Split paragraph into words/tokens by whitespace or punctuation delimiters, preserving delimiters
                $rawTokens = preg_split('/([,\.;\/\s]+)/u', $para, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                if (empty($rawTokens)) {
                    $rawTokens = [$para];
                }

                // Protect against overly long tokens without any delimiters (e.g. 80-char single unbroken string)
                $tokens = [];
                foreach ($rawTokens as $tok) {
                    $tokLen = mb_strlen($tok, 'UTF-8');
                    if ($tokLen > $contLineMaxChars) {
                        $offset = 0;
                        while ($offset < $tokLen) {
                            $tokens[] = mb_substr($tok, $offset, 35, 'UTF-8');
                            $offset += 35;
                        }
                    } else {
                        $tokens[] = $tok;
                    }
                }

                $curr = '';
                foreach ($tokens as $token) {
                    $isFirst = empty($lines);
                    $limit = $isFirst ? $firstLineMaxChars : $contLineMaxChars;

                    if ($curr === '') {
                        $curr = $token;
                    } else {
                        $candidate = $curr . $token;
                        if (mb_strlen(trim($candidate), 'UTF-8') <= $limit) {
                            $curr = $candidate;
                        } else {
                            $trimmed = trim($curr);
                            if ($trimmed !== '') {
                                $lines[] = $trimmed;
                            }
                            $curr = ltrim($token);
                            if (count($lines) >= $maxTotalLines) {
                                break;
                            }
                        }
                    }
                }

                $trimmed = trim($curr);
                if ($trimmed !== '') {
                    $lines[] = $trimmed;
                }

                if (count($lines) >= $maxTotalLines) {
                    break;
                }
            }

            if (empty($lines)) {
                $lines = ['-'];
            }

            return array_slice($lines, 0, $maxTotalLines);
        };

        // Prepare clean Siblings string
        $broVal = trim($varan->brothers ?? '');
        $sisVal = trim($varan->sisters ?? '');
        $sdVal = trim($varan->siblings_details ?? '');

        $cleanNoneHelper = function($v) {
            $l = strtolower(trim($v));
            return in_array($l, ['none', 'இல்லை', 'illai', '-', 'nil', 'no', '0', '']);
        };

        $stripLabelHelper = function($val) {
            return preg_replace('/^(?:சகோதரர்கள்|சகோதரர்|சகோதரிகள்|சகோதரி|brothers|brother|sisters|sister)\s*[:=–\-]?\s*/ui', '', trim($val));
        };

        $bClean = $stripLabelHelper($broVal);
        $sClean = $stripLabelHelper($sisVal);

        $sItems = [];
        if (!$cleanNoneHelper($bClean)) {
            $sItems[] = $bClean;
        }
        if (!$cleanNoneHelper($sClean)) {
            $sItems[] = $sClean;
        }

        if (empty($sItems)) {
            if (!empty($sdVal) && !$cleanNoneHelper($sdVal)) {
                $cleanSd = $sdVal;
                $cleanSd = preg_replace('/(?:\b(?:brothers?|sisters?)\b|சகோதரர்கள்|சகோதரர்|சகோதரிகள்|சகோதரி)\s*[:=–\-]\s*(?:None|இல்லை|nil|0|illai|-)\s*(?:,|$)/ui', ' ', $cleanSd);
                $cleanSd = preg_replace('/(?:\b(?:brothers?|sisters?)\b|சகோதரர்கள்|சகோதரர்|சகோதரிகள்|சகோதரி)\s*[:=–\-]\s*(?:,|$)/ui', ' ', $cleanSd);
                $cleanSd = preg_replace('/(?:\b(?:brothers?|sisters?)\b|சகோதரர்கள்|சகோதரர்|சகோதரிகள்|சகோதரி)\s*[:=–\-]\s*/ui', '', $cleanSd);
                $cleanSd = preg_replace('/[,\s]+/', ' ', $cleanSd);
                $cleanSd = trim($cleanSd, " ,;\t\n\r");
                $finalSiblings = !empty($cleanSd) ? $cleanSd : ($isBlank ? '' : '-');
            } else {
                $finalSiblings = $isBlank ? '' : '-';
            }
        } else {
            $finalSiblings = implode(', ', $sItems);
        }

        $finalAddress = trim($varan->address ?? '');
        $finalWealth = trim($varan->family_wealth ?? '');

        $addressLines = $splitFieldIntoLines($finalAddress, $isLangTa ? 48 : 58, 75);
        $wealthLines = $splitFieldIntoLines($finalWealth, $isLangTa ? 40 : 50, 75);
        $siblingsLines = $splitFieldIntoLines($finalSiblings, $isLangTa ? 34 : 52, $isLangTa ? 56 : 76);
        $finalExpectations = trim($varan->expectations ?? "");
        // Clean out any stray disclaimers if they were stored previously in DB:
        $finalExpectations = preg_replace('/(?:✓|✔)?\s*(?:முதல்\s*மணம்|மறுமணம்|\*|விவாகரத்து|சான்றிதழ்|90808|திசை\s*இருப்பு).*?(?=எதிர்ப்பார்ப்புகள்|நல்ல|Want|$)/uis', '', $finalExpectations);
        $finalExpectations = preg_replace('/^(?:எதிர்ப்பார்ப்புகள்|எதிர்பார்ப்புகள்|இதர\s*குறிப்புகள்|Expectations)?(?:\s*மற்றும்\s*இதர\s*குறிப்புகள்)?(?:\s*குறிப்பிடவும்)?\s*[:=–\-]?\s*/ui', '', $finalExpectations);
        $finalExpectations = trim($finalExpectations);
        $expectationsLines = $splitFieldIntoLines($finalExpectations, $isLangTa ? 28 : 50, $isLangTa ? 54 : 74);
        $extraExpectationsCount = max(0, count($expectationsLines) - 1);

        $extraAddressCount = max(0, count($addressLines) - 1);
        $extraWealthCount = max(0, count($wealthLines) - 1);
        $extraSiblingsCount = max(0, count($siblingsLines) - 1);
        $totalExtraLines = $extraAddressCount + $extraWealthCount + $extraSiblingsCount + $extraExpectationsCount;
    @endphp

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            background-color: #0f172a;
            padding: 16px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Top Action Bar (Hidden during Print) */
        .no-print-bar {
            width: 100%;
            max-width: 210mm;
            background: #0f172a;
            color: #fff;
            padding: 8px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 4px 14px rgba(0,0,0,0.4);
            border-bottom: 2px solid {{ $borderColor }};
            margin-bottom: 8px;
            box-sizing: border-box;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            background: {{ $borderColor }};
            color: #fff;
            font-weight: 800;
            border: none;
            padding: 7px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13.5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.25);
        }

        .btn:hover {
            filter: brightness(1.15);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #334155;
            color: #fff;
            border: 1px solid #475569;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .btn-style-cfg {
            background: #4338ca;
            color: #fff;
        }

        .a4-sheet-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
            padding: 0 4px 40px 4px;
            box-sizing: border-box;
        }

        @if(!empty($isBlank))
        .f-val {
            color: transparent !important;
            user-select: none !important;
        }
        .f-val:empty::after, .f-val::after {
            content: '\00a0' !important;
            display: inline-block !important;
        }
        .chk-box {
            background: transparent !important;
        }
        .chk-box.checked::after {
            display: none !important;
        }
        .kattam-empty-dash, .kattam-planet-slot {
            display: none !important;
        }
        .other-notes-val, .expectations-box .f-val {
            color: transparent !important;
        }
        @endif

        /* Exact A4 Sheet Dimensions - Full Solid Dark Yellow Border Band */
        .a4-page {
            width: 210mm;
            height: 297mm;
            min-height: 297mm;
            max-height: 297mm;
            box-sizing: border-box;
            background: #ffe600 !important; /* Full Solid Dark Yellow outer border band matching Image 1 & 2 */
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
            padding: 2mm 2.5mm;
            position: relative;
            color: #002060;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            overflow: hidden;
            margin: 0 auto;
        }

        /* Outer Double Frame (Solid Dark Yellow) */
        .outer-frame {
            border: none;
            background: #ffe600 !important;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        /* Inner Red Frame (Content background sits inside) */
        .inner-frame {
            border: 3.5px solid #cc0000;
            background: {{ $pageBgColor }};
            padding: 4px 10px;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            box-sizing: border-box;
        }

        /* Authentic Sri Angalamman Circular Watermark (Compact & Perfectly Balanced) */
        .watermark-container {
            position: absolute;
            top: 48%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 195px;
            height: 195px;
            pointer-events: none;
            z-index: 1;
            opacity: 0.38;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .watermark-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Top Header Banner (Requirement 6 - Tall, Prominent, Matching User PDF) */
        .print-header {
            display: flex;
            align-items: stretch;
            border: 2px solid #dc2626;
            background-color: {{ $bannerBg }} !important;
            height: 138px;
            min-height: 138px;
            max-height: 138px;
            margin-bottom: 9px;
            position: relative;
            z-index: 2;
            box-sizing: border-box;
        }

        .header-left {
            width: 14%;
            flex: 0 0 14%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-right: 1.5px solid #dc2626;
            padding: 2px 2px;
            text-align: center;
            gap: 2px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .header-logo {
            width: 48px;
            height: 48px;
            object-fit: contain;
            display: block;
        }

        .header-varan-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 1px;
        }

        .header-avatar-img {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid #ffffff;
            object-fit: cover;
            box-shadow: 0 2px 4px rgba(0,0,0,0.25);
            background: #ffffff;
            display: block;
        }

        .header-varan-title {
            font-family: 'Mukta Malar', 'Noto Sans Tamil', Arial, sans-serif;
            font-size: 11px;
            font-weight: 900;
            color: #000000;
            line-height: 1.15;
            white-space: nowrap;
            text-align: center;
            margin-top: 2px;
            letter-spacing: 0.2px;
        }

        .header-center {
            flex: 1;
            width: 72%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2px 4px;
            text-align: center;
            box-sizing: border-box;
            overflow: hidden;
        }

        .main-title {
            font-family: 'Noto Serif Tamil', 'Mukta Malar', 'Baloo Thambi 2', 'Latha', serif;
            font-size: 19.5px;
            font-weight: 900;
            color: #000000;
            line-height: 1.2;
            letter-spacing: 0px;
            white-space: nowrap;
            margin-top: 1px;
            margin-bottom: 5px;
            text-align: center;
            text-shadow: 0 0.5px 0.5px rgba(0,0,0,0.25);
        }

        .sub-title {
            font-family: 'Noto Serif Tamil', 'Mukta Malar', 'Baloo Thambi 2', 'Latha', serif;
            font-size: 14.5px;
            font-weight: 900;
            color: #000000;
            line-height: 1.15;
            letter-spacing: 0.2px;
            white-space: nowrap;
            margin-bottom: 2px;
            text-align: center;
        }

        .founder-contact {
            font-family: 'Mukta Malar', 'Noto Sans Tamil', 'Segoe UI', Arial, sans-serif;
            font-size: 15.5px;
            font-weight: 900;
            color: #000000;
            line-height: 1.15;
            letter-spacing: 0.2px;
            white-space: nowrap;
            margin-bottom: 2px;
            text-align: center;
        }

        .note-phone {
            font-family: 'Mukta Malar', 'Noto Sans Tamil', 'Segoe UI', Arial, sans-serif;
            font-size: 10.8px;
            font-weight: 800;
            color: #111827;
            line-height: 1.15;
            white-space: nowrap;
            margin-bottom: 2px;
            text-align: center;
        }

        .app-download-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 9.8px;
            font-weight: 900;
            color: #000000;
            white-space: nowrap;
            margin-top: 1px;
            text-align: center;
        }

        .google-play-img {
            height: 16px;
            object-fit: contain;
            display: inline-block;
            vertical-align: middle;
        }

        .header-right {
            width: 15%;
            flex: 0 0 15%;
            display: flex;
            align-items: stretch;
            justify-content: center;
            border-left: 1.5px solid #dc2626;
            padding: 0;
            background: transparent;
            overflow: hidden;
            box-sizing: border-box;
        }

        .couple-photo {
            width: 100%;
            height: 100%;
            max-height: 100%;
            object-fit: cover;
            object-position: center top;
            border: none;
            display: block;
        }

        /* Dotted Ruled Field Rows (Full A4 sheet usage, elegant spacing & clean alignment) */
        .dotted-row {
            display: flex;
            align-items: baseline;
            min-height: 28px;
            box-sizing: border-box;
            padding: 1px 2px 2.5px 2px;
            font-size: 13.5px;
            font-weight: 800;
            color: #002060;
            line-height: 1.3;
            position: relative;
            z-index: 2;
        }

        .middle-dotted-row {
            margin-top: 4.5px;
        }

        .f-label {
            font-size: 13.5px;
            font-weight: 800;
            color: #002060;
            white-space: nowrap;
            margin-right: 6px;
            flex-shrink: 0;
        }

        .f-val {
            font-size: 13.5px;
            font-weight: 800;
            color: #002060;
            flex: 1;
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            border-bottom: 1.3px dotted #000000;
            min-height: 18px;
            padding-bottom: 0.5px;
        }

        .f-val-wrap {
            white-space: normal !important;
            word-break: break-word;
            line-height: 1.25;
        }

        .continuation-dotted-row {
            padding-left: 0;
        }

        .continuation-f-val {
            width: 100%;
            flex: 1;
            min-width: 0;
            border-bottom: 1.3px dotted #000000;
            min-height: 18px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-left: 24px;
        }

        /* Dynamically adjust vertical gaps when extra lines are present so page never overflows A4 */
        .has-extra-lines .middle-dotted-row {
            margin-top: 2.5px !important;
        }
        .has-extra-lines .dotted-row {
            min-height: 25px !important;
            padding-bottom: 0.5px !important;
            font-size: 13px !important;
        }
        .has-extra-lines .f-label, .has-extra-lines .f-val {
            font-size: 13px !important;
        }
        .has-extra-lines .print-header {
            margin-bottom: 6px !important;
        }
        .has-extra-lines .photo-and-charts-row {
            margin-top: 3px !important;
            margin-bottom: 3px !important;
        }
        .has-extra-lines .other-notes-box {
            margin-top: 3px !important;
            margin-bottom: 3px !important;
            padding: 3px 6px !important;
        }

        /* For 5 or more extra lines (e.g. 5 to 12+ lines) */
        .has-many-lines .middle-dotted-row {
            margin-top: 1px !important;
        }
        .has-many-lines .dotted-row {
            min-height: 21px !important;
            padding-bottom: 0px !important;
            font-size: 12px !important;
        }
        .has-many-lines .f-label, .has-many-lines .f-val {
            font-size: 12px !important;
        }
        .has-many-lines .chart-wrapper, .has-many-lines .kattam-grid, .has-many-lines .candidate-photo-box {
            height: 180px !important;
        }
        .has-many-lines .candidate-photo-frame {
            height: 180px !important;
        }

        @if($totalExtraLines >= 8)
        .a4-page {
            height: auto !important;
            min-height: 297mm !important;
            max-height: none !important;
            overflow: visible !important;
        }
        .outer-frame, .inner-frame {
            height: auto !important;
            min-height: 100% !important;
        }
        @media print {
            .a4-page {
                height: auto !important;
                min-height: 297mm !important;
                max-height: none !important;
                overflow: visible !important;
                page-break-inside: auto !important;
                break-inside: auto !important;
            }
        }
        @endif

        /* Precision Column Grid Layout for 100% Straight Vertical Alignments */
        .row-3col, .row-2col {
            display: flex;
            align-items: baseline;
            width: 100%;
        }

        .col-left {
            width: 35%;
            flex: 0 0 35%;
            display: flex;
            align-items: baseline;
            padding-right: 8px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .col-center {
            width: 27%;
            flex: 0 0 27%;
            display: flex;
            align-items: baseline;
            padding-right: 8px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .col-span-2 {
            width: 62%;
            flex: 0 0 62%;
            display: flex;
            align-items: baseline;
            padding-right: 12px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .col-right {
            width: 38%;
            flex: 0 0 38%;
            display: flex;
            align-items: baseline;
            box-sizing: border-box;
            overflow: hidden;
        }

        .row-astrology-3col {
            display: flex;
            align-items: baseline;
            width: 100%;
        }

        .col-ast-rasi {
            width: 32%;
            flex: 0 0 32%;
            display: flex;
            align-items: baseline;
            padding-right: 6px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .col-ast-natchathiram {
            width: 41%;
            flex: 0 0 41%;
            display: flex;
            align-items: baseline;
            padding-right: 6px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .col-ast-lagnam {
            width: 27%;
            flex: 0 0 27%;
            display: flex;
            align-items: baseline;
            box-sizing: border-box;
            overflow: hidden;
        }

        .col-left .f-label, .col-center .f-label, .col-span-2 .f-label, .col-right .f-label,
        .col-ast-rasi .f-label, .col-ast-natchathiram .f-label, .col-ast-lagnam .f-label {
            margin-right: 6px;
            margin-left: 0 !important;
            flex-shrink: 0;
        }

        .col-left .f-val, .col-center .f-val, .col-span-2 .f-val, .col-right .f-val,
        .col-ast-rasi .f-val, .col-ast-natchathiram .f-val, .col-ast-lagnam .f-val {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .f-val-highlight {
            color: #c2185b;
            font-weight: 900;
        }

        .chk-group {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            font-weight: 800;
            color: {{ $themeLabelColor }};
            margin-left: auto;
            flex-shrink: 0;
        }

        .chk-box {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1.5px solid {{ $themeLabelColor }};
            border-radius: 2px;
            vertical-align: middle;
            margin-right: 4px;
            text-align: center;
            line-height: 12px;
            font-size: 12px;
            font-weight: 900;
            color: {{ $themeAnswerColor }};
            background: #ffffff;
            box-sizing: border-box;
        }

        .chk-box.checked {
            background: #ffffff;
            color: {{ $themeAnswerColor }};
        }

        .chk-box.checked::after {
            content: '✓';
            color: {{ $themeAnswerColor }};
            font-weight: 900;
        }

        /* Astrology Line: Candidate Photo | Rasi Kattam | Navamsam Kattam */
        .photo-and-charts-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 4px;
            margin-bottom: 3px;
            position: relative;
            z-index: 2;
        }

        .candidate-photo-box {
            width: 150px;
            height: 196px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .candidate-photo-frame {
            width: 100%;
            height: 100%;
            border: 2px solid {{ $borderColor }};
            background: #ffffff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.15);
            padding: 2px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 4px;
        }

        .candidate-photo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 2px;
        }

        .candidate-photo-placeholder {
            font-size: 13px;
            font-weight: 800;
            color: #94a3b8;
            text-align: center;
            line-height: 1.4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            background: #f8fafc;
        }

        /* Dual Rectangular Astrology Charts (Rasi & Navamsam) 275px width x 196px height */
        .chart-wrapper {
            width: 275px;
            height: 196px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
        }

        .kattam-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(4, 1fr);
            width: 275px;
            height: 196px;
            border: 2px solid #dc2626;
            background: #ffe600 !important; /* Dark Golden Yellow */
            box-sizing: border-box;
        }

        .kattam-cell {
            border: 1px solid #dc2626;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: stretch;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            background: #ffe600 !important;
            padding: 1px;
            overflow: hidden;
        }

        .kattam-house-name {
            position: absolute;
            top: 1px;
            left: 2px;
            font-size: 8px;
            font-weight: 800;
            color: #7f1d1d;
            line-height: 1;
            pointer-events: none;
            z-index: 2;
        }

        /* 3 rows and 3 columns planet grid inside rectangular cell */
        .kattam-planets-grid {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            padding-top: 10px;
            padding-bottom: 1px;
            padding-left: 1px;
            padding-right: 1px;
            box-sizing: border-box;
            align-items: center;
            justify-items: center;
            gap: 1px;
        }

        .kattam-planet-slot {
            font-size: 8px;
            font-weight: 900;
            color: #002060;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
        }

        .kattam-empty-dash {
            grid-column: 1 / 4;
            grid-row: 1 / 4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            color: #94a3b8;
            font-weight: 800;
        }

        /* Center 2x2 Kundali Graphic */
        .kattam-center-box {
            grid-column: 2 / 4;
            grid-row: 2 / 4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #ffe600 !important;
            padding: 2px;
            box-sizing: border-box;
            border: 1px solid #dc2626;
        }

        .chart-center-graphic {
            width: 44px;
            height: 44px;
            object-fit: contain;
            display: block;
        }

        .chart-center-title {
            font-size: 14px;
            font-weight: 900;
            color: {{ $isRemarriage ? '#0c4a6e' : '#881337' }};
            margin-top: 2px;
            letter-spacing: 0.5px;
        }

        /* Other Notes Box (2-Line Structured Layout) */
        .other-notes-box {
            border: 1.5px solid {{ $themeLabelColor }};
            border-radius: 4px;
            padding: 4px 8px 4px 8px;
            background: rgba(255, 255, 255, 0.45);
            margin-top: 4px;
            margin-bottom: 2px;
            box-sizing: border-box;
            position: relative;
            z-index: 2;
        }

        .notes-box-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .notes-box-title {
            font-size: 13.5px;
            font-weight: 900;
            color: {{ $themeLabelColor }};
            white-space: nowrap;
        }

        .notes-strip-chk-group {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 13px;
            font-weight: 800;
            color: {{ $themeLabelColor }};
            white-space: nowrap;
        }

        .notes-strip-warning {
            font-size: 12px;
            font-weight: 800;
            color: {{ $themeLabelColor }};
            margin-top: 3px;
            display: block;
            line-height: 1.3;
            white-space: normal;
        }

        .notes-strip-phone {
            font-size: 13px;
            font-weight: 900;
            color: {{ $themeLabelColor }};
            background: transparent;
            border: 1.5px solid {{ $themeLabelColor }};
            padding: 1.5px 8px;
            border-radius: 6px;
            white-space: nowrap;
            margin-left: auto;
            flex-shrink: 0;
        }

        /* Bottom Signature Row */
        .bottom-signature-row {
            display: flex;
            justify-content: flex-end;
            padding-top: 4px;
            padding-bottom: 2px;
            position: relative;
            z-index: 2;
            margin-top: auto;
        }

        /* Page 2 Specifics */
        .page2-notes-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 8px 4px;
            position: relative;
            z-index: 2;
        }

        .remarriage-notice-box {
            border: 1.5px solid #0284c7;
            border-radius: 8px;
            background: #ffffff;
            padding: 10px 14px;
            text-align: center;
            font-size: 13px;
            font-weight: 800;
            color: #0284c7;
            line-height: 1.4;
            margin-top: 8px;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .page2-dotted-line {
            border-bottom: 1.3px dotted #000000;
            height: 24px;
            width: 100%;
        }

        @page {
            size: A4 portrait;
            margin: 0mm;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 0mm;
            }
            html, body {
                width: 210mm !important;
                height: auto !important;
                margin: 0 !important;
                padding: 0 !important;
                background: none !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print-bar {
                display: none !important;
            }
            .a4-sheet-container {
                padding: 0 !important;
                margin: 0 !important;
                gap: 0 !important;
                width: 210mm !important;
                display: block !important;
            }
            .a4-page {
                box-shadow: none !important;
                margin: 0 !important;
                width: 210mm !important;
                height: 297mm !important;
                max-height: 297mm !important;
                box-sizing: border-box !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                overflow: hidden !important;
            }
            #printSheetPage1 {
                page-break-after: avoid !important;
                break-after: avoid !important;
            }
            .page-break {
                page-break-before: always !important;
                break-before: always !important;
            }
        }
    </style>
</head>
<body>

    <!-- Top Action Bar (Hidden during Print) -->
    <div class="no-print-bar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="/portal" class="btn btn-secondary">
                ← <span>{{ $isLangTa ? 'பதிவு பக்கத்திற்கு' : 'Back to Portal' }}</span>
            </a>
            <span style="font-weight: 800; font-size: 14px; color: #94a3b8;">
                {{ $isLangTa ? ($isRemarriage ? 'மறுமணம்' : ($isMale ? 'ஆண் வரன்' : 'பெண் வரன்')) : ($isRemarriage ? 'Remarriage' : ($isMale ? 'Groom' : 'Bride')) }} ({{ $varan->name }})
            </span>
        </div>

        <div style="display: flex; align-items: center; gap: 8px;">
            <!-- Language Switcher (Preserves show_photo preference across language switch) -->
            <a href="?lang={{ $isLangTa ? 'en' : 'ta' }}&show_photo={{ $showPhoto ? '1' : '0' }}{{ request()->has('type') ? '&type='.request()->query('type') : '' }}" class="btn btn-secondary">
                🌐 {{ $isLangTa ? 'English' : 'தமிழ்' }}
            </a>

            <!-- Print Button -->
            <button onclick="window.print()" class="btn" style="background: #15803d; padding: 7px 20px;">
                🖨️ <span>{{ $isLangTa ? 'அச்சு எடுக்க' : 'Print Sheet' }}</span>
            </button>

            <!-- Direct Save as PDF Button -->
            <button id="btnSavePdfTop" onclick="window.exportPageAsPdf()" class="btn" style="background: #0284c7; padding: 7px 20px;">
                📄 <span>{{ $isLangTa ? 'PDF பதிவிறக்குக' : 'Save as PDF' }}</span>
            </button>
        </div>
    </div>

    <!-- Container for A4 Sheet(s) -->
    <div class="a4-sheet-container">

        <!-- ========================================== -->
        <!-- PAGE 1: MAIN BIODATA & HOROSCOPES          -->
        <!-- ========================================== -->
        <div class="a4-page {{ $totalExtraLines >= 7 ? 'has-extra-lines has-many-lines' : ($totalExtraLines >= 4 ? 'has-extra-lines' : '') }}" id="printSheetPage1">
            <div class="outer-frame">
                <div class="inner-frame">

                    <!-- Print-Accessible Gender Marker for Autofill Detection -->
                    <span style="position: absolute; left: -9999px; top: -9999px; width: 1px; height: 1px; overflow: hidden; opacity: 0.001; font-size: 1px; color: transparent;" aria-hidden="true">{{ $isMale ? 'ஆண் வரன் Groom' : 'பெண் வரன் Bride' }}</span>

                    <!-- Authentic Circular Seal Watermark (Req 4) -->
                    <div class="watermark-container">
                        <img src="{{ $watermarkSrc }}" class="watermark-img" alt="Watermark" onerror="this.src='/images/watermark_seal.svg?v={{ $wmVer }}'">
                    </div>

                    <!-- 1. Header (Banner, Logo with Varan Avatar Badge) -->
                    <div class="print-header">
                        <!-- Left: Logo & Varan Avatar Badge Underneath -->
                        <div class="header-left">
                            <img src="{{ $logoSrc }}" class="header-logo" alt="Logo" onerror="this.style.display='none'">

                            <div class="header-varan-badge">
                                <img src="{{ $varanAvatarSrc }}" class="header-avatar-img" alt="{{ $varanBadgeLabel }}" onerror="this.src='{{ $isMale ? '/images/avatar_groom.png' : '/images/avatar_bride.png' }}'">
                                <div class="header-varan-title">{{ $varanBadgeLabel }}</div>
                            </div>
                        </div>

                        <!-- Center: Official Header Banner -->
                        <div class="header-center">
                            <div class="banner-inner-content" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%;">
                                <div class="main-title">{{ $isLangTa ? 'மாஸ்டர் மணமாலை' : 'MASTER MATRIMONY' }}</div>
                                <div class="sub-title">{{ $isLangTa ? 'திருமண தகவல் மையம்' : 'MATRIMONIAL INFORMATION CENTRE' }}</div>
                                <div class="founder-contact">{{ $isLangTa ? 'Master Matrimony Desk • Cell: +91 90000 00000' : 'Master Matrimony Desk • Cell: +91 90000 00000' }}</div>
                                <div class="note-phone">{{ $isLangTa ? '(தொலைபேசி மூலமாகவே பதிவு செய்து கொள்ளலாம். நேரில் வர வேண்டிய அவசியம் இல்லை.)' : '(Registration can be done by phone. No need to visit in person.)' }}</div>
                                <div class="app-download-row">
                                    <span>MASTER MATRIMONY DIGITAL PORTAL &amp; BIODATA SUITE</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Official Brand Crest -->
                        <div class="header-right" style="display:flex; flex-direction:column; align-items:center; justify-content:center; padding: 6px;">
                            <img src="{{ $logoSrc }}" class="couple-photo" alt="Master Matrimony Crest" onerror="this.style.display='none'" style="object-fit: contain; max-height: 92px;">
                        </div>
                    </div>

                    <!-- 2. Candidate Full-Width Details Rows (Rows 1-5 Across Full Page) -->
                    <!-- Row 1: Candidate Name with Sengunthar / Kaikkolar Checkboxes -->
                    <div class="dotted-row" data-print-field="name">
                        <span class="f-label">{{ $isLangTa ? 'வரன் பெயர்:' : 'Name:' }}</span>
                        <span class="f-val f-val-highlight">{{ $varan->name }}</span>
                        <div class="chk-group">
                            <span><span class="chk-box {{ $isSengunthar ? 'checked' : '' }}"></span> {{ $isLangTa ? 'செங்குந்தர்' : 'Sengunthar' }}</span>
                            <span><span class="chk-box {{ $isKaikkolar ? 'checked' : '' }}"></span> {{ $isLangTa ? 'கைக்கோளர்' : 'Kaikkolar' }}</span>
                        </div>
                    </div>

                    <!-- Row 2: DOB, Time, Birth Place (3 Columns: Center starts at 35%, Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-3col" data-print-field="dob_row">
                        <div class="col-left" data-print-field="dob">
                            <span class="f-label">{{ $isLangTa ? 'பிறந்த தேதி:' : 'DOB:' }}</span>
                            <span class="f-val">{{ $dobFormatted }}</span>
                        </div>
                        <div class="col-center" data-print-field="birth_time">
                            <span class="f-label">{{ $isLangTa ? 'நேரம்:' : 'Time:' }}</span>
                            <span class="f-val">{{ $varan->birth_time ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="birth_place">
                            <span class="f-label">{{ $isLangTa ? 'பிறந்த ஊர்:' : 'Place:' }}</span>
                            <span class="f-val">{{ $varan->birth_place ?? $varan->native_place ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 3: Education & Job (2 Columns: Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-2col" data-print-field="education_row">
                        <div class="col-span-2" data-print-field="education">
                            <span class="f-label">{{ $isLangTa ? 'வரனின் படிப்பு:' : 'Education:' }}</span>
                            <span class="f-val">{{ $varan->education ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="job_title">
                            <span class="f-label">{{ $isLangTa ? 'வேலை:' : 'Job:' }}</span>
                            <span class="f-val">{{ $varan->job_title ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 4: Company & Monthly Income (2 Columns: Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-2col" data-print-field="company_details_row">
                        <div class="col-span-2" data-print-field="company_details">
                            <span class="f-label">{{ $isLangTa ? 'நிறுவனம் பெயர் & ஊர்:' : 'Company & Town:' }}</span>
                            <span class="f-val">{{ $varan->company_details ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="monthly_income">
                            <span class="f-label">{{ $isLangTa ? 'மாத வருமானம்:' : 'Income:' }}</span>
                            <span class="f-val">{{ $varan->monthly_income ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 5: Height, Weight, Complexion (3 Columns: Center starts at 35%, Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-3col" data-print-field="height_row">
                        <div class="col-left" data-print-field="height">
                            <span class="f-label">{{ $isLangTa ? 'உயரம்:' : 'Height:' }}</span>
                            <span class="f-val">{{ $varan->height ?? $dash }}</span>
                        </div>
                        <div class="col-center" data-print-field="weight">
                            <span class="f-label">{{ $isLangTa ? 'எடை:' : 'Weight:' }}</span>
                            <span class="f-val">{{ $varan->weight ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="complexion">
                            <span class="f-label">{{ $isLangTa ? 'நிறம்:' : 'Complexion:' }}</span>
                            <span class="f-val">{{ $complexionDisplay }}</span>
                        </div>
                    </div>

                    <!-- 3. Full-Width Details Rows (Rows 6-14 Below Candidate Photo) -->
                    <!-- Row 6: Kuladeivam -->
                    <div class="dotted-row middle-dotted-row" data-print-field="kuladeivam">
                        <span class="f-label">{{ $isLangTa ? 'குலதெய்வம், ஊர்:' : 'Kuladeivam & Town:' }}</span>
                        <span class="f-val">{{ $varan->kuladeivam ?? $dash }}</span>
                    </div>

                    <!-- Row 7: Gothram & Kootam (2 Columns: Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-2col" data-print-field="gothram_row">
                        <div class="col-span-2" data-print-field="gothram">
                            <span class="f-label">{{ $isLangTa ? 'கோத்திரம்:' : 'Gothram:' }}</span>
                            <span class="f-val">{{ $varan->gothram ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="kootam">
                            <span class="f-label">{{ $isLangTa ? 'கூட்டம்:' : 'Kootam:' }}</span>
                            <span class="f-val">{{ $varan->kootam ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 8: Father Name & Mobile (2 Columns: Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-2col" data-print-field="father_name_row">
                        <div class="col-span-2" data-print-field="father_name">
                            <span class="f-label">{{ $isLangTa ? 'தந்தை பெயர்:' : 'Father Name:' }}</span>
                            <span class="f-val">{{ $varan->father_name ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="father_mobile">
                            <span class="f-label">{{ $isLangTa ? 'அலைபேசி:' : 'Mobile:' }}</span>
                            <span class="f-val">{{ $varan->father_mobile ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 9: Father Job & Native (2 Columns: Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-2col" data-print-field="father_occupation_row">
                        <div class="col-span-2" data-print-field="father_occupation">
                            <span class="f-label">{{ $isLangTa ? 'தந்தையின் பணி:' : 'Father Job:' }}</span>
                            <span class="f-val">{{ $varan->father_job ?? $varan->father_occupation ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="father_native">
                            <span class="f-label">{{ $isLangTa ? 'பூர்வீகம்:' : 'Native Place:' }}</span>
                            <span class="f-val">{{ $varan->father_native ?? $varan->native_place ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 10: Mother Name & Mobile (2 Columns: Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-2col" data-print-field="mother_name_row">
                        <div class="col-span-2" data-print-field="mother_name">
                            <span class="f-label">{{ $isLangTa ? 'தாய் பெயர்:' : 'Mother Name:' }}</span>
                            <span class="f-val">{{ $varan->mother_name ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="mother_mobile">
                            <span class="f-label">{{ $isLangTa ? 'அலைபேசி:' : 'Mobile:' }}</span>
                            <span class="f-val">{{ $varan->mother_mobile ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 11: Mother Job & Mother Native (2 Columns: Right starts at 62%) -->
                    <div class="dotted-row middle-dotted-row row-2col" data-print-field="mother_occupation_row">
                        <div class="col-span-2" data-print-field="mother_occupation">
                            <span class="f-label">{{ $isLangTa ? 'தாயின் பணி:' : 'Mother Job:' }}</span>
                            <span class="f-val">{{ $varan->mother_job ?? $varan->mother_occupation ?? $dash }}</span>
                        </div>
                        <div class="col-right" data-print-field="mother_native">
                            <span class="f-label">{{ $isLangTa ? 'பூர்வீகம்:' : 'Native Place:' }}</span>
                            <span class="f-val">{{ $varan->mother_native ?? $varan->native_place ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 12: Full Address (Auto-expanding ruled lines) -->
                    <div class="dotted-row middle-dotted-row" data-print-field="address">
                        <span class="f-label">{{ $isLangTa ? 'முகவரி:' : 'Address:' }}</span>
                        <span class="f-val">{{ $addressLines[0] ?? $dash }}</span>
                    </div>
                    @if(count($addressLines) > 1)
                        @for($ai = 1; $ai < count($addressLines); $ai++)
                            <div class="dotted-row middle-dotted-row continuation-dotted-row" data-continuation-for="address">
                                <span class="f-val continuation-f-val">{{ $addressLines[$ai] }}</span>
                            </div>
                        @endfor
                    @endif

                    <!-- Row 13: Family Wealth / Facilities (Auto-expanding ruled lines) -->
                    <div class="dotted-row middle-dotted-row" data-print-field="family_wealth" data-raw-text="{{ htmlspecialchars($finalWealth, ENT_QUOTES, 'UTF-8') }}">
                        <span class="f-label">{{ $isLangTa ? 'குடும்ப வருமானம்/வசதிகள்:' : 'Family Wealth / Assets:' }}</span>
                        <span class="f-val">{{ $wealthLines[0] ?? $dash }}</span>
                    </div>
                    @if(count($wealthLines) > 1)
                        @for($wi = 1; $wi < count($wealthLines); $wi++)
                            <div class="dotted-row middle-dotted-row continuation-dotted-row" data-continuation-for="family_wealth">
                                <span class="f-val continuation-f-val">{{ $wealthLines[$wi] }}</span>
                            </div>
                        @endfor
                    @endif

                    <!-- Row 14: Siblings & Relatives (Auto-expanding ruled lines) -->
                    <div class="dotted-row middle-dotted-row" data-print-field="siblings" data-raw-text="{{ htmlspecialchars($finalSiblings, ENT_QUOTES, 'UTF-8') }}">
                        <span class="f-label">{{ $isLangTa ? 'உடன் பிறந்தோர், உறவினர் விபரம்:' : 'Siblings & Relatives:' }}</span>
                        <span class="f-val">{{ $isBlank ? '' : ($siblingsLines[0] ?? '-') }}</span>
                    </div>
                    @if(count($siblingsLines) > 1)
                        @for($si = 1; $si < count($siblingsLines); $si++)
                            <div class="dotted-row middle-dotted-row continuation-dotted-row" data-continuation-for="siblings">
                                <span class="f-val continuation-f-val">{{ $siblingsLines[$si] }}</span>
                            </div>
                        @endfor
                    @endif

                    @php
                        $dVal = trim($varan->dosham ?? '');
                        $isSutham = str_contains($dVal, 'சுத்தம்') || str_contains(strtolower($dVal), 'sutham') || str_contains(strtolower($dVal), 'clean');
                        $isRahu = str_contains($dVal, 'ராகு') || str_contains(strtolower($dVal), 'rahu');
                        $isKetu = str_contains($dVal, 'கேது') || str_contains(strtolower($dVal), 'ketu');
                        $isRahuKetu = $isRahu || $isKetu;
                        $isSevvai = str_contains($dVal, 'செவ்வாய்') || str_contains(strtolower($dVal), 'sevvai') || str_contains(strtolower($dVal), 'mars');
                    @endphp

                    <!-- Row 15: 3-Column Astrology Labels [Rasi 32% | Nakshatram 41% | Lagnam 27%] (Strictly in Tamil) -->
                    <div class="dotted-row middle-dotted-row row-astrology-3col" data-print-field="astrology_combined">
                        <div class="col-ast-rasi" data-print-field="rasi">
                            <span class="f-label">ராசி:</span>
                            <span class="f-val">{{ $varan->rasi ?? $dash }}</span>
                        </div>
                        <div class="col-ast-natchathiram" data-print-field="natchathiram">
                            <span class="f-label">நட்சத்திரம்:</span>
                            <span class="f-val">{{ $varan->natchathiram ?? $dash }}</span>
                        </div>
                        <div class="col-ast-lagnam" data-print-field="lagnam">
                            <span class="f-label">லக்னம்:</span>
                            <span class="f-val">{{ $varan->lagnam ?? $dash }}</span>
                        </div>
                    </div>

                    <!-- Row 16: 3-Column Astrology Row [Candidate Photo | Rasi Kattam | Navamsam Kattam] -->
                    <div class="photo-and-charts-row">
                        <!-- Column 1: Candidate Photo (Matched to Kattam Height 196px) -->
                        <div class="candidate-photo-box">
                            <div class="candidate-photo-frame">
                                @if($showPhoto && (!empty($varan->photo_path) || !empty($varan->photo_url)))
                                    <img src="{{ $photoSrc }}" class="candidate-photo-img" alt="{{ $varan->name }}" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'candidate-photo-placeholder\'><div style=\'font-size:24px;margin-bottom:4px;opacity:0.65;\'>📷</div><span>NO PHOTO</span></div>';">
                                @else
                                    <div class="candidate-photo-placeholder">
                                        <div style="font-size: 24px; margin-bottom: 4px; opacity: 0.65;">📷</div>
                                        <span>{{ $isLangTa ? 'வரன் புகைப்படம்' : 'Passport Photo' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Column 2: Rasi Kattam (Rectangular 275px x 196px) -->
                        <div class="chart-wrapper">
                            <div class="kattam-grid">
                                {!! $renderChartCell(12, $rasiChart['12'] ?? []) !!}
                                {!! $renderChartCell(1, $rasiChart['1'] ?? []) !!}
                                {!! $renderChartCell(2, $rasiChart['2'] ?? []) !!}
                                {!! $renderChartCell(3, $rasiChart['3'] ?? []) !!}

                                {!! $renderChartCell(11, $rasiChart['11'] ?? []) !!}
                                <div class="kattam-center-box">
                                    <img src="{{ $rasiEarthSrc }}" class="chart-center-graphic" alt="Rasi Earth" onerror="this.src='/images/chart_rasi_earth.png'">
                                    <div class="chart-center-title">ராசி</div>
                                </div>
                                {!! $renderChartCell(4, $rasiChart['4'] ?? []) !!}

                                {!! $renderChartCell(10, $rasiChart['10'] ?? []) !!}
                                {!! $renderChartCell(5, $rasiChart['5'] ?? []) !!}

                                {!! $renderChartCell(9, $rasiChart['9'] ?? []) !!}
                                {!! $renderChartCell(8, $rasiChart['8'] ?? []) !!}
                                {!! $renderChartCell(7, $rasiChart['7'] ?? []) !!}
                                {!! $renderChartCell(6, $rasiChart['6'] ?? []) !!}
                            </div>
                        </div>

                        <!-- Column 3: Navamsam Kattam (Rectangular 275px x 196px) -->
                        <div class="chart-wrapper">
                            <div class="kattam-grid">
                                {!! $renderChartCell(12, $navamsamChart['12'] ?? []) !!}
                                {!! $renderChartCell(1, $navamsamChart['1'] ?? []) !!}
                                {!! $renderChartCell(2, $navamsamChart['2'] ?? []) !!}
                                {!! $renderChartCell(3, $navamsamChart['3'] ?? []) !!}

                                {!! $renderChartCell(11, $navamsamChart['11'] ?? []) !!}
                                <div class="kattam-center-box">
                                    <img src="{{ $navYantraSrc }}" class="chart-center-graphic" alt="Navamsam Yantra" onerror="this.src='/images/chart_navamsam_yantra.png'">
                                    <div class="chart-center-title">நவாம்சம்</div>
                                </div>
                                {!! $renderChartCell(4, $navamsamChart['4'] ?? []) !!}

                                {!! $renderChartCell(10, $navamsamChart['10'] ?? []) !!}
                                {!! $renderChartCell(5, $navamsamChart['5'] ?? []) !!}

                                {!! $renderChartCell(9, $navamsamChart['9'] ?? []) !!}
                                {!! $renderChartCell(8, $navamsamChart['8'] ?? []) !!}
                                {!! $renderChartCell(7, $navamsamChart['7'] ?? []) !!}
                                {!! $renderChartCell(6, $navamsamChart['6'] ?? []) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Row 17: Other Notes Box (2-Line Structured Layout) -->
                    <div class="other-notes-box">
                        <div class="notes-box-top-row">
                            <div style="display: flex; align-items: center; gap: 14px;">
                                <span class="notes-box-title">இதர குறிப்புகள்:</span>
                                <div class="notes-strip-chk-group">
                                    <span><span class="chk-box {{ $isMudhalManam ? 'checked' : '' }}"></span> முதல் மணம்</span>
                                    <span><span class="chk-box {{ $isRemarriage ? 'checked' : '' }}"></span> மறுமணம்</span>
                                </div>
                            </div>
                            <span class="notes-strip-phone">90808 49042</span>
                        </div>
                        <div class="notes-strip-warning">
                            * மறுமணம் என்றால் விவாகரத்து சான்றிதழ் நகல் இணைக்கப்பட வேண்டும்.
                        </div>
                    </div>

                    <!-- Row 18: Dasa Balance Row + Dosham Checkboxes on Right Side (Strictly in Tamil) -->
                    <div class="dotted-row middle-dotted-row" data-print-field="thisai_iruppu" style="display: flex; align-items: baseline; justify-content: space-between; gap: 8px;">
                        <div style="display: flex; align-items: baseline; flex: 1; min-width: 0; padding-right: 8px;">
                            <span class="f-label" style="flex-shrink: 0; margin-right: 6px;">திசை இருப்பு:</span>
                            <span class="f-val">{{ $varan->thisai_iruppu ?? $dash }}</span>
                        </div>
                        <div class="chk-group" style="display: flex; align-items: center; gap: 8px; flex-shrink: 0; margin-left: auto; white-space: nowrap;">
                            <span style="display: inline-flex; align-items: center; white-space: nowrap; flex-shrink: 0;"><span class="chk-box {{ $isSutham ? 'checked' : '' }}" style="margin-right: 2px !important;"></span>சுத்தம்</span>
                            <span style="display: inline-flex; align-items: center; white-space: nowrap; flex-shrink: 0;"><span class="chk-box {{ $isRahuKetu ? 'checked' : '' }}" style="margin-right: 2px !important;"></span>ராகு/கேது</span>
                            <span style="display: inline-flex; align-items: center; white-space: nowrap; flex-shrink: 0;"><span class="chk-box {{ $isSevvai ? 'checked' : '' }}" style="margin-right: 2px !important;"></span>செவ்வாய்</span>
                        </div>
                    </div>

                    <!-- Row 19: Expectations Field (Field Name + Answer Font) -->
                    <div class="dotted-row middle-dotted-row" data-print-field="expectations" data-raw-text="{{ htmlspecialchars($finalExpectations, ENT_QUOTES, 'UTF-8') }}" style="min-height: 28px; height: auto; align-items: baseline; padding-top: 2px; padding-bottom: 3px;">
                        <span class="f-label">{{ $isLangTa ? 'எதிர்ப்பார்ப்புகள் மற்றும் இதர குறிப்புகள் குறிப்பிடவும்:' : 'Expectations and other notes (to be specified):' }}</span>
                        <span class="f-val">{{ $expectationsLines[0] ?? $dash }}</span>
                    </div>

                    @if(count($expectationsLines) > 1)
                        @for($ei = 1; $ei < count($expectationsLines); $ei++)
                            <div class="dotted-row middle-dotted-row continuation-dotted-row" data-continuation-for="expectations" style="min-height: 26px;">
                                <span class="f-val continuation-f-val">{{ $expectationsLines[$ei] }}</span>
                            </div>
                        @endfor
                    @endif
                    <!-- Elegant continuation dotted lines to balance page layout and fill bottom space gracefully -->
                    @php
                        $linesNeeded = $isRemarriage ? max(0, min(2, 3 - count($expectationsLines) - $totalExtraLines)) : max(0, min(3, 4 - count($expectationsLines) - $totalExtraLines));
                    @endphp
                    @for($ci = 0; $ci < $linesNeeded; $ci++)
                        <div class="dotted-row middle-dotted-row" style="border-bottom: 1.3px dotted #000000; min-height: 26px;"></div>
                    @endfor

                    <!-- Row 20: Bottom Signature (Right-aligned with field title font - Only for Remarriage) -->
                    @if($isRemarriage)
                    <div class="bottom-signature-row">
                        <span class="f-label" style="margin-right: 0;">{{ $isLangTa ? 'வரனின் பெற்றோர் / காப்பாளர்' : 'Parent / Guardian' }}</span>
                    </div>
                    @endif

                    <!-- Hidden Digital Payload for 100% Round-trip Form Autofill -->
                    @if(isset($varan))
                    @php
                        $payloadData = $varan->toArray();
                        // Keep payload compact (~1.5KB) so Chrome print text buffer (64KB) never drops it
                        unset($payloadData['photo_base64']);
                    @endphp
                    <div id="hiddenDigitalPayload" class="hidden-payload-marker" style="position: absolute; left: 20px; bottom: 8px; width: 700px; max-width: 700px; word-break: break-all; overflow-wrap: break-word; font-family: monospace !important; font-size: 6px !important; line-height: 6px !important; color: {{ $pageBgColor ?? '#fffdf0' }} !important; opacity: 0.05 !important; background: transparent !important; pointer-events: none !important; z-index: 1 !important;" aria-hidden="true">
                        ###VARAN_EMBED_START###{{ base64_encode(json_encode($payloadData, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE)) }}###VARAN_EMBED_END###
                    </div>
                    @endif

                </div>
            </div>
        </div>

        </div>

    <!-- Client-side Script to Read and Apply Print Styles dynamically -->
    <script>
        let printConfig = {
            fontSize: '12.8px',
            color: '#002060',
            fontFamily: "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif",
            fontWeight: '800',
            labelColorMale: '#002060',
            labelColorFemale: '#881337',
            labelColorRemarriage: '#0284c7',
            highlights: {}
        };

        function loadPrintStylesFromStorage() {
            let combinedHighlights = {};
            // 1. Merge server print styles first (syncs laptop with phone changes!)
            if (window.__SERVER_PRINT_STYLES__ && typeof window.__SERVER_PRINT_STYLES__ === 'object' && Object.keys(window.__SERVER_PRINT_STYLES__).length > 0) {
                printConfig = Object.assign({}, printConfig, window.__SERVER_PRINT_STYLES__);
                if (window.__SERVER_PRINT_STYLES__.highlights && typeof window.__SERVER_PRINT_STYLES__.highlights === 'object') {
                    Object.assign(combinedHighlights, window.__SERVER_PRINT_STYLES__.highlights);
                }
            }
            // 2. Merge local storage print styles (Preserves active local choices!)
            try {
                const saved = localStorage.getItem('matrimony_print_styles');
                if (saved) {
                    const parsed = JSON.parse(saved);
                    if (parsed && typeof parsed === 'object') {
                        if (parsed.highlights && typeof parsed.highlights === 'object' && Object.keys(parsed.highlights).length > 0) {
                            Object.assign(combinedHighlights, parsed.highlights);
                        }
                        printConfig = Object.assign({}, printConfig, parsed);
                    }
                }
            } catch(e) {}
            if (Object.keys(combinedHighlights).length > 0) {
                printConfig.highlights = combinedHighlights;
            }
            applyPrintConfigToDOM();
        }

                function applyPrintConfigToDOM() {
            const printSheetGender = "{{ $isRemarriage ? 'remarriage' : ($isMale ? 'male' : 'female') }}";
            
            // 1. Resolve Label Color (Male: #14532d Green, Female: #881337 Pink, Remarriage: #0369a1 Blue)
            let activeLabelColor = '#14532d';
            if (printSheetGender === 'remarriage') {
                activeLabelColor = printConfig.remarriageLabelColor || printConfig.labelColorRemarriage || '#0369a1';
            } else if (printSheetGender === 'female') {
                activeLabelColor = printConfig.femaleLabelColor || printConfig.labelColorFemale || '#881337';
            } else {
                activeLabelColor = printConfig.maleLabelColor || printConfig.labelColorMale || '#14532d';
            }

            // 2. Resolve Answer Color (Male: #000000, Female: #000000, Remarriage: #000000 or custom)
            let activeAnswerColor = '#000000';
            if (printSheetGender === 'remarriage') {
                activeAnswerColor = printConfig.remarriageAnswerColor || printConfig.color || '#000000';
            } else if (printSheetGender === 'female') {
                activeAnswerColor = printConfig.femaleAnswerColor || printConfig.color || '#000000';
            } else {
                activeAnswerColor = printConfig.maleAnswerColor || printConfig.color || '#000000';
            }

            const isCustomVal = (v) => v && typeof v === 'string' && v.trim() !== '' && v.toUpperCase() !== 'INHERIT';

            const commonFamily = isCustomVal(printConfig.fontFamily) ? printConfig.fontFamily : "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif";
            const commonSize = isCustomVal(printConfig.fontSize) ? printConfig.fontSize : '13.5px';
            const commonWeight = isCustomVal(printConfig.fontWeight) ? printConfig.fontWeight : '800';

            const labelFamily = isCustomVal(printConfig.labelFontFamily) ? printConfig.labelFontFamily : commonFamily;
            const labelSize = isCustomVal(printConfig.labelFontSize) ? printConfig.labelFontSize : commonSize;
            const labelWeight = isCustomVal(printConfig.labelFontWeight) ? printConfig.labelFontWeight : (commonWeight || '800');

            const answerFamily = isCustomVal(printConfig.answerFontFamily) ? printConfig.answerFontFamily : commonFamily;
            const answerSize = isCustomVal(printConfig.answerFontSize) ? printConfig.answerFontSize : commonSize;
            const answerWeight = isCustomVal(printConfig.answerFontWeight) ? printConfig.answerFontWeight : '700';

            let css = `
                .main-title {
                    font-family: ${printConfig.headerTitleFontFamily || "'Noto Serif Tamil', 'Mukta Malar', 'Baloo Thambi 2', 'Latha', serif"} !important;
                    font-size: ${printConfig.headerTitleFontSize || '19.5px'} !important;
                    font-weight: ${printConfig.headerTitleFontWeight || '900'} !important;
                }

                .a4-sheet-container, .a4-page, .outer-frame, .inner-frame, .dotted-row, .has-extra-lines .dotted-row, .has-many-lines .dotted-row {
                    font-family: ${commonFamily} !important;
                    font-size: ${commonSize} !important;
                    font-weight: ${commonWeight} !important;
                }
                .dotted-row .f-label,
                .photo-and-charts-row .f-label,
                .other-notes-box .f-label,
                .expectations-box .f-label,
                .f-label {
                    font-size: ${labelSize} !important;
                    color: ${activeLabelColor} !important;
                    font-family: ${labelFamily} !important;
                    font-weight: ${labelWeight} !important;
                }
                .dotted-row .f-val,
                .photo-and-charts-row .f-val,
                .other-notes-box .f-val,
                .expectations-box .f-val,
                .f-val {
                    font-size: ${answerSize} !important;
                    color: ${activeAnswerColor} !important;
                    font-family: ${answerFamily} !important;
                    font-weight: ${answerWeight} !important;
                }
                .bottom-signature-row {
                    display: flex !important;
                    justify-content: flex-end !important;
                    padding-top: 4px !important;
                    padding-bottom: 2px !important;
                    position: relative !important;
                    z-index: 2 !important;
                    margin-top: auto !important;
                }

                .chk-group,
                .chk-group span,
                .notes-box-title,
                .notes-strip-chk-group,
                .notes-strip-chk-group span,
                .notes-strip-warning,
                .notes-strip-phone {
                    color: ${activeLabelColor} !important;
                    font-family: ${labelFamily} !important;
                    font-weight: ${labelWeight} !important;
                }
                .chk-group,
                .chk-group span,
                .notes-box-title,
                .notes-strip-chk-group,
                .notes-strip-chk-group span,
                .notes-strip-phone {
                    font-size: ${labelSize} !important;
                }
                .notes-strip-warning {
                    font-size: calc(${labelSize} * 0.88) !important;
                    line-height: 1.3 !important;
                    white-space: normal !important;
                }
                .notes-strip-phone {
                    border: 1.5px solid ${activeLabelColor} !important;
                    background: transparent !important;
                }
                .other-notes-box {
                    border: 1.5px solid ${activeLabelColor} !important;
                }
                .chk-box {
                    border: 1.5px solid ${activeLabelColor} !important;
                    background: #ffffff !important;
                }
                .chk-box.checked {
                    background: #ffffff !important;
                    color: ${activeAnswerColor} !important;
                }
                .chk-box.checked::after {
                    content: '✓' !important;
                    color: ${activeAnswerColor} !important;
                    font-weight: 900 !important;
                }
            `;



            let styleEl = document.getElementById('dynamicPrintCustomStyles');
            if (!styleEl) {
                styleEl = document.createElement('style');
                styleEl.id = 'dynamicPrintCustomStyles';
                document.head.appendChild(styleEl);
            }
            styleEl.innerHTML = css;

            // Dynamically adjust overflowing text fields so they flow cleanly without ellipsis cutoff
            adjustOverflowingPrintFields();
        }

        function adjustOverflowingPrintFields() {
            try {
                const checkFields = ['siblings', 'expectations', 'address', 'family_wealth'];
                checkFields.forEach(fKey => {
                    const row = document.querySelector(`[data-print-field="${fKey}"]`);
                    if (!row) return;
                    const valEl = row.querySelector('.f-val');
                    if (!valEl) return;
                    const rawText = (row.getAttribute('data-raw-text') || '').trim();
                    if (!rawText || rawText === '-' || rawText === 'இல்லை' || rawText === 'None') return;

                    // Cleanly remove all existing continuation rows for this field (both server-rendered and dynamic)
                    let next = row.nextElementSibling;
                    while (next && next.classList.contains('continuation-dotted-row') && (next.getAttribute('data-continuation-for') === fKey || next.hasAttribute('data-dynamic-split'))) {
                        const toRemove = next;
                        next = next.nextElementSibling;
                        toRemove.remove();
                    }

                    // Available width for line 1 and continuation lines
                    const a4Inner = row.closest('.inner-frame') || row.parentElement;
                    const rowWidth = row.clientWidth || (a4Inner ? a4Inner.clientWidth : 0) || 730;
                    const labelEl = row.querySelector('.f-label');
                    const labelWidth = labelEl ? labelEl.offsetWidth : 120;
                    const line1Max = Math.max(120, rowWidth - labelWidth - 8);
                    const line2Max = Math.max(120, rowWidth - 28);

                    // Off-screen canvas text measurement
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const cs = window.getComputedStyle(valEl);
                    ctx.font = `${cs.fontWeight || '700'} ${cs.fontSize || '13.5px'} ${cs.fontFamily || "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif"}`;

                    // If full rawText already fits into Line 1 width:
                    if (ctx.measureText(rawText).width <= line1Max) {
                        valEl.textContent = rawText;
                        return;
                    }

                    // Split text into words/tokens (preserving spaces & punctuation boundaries)
                    const words = rawText.match(/\S+|\s+/g) || [rawText];
                    let lines = [];
                    let cur = '';

                    for (let w of words) {
                        const targetMax = (lines.length === 0) ? line1Max : line2Max;
                        const candidate = cur + w;
                        if (ctx.measureText(candidate.trim()).width <= targetMax) {
                            cur = candidate;
                        } else {
                            if (cur.trim()) lines.push(cur.trim());
                            cur = w;
                        }
                    }
                    if (cur.trim()) lines.push(cur.trim());

                    if (lines.length > 0) {
                        valEl.textContent = lines[0];
                        let lastInserted = row;
                        for (let i = 1; i < lines.length; i++) {
                            const contRow = document.createElement('div');
                            contRow.className = 'dotted-row middle-dotted-row continuation-dotted-row';
                            contRow.setAttribute('data-continuation-for', fKey);
                            contRow.setAttribute('data-dynamic-split', 'true');
                            contRow.innerHTML = `<span class="f-val continuation-f-val">${lines[i]}</span>`;
                            lastInserted.parentNode.insertBefore(contRow, lastInserted.nextSibling);
                            lastInserted = contRow;
                        }
                    }
                });
            } catch(e) {}
        }

        function resetModalStyles() {
            printConfig = {
                fontSize: '12.8px',
                color: '#002060',
                fontFamily: "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif",
                fontWeight: '800',
                labelColorMale: '#002060',
                labelColorFemale: '#881337',
                labelColorRemarriage: '#0284c7',
                highlights: {}
            };
            try {
                localStorage.removeItem('matrimony_print_styles');
            } catch(e) {}
            applyPrintConfigToDOM();
            closePrintStyleModal();
        }

        window.exportPageAsPdf = async function(customFilename) {
            const page = document.getElementById('printSheetPage1') || document.querySelector('.a4-page');
            if (!page) {
                alert('A4 page element not found');
                return false;
            }

            const btnPdf = document.getElementById('btnSavePdfTop');
            const origHtml = btnPdf ? btnPdf.innerHTML : '';
            if (btnPdf) {
                btnPdf.disabled = true;
                btnPdf.innerHTML = `⏳ <span>{{ $isLangTa ? 'PDF தயாராகிறது...' : 'Generating PDF...' }}</span>`;
            }

            try {
                // Ensure all images are loaded
                const imgs = Array.from(page.querySelectorAll('img'));
                await Promise.all(imgs.map(img => {
                    if (img.complete) return Promise.resolve();
                    return new Promise(res => { img.onload = res; img.onerror = res; });
                }));

                if (document.fonts && document.fonts.ready) {
                    await document.fonts.ready;
                }

                await new Promise(r => setTimeout(r, 200));

                const canvas = await html2canvas(page, {
                    scale: 2.2,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '{{ $pageBgColor ?? "#fffdf0" }}',
                    scrollX: 0,
                    scrollY: 0,
                    windowWidth: 794
                });

                const jspdfModule = window.jspdf || window;
                const jsPDF = jspdfModule.jsPDF || jspdfModule;
                const pdf = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'a4',
                    compress: true
                });

                const rawTitle = {!! json_encode($docTitle) !!};
                const filename = (customFilename || rawTitle).replace(/[\/\\?%*:|"<>]/g, '_').trim() + '.pdf';

                const payloadEl = page.querySelector('#hiddenDigitalPayload') || document.getElementById('hiddenDigitalPayload');
                const payloadText = payloadEl ? (payloadEl.textContent || payloadEl.innerText || '').trim() : '';
                const textContent = page.innerText || '';

                pdf.setProperties({
                    title: rawTitle,
                    subject: payloadText || 'Master Matrimony Biodata',
                    keywords: payloadText,
                    author: 'Master Matrimony',
                    creator: 'Master Matrimony'
                });

                const imgData = canvas.toDataURL('image/jpeg', 0.94);
                pdf.addImage(imgData, 'JPEG', 0, 0, 210, 297, undefined, 'FAST');

                // Embed digital JSON payload directly into PDF stream invisibly (Mode 3: neither fill nor stroke, placed off-canvas)
                if (payloadText) {
                    const chunks = payloadText.match(/.{1,70}/g) || [payloadText];
                    pdf.setFontSize(2);
                    if (pdf.internal && typeof pdf.internal.write === 'function') {
                        pdf.internal.write('/Tr 3 Tr\n');
                    }
                    pdf.setTextColor(255, 255, 255);
                    pdf.text(chunks, -500, -500);
                    if (pdf.internal && typeof pdf.internal.write === 'function') {
                        pdf.internal.write('/Tr 0 Tr\n');
                    }
                }
                if (typeof rawTitle !== 'undefined' && rawTitle) {
                    const asciiTitle = String(rawTitle).replace(/[^\x20-\x7E]/g, ' ').trim();
                    if (asciiTitle) {
                        pdf.setFontSize(3);
                        if (pdf.internal && typeof pdf.internal.write === 'function') {
                            pdf.internal.write('/Tr 3 Tr\n');
                        }
                        pdf.setTextColor(255, 255, 255);
                        pdf.text(asciiTitle, -500, -500);
                        if (pdf.internal && typeof pdf.internal.write === 'function') {
                            pdf.internal.write('/Tr 0 Tr\n');
                        }
                    }
                }

                const blob = pdf.output('blob');
                const blobUrl = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = blobUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                setTimeout(() => {
                    if (a.parentNode) document.body.removeChild(a);
                    URL.revokeObjectURL(blobUrl);
                }, 3000);

                return true;
            } catch (err) {
                console.error('PDF export error:', err);
                throw err;
            } finally {
                if (btnPdf) {
                    btnPdf.disabled = false;
                    btnPdf.innerHTML = origHtml;
                }
            }
        };

        // Ensure styles run immediately, on DOM ready, and right before print
        try { loadPrintStylesFromStorage(); } catch(e) {}
        window.addEventListener('beforeprint', function() { try { loadPrintStylesFromStorage(); } catch(e) {} });

        window.addEventListener('DOMContentLoaded', function() {
            loadPrintStylesFromStorage();

            // Client-side safeguard for photo visibility:
            // If localStorage has photo preference set to '0' (hide), ensure photo is hidden!
            const localPhotoPref = localStorage.getItem('matrimony_admin_show_photo');
            if (localPhotoPref === '0') {
                const photoFrame = document.querySelector('.candidate-photo-frame');
                if (photoFrame) {
                    photoFrame.innerHTML = '<div class="candidate-photo-placeholder"><div style="font-size:24px;margin-bottom:4px;opacity:0.65;">📷</div><span>{{ $isLangTa ? "வரன் புகைப்படம்" : "Passport Photo" }}</span></div>';
                }
            }

            // Ensure all language links retain &show_photo= preference!
            document.querySelectorAll('a[href*="lang="]').forEach(a => {
                try {
                    const u = new URL(a.href, window.location.origin);
                    const pref = (localPhotoPref !== null) ? localPhotoPref : '{{ $showPhoto ? "1" : "0" }}';
                    u.searchParams.set('show_photo', pref);
                    a.href = u.pathname + u.search;
                } catch(e) {}
            });
        });
    </script>
</body>
</html>