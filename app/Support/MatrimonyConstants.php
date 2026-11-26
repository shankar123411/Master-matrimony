<?php

namespace App\Support;

class MatrimonyConstants
{
    /**
     * 12 ராசிகள் (100% Pure Tamil & 100% Pure English - Zero Mixing!)
     */
    public static function rasis(string $lang = 'ta'): array
    {
        if ($lang === 'en') {
            return [
                'Mesham' => 'Aries',
                'Rishabam' => 'Taurus',
                'Mithunam' => 'Gemini',
                'Kadagam' => 'Cancer',
                'Simmam' => 'Leo',
                'Kanni' => 'Virgo',
                'Thulam' => 'Libra',
                'Viruchigam' => 'Scorpio',
                'Dhanusu' => 'Sagittarius',
                'Magaram' => 'Capricorn',
                'Kumbam' => 'Aquarius',
                'Meenam' => 'Pisces',
            ];
        }

        return [
            'மேஷம்' => 'மேஷம்',
            'ரிஷபம்' => 'ரிஷபம்',
            'மிதுனம்' => 'மிதுனம்',
            'கடகம்' => 'கடகம்',
            'சிம்மம்' => 'சிம்மம்',
            'கன்னி' => 'கன்னி',
            'துலாம்' => 'துலாம்',
            'விருச்சிகம்' => 'விருச்சிகம்',
            'தனுசு' => 'தனுசு',
            'மகரம்' => 'மகரம்',
            'கும்பம்' => 'கும்பம்',
            'மீனம்' => 'மீனம்',
        ];
    }

    /**
     * 27 நட்சத்திரங்கள் (Pure Tamil & Pure English)
     */
    public static function natchathirams(string $lang = 'ta'): array
    {
        if ($lang === 'en') {
            return [
                'Ashwini' => '1. Ashwini',
                'Bharani' => '2. Bharani',
                'Krittika' => '3. Krittika',
                'Rohini' => '4. Rohini',
                'Mrigashira' => '5. Mrigashira',
                'Ardra' => '6. Ardra',
                'Punarvasu' => '7. Punarvasu',
                'Pushya' => '8. Pushya',
                'Ashlesha' => '9. Ashlesha',
                'Magha' => '10. Magha',
                'Purva Phalguni' => '11. Purva Phalguni',
                'Uttara Phalguni' => '12. Uttara Phalguni',
                'Hastha' => '13. Hastha',
                'Chitra' => '14. Chitra',
                'Swathi' => '15. Swathi',
                'Vishakha' => '16. Vishakha',
                'Anuradha' => '17. Anuradha',
                'Jyeshtha' => '18. Jyeshtha',
                'Moola' => '19. Moola',
                'Purvashadha' => '20. Purvashadha',
                'Uttarashadha' => '21. Uttarashadha',
                'Shravana' => '22. Shravana',
                'Dhanishta' => '23. Dhanishta',
                'Shatabhisha' => '24. Shatabhisha',
                'Purva Bhadrapada' => '25. Purva Bhadrapada',
                'Uttara Bhadrapada' => '26. Uttara Bhadrapada',
                'Revathi' => '27. Revathi',
            ];
        }

        return [
            'அஸ்வினி' => '1. அஸ்வினி',
            'பரணி' => '2. பரணி',
            'கார்த்திகை' => '3. கார்த்திகை',
            'ரோகிணி' => '4. ரோகிணி',
            'மிருகசீரிடம்' => '5. மிருகசீரிடம்',
            'திருவாதிரை' => '6. திருவாதிரை',
            'புனர்பூசம்' => '7. புனர்பூசம்',
            'பூசம்' => '8. பூசம்',
            'ஆயில்யம்' => '9. ஆயில்யம்',
            'மகம்' => '10. மகம்',
            'பூரம்' => '11. பூரம்',
            'உத்திரம்' => '12. உத்திரம்',
            'அஸ்தம்' => '13. அஸ்தம்',
            'சித்திரை' => '14. சித்திரை',
            'சுவாதி' => '15. சுவாதி',
            'விசாகம்' => '16. விசாகம்',
            'அனுஷம்' => '17. அனுஷம்',
            'கேட்டை' => '18. கேட்டை',
            'மூலம்' => '19. மூலம்',
            'பூராடம்' => '20. பூராடம்',
            'உத்திராடம்' => '21. உத்திராடம்',
            'திருவோணம்' => '22. திருவோணம்',
            'அவிட்டம்' => '23. அவிட்டம்',
            'சதயம்' => '24. சதயம்',
            'பூரட்டாதி' => '25. பூரட்டாதி',
            'உத்திரட்டாதி' => '26. உத்திரட்டாதி',
            'ரேவதி' => '27. ரேவதி',
        ];
    }

    /**
     * 12 லக்னங்கள்
     */
    public static function lagnams(string $lang = 'ta'): array
    {
        return self::rasis($lang);
    }

    /**
     * சமூகம் (Community Options)
     */
    public static function communities(string $lang = 'ta'): array
    {
        try {
            if (class_exists(\App\Models\MatrimonyMasterOption::class)) {
                $dbOpts = \App\Models\MatrimonyMasterOption::getOptionsForCategory('community', $lang);
                if (!empty($dbOpts)) {
                    return $dbOpts;
                }
            }
        } catch (\Throwable $e) {}

        if ($lang === 'en') {
            return [
                'Kaikolar' => 'Kaikolar',
                'Sengunthar' => 'Sengunthar',
            ];
        }

        return [
            'கைக்கோளர்' => 'கைக்கோளர்',
            'செங்குந்தர்' => 'செங்குந்தர்',
        ];
    }

    /**
     * வேலை / தொழில் (Job / Profession Options)
     */
    public static function jobs(string $lang = 'ta'): array
    {
        try {
            if (class_exists(\App\Models\MatrimonyMasterOption::class)) {
                $dbOpts = \App\Models\MatrimonyMasterOption::getOptionsForCategory('job', $lang);
                if (!empty($dbOpts)) {
                    return $dbOpts;
                }
            }
        } catch (\Throwable $e) {}

        if ($lang === 'en') {
            return [
                'Software Engineer (IT)' => 'Software Engineer (IT)',
                'Government Job' => 'Government Job',
                'Doctor / Medical' => 'Doctor / Medical',
                'Business / Commerce' => 'Business / Enterprise Owner',
                'Banking & Finance' => 'Banking & Finance',
                'Private Company' => 'Private Company Employee',
                'Teacher / Professor' => 'Teacher / Professor',
                'Police / Defense' => 'Police / Armed Forces',
                'Lawyer / Advocate' => 'Lawyer / Advocate',
                'Civil Engineer' => 'Civil Engineer / Architect',
                'Agriculture' => 'Agriculture / Farming',
                'Self Employed' => 'Self Employed',
                'Others' => 'Other Professions',
            ];
        }

        return [
            'மென்பொருள் பொறியாளர்' => 'மென்பொருள் பொறியாளர் (IT)',
            'அரசு பணி' => 'அரசு பணி (Government Job)',
            'மருத்துவர்' => 'மருத்துவர் (Doctor)',
            'வணிகம் / சொந்த தொழில்' => 'வணிகம் / சொந்த தொழில் (Business)',
            'வங்கி பணி' => 'வங்கி பணி (Banking)',
            'தனியார் நிறுவனம்' => 'தனியார் நிறுவன பணி (Private Company)',
            'ஆசிரியர் / பேராசிரியர்' => 'ஆசிரியர் / பேராசிரியர் (Teacher)',
            'காவல்துறை / ராணுவம்' => 'காவல்துறை / ராணுவம் (Police/Defense)',
            'வழக்கறிஞர்' => 'வழக்கறிஞர் (Lawyer)',
            'பொறியாளர்' => 'பொறியாளர் (Civil / Mechanical)',
            'விவசாயம்' => 'விவசாயம் (Agriculture)',
            'சுயதொழில்' => 'சுயதொழில் (Self Employed)',
            'இதர பணிகள்' => 'இதர பணிகள் (Others)',
        ];
    }

    /**
     * கல்வி தகுதிகள் (Education Options - Pure Language)
     */
    public static function educations(string $lang = 'ta'): array
    {
        try {
            if (class_exists(\App\Models\MatrimonyMasterOption::class)) {
                $dbOpts = \App\Models\MatrimonyMasterOption::getOptionsForCategory('education', $lang);
                if (!empty($dbOpts)) {
                    return $dbOpts;
                }
            }
        } catch (\Throwable $e) {}

        if ($lang === 'en') {
            return [
                'B.E / B.Tech' => 'Bachelor of Engineering',
                'M.E / M.Tech' => 'Master of Engineering',
                'MBBS / Doctor' => 'Doctor of Medicine',
                'MD / MS' => 'Master of Surgery / MD',
                'BDS Dental' => 'Bachelor of Dental Surgery',
                'B.Pharm / M.Pharm' => 'Pharmacy Degree',
                'B.Sc Computer Science' => 'B.Sc Computer Science',
                'B.Sc Science' => 'Bachelor of Science',
                'B.Com' => 'Bachelor of Commerce',
                'BBA' => 'Bachelor of Business Admin',
                'BCA' => 'Bachelor of Computer App',
                'MCA' => 'Master of Computer App',
                'MBA' => 'Master of Business Admin',
                'Chartered Accountant' => 'Chartered Accountant',
                'Law Degree' => 'Law Degree',
                'Diploma' => 'Polytechnic Diploma',
                'Higher Secondary' => '12th Standard',
                'Secondary School' => '10th Standard',
                'PhD Doctorate' => 'Doctorate / PhD',
                'Others' => 'Other Qualifications',
            ];
        }

        return [
            'பொறியியல் பட்டம்' => 'பொறியியல் பட்டம் (B.E / B.Tech)',
            'முதுகலை பொறியியல்' => 'முதுகலை பொறியியல் (M.E / M.Tech)',
            'மருத்துவம்' => 'மருத்துவம் (MBBS)',
            'முதுகலை மருத்துவம்' => 'முதுகலை மருத்துவம் (MD / MS)',
            'பல் மருத்துவம்' => 'பல் மருத்துவம் (BDS)',
            'மருந்தியல்' => 'மருந்தியல் (B.Pharm)',
            'கணினி அறிவியல்' => 'கணினி அறிவியல் (B.Sc CS)',
            'அறிவியல் பட்டதாரி' => 'அறிவியல் பட்டதாரி (B.Sc)',
            'வணிகவியல் பட்டதாரி' => 'வணிகவியல் பட்டதாரி (B.Com)',
            'வணிக மேலாண்மை' => 'வணிக மேலாண்மை (BBA)',
            'கணினி பயன்பாட்டியல்' => 'கணினி பயன்பாட்டியல் (BCA)',
            'முதுகலை கணினி' => 'முதுகலை கணினி (MCA)',
            'முதுகலை மேலாண்மை' => 'முதுகலை மேலாண்மை (MBA)',
            'பட்டய கணக்காளர்' => 'பட்டய கணக்காளர் (CA)',
            'சட்ட பட்டதாரி' => 'சட்ட பட்டதாரி (LLB)',
            'டிப்ளமோ' => 'பட்டயப் படிப்பு (Diploma)',
            'பன்னிரண்டாம் வகுப்பு' => 'பன்னிரண்டாம் வகுப்பு (+2)',
            'பத்தாம் வகுப்பு' => 'பத்தாம் வகுப்பு (SSLC)',
            'முனைவர் பட்டம்' => 'முனைவர் பட்டம் (PhD)',
            'இதர படிப்புகள்' => 'இதர படிப்புகள்',
        ];
    }

    /**
     * தோஷம்
     */
    public static function doshams(string $lang = 'ta'): array
    {
        if ($lang === 'en') {
            return [
                'No Dosham' => 'No Dosham (Clean)',
                'Mars Dosham' => 'Mars Dosham',
                'Rahu Ketu Dosham' => 'Rahu Ketu Dosham',
                'Mars Dosham Remidied' => 'Mars Dosham Remedied',
                'Rahu Ketu Remidied' => 'Rahu Ketu Remedied',
                'All Remidied' => 'Clean / Rahu Ketu / Mars Remedied',
            ];
        }

        return [
            'சுத்தம்' => 'சுத்தம்',
            'செவ்வாய் தோஷம்' => 'செவ்வாய் தோஷம்',
            'ராகு கேது தோஷம்' => 'ராகு கேது தோஷம்',
            'செவ்வாய் நிவர்த்தி' => 'செவ்வாய் நிவர்த்தி',
            'ராகு கேது நிவர்த்தி' => 'ராகு கேது நிவர்த்தி',
            'சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி' => 'சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி',
        ];
    }

    /**
     * நிறம்
     */
    public static function complexions(string $lang = 'ta'): array
    {
        if ($lang === 'en') {
            return [
                'Fair' => 'Fair',
                'Wheatish' => 'Wheatish',
                'Very Fair' => 'Very Fair',
                'Dark' => 'Dark',
            ];
        }

        return [
            'சிவப்பு' => 'சிவப்பு',
            'மாநிறம்' => 'மாநிறம்',
            'அடர் சிவப்பு' => 'அடர் சிவப்பு',
            'கருப்பு' => 'கருப்பு',
        ];
    }

    /**
     * ரத்த வகை
     */
    public static function bloodGroups(): array
    {
        return [
            'A+' => 'A+',
            'A-' => 'A-',
            'B+' => 'B+',
            'B-' => 'B-',
            'O+' => 'O+',
            'O-' => 'O-',
            'AB+' => 'AB+',
            'AB-' => 'AB-',
            'A1B+' => 'A1B+',
            'A1B-' => 'A1B-',
            'A1+' => 'A1+',
            'A1-' => 'A1-',
            'A2B+' => 'A2B+',
            'A2B-' => 'A2B-',
        ];
    }

    /**
     * கிரகங்கள் (Planets)
     */
    public static function planets(string $lang = 'ta'): array
    {
        if ($lang === 'en') {
            return [
                'Asc' => 'Ascendant',
                'Sun' => 'Sun',
                'Moon' => 'Moon',
                'Mars' => 'Mars',
                'Merc' => 'Mercury',
                'Jup' => 'Jupiter',
                'Ven' => 'Venus',
                'Sat' => 'Saturn',
                'Rahu' => 'Rahu',
                'Ketu' => 'Ketu',
                'Mand' => 'Mandi',
            ];
        }

        return [
            'லக்' => 'லக்',
            'சூரி' => 'சூரி',
            'சந்' => 'சந்',
            'செவ்' => 'செவ்',
            'புத' => 'புத',
            'குரு' => 'குரு',
            'சுக்' => 'சுக்',
            'சனி' => 'சனி',
            'ராகு' => 'ராகு',
            'கேது' => 'கேது',
            'மாந்' => 'மாந்',
        ];
    }
}
