<?php

namespace Database\Seeders;

use App\Models\MatrimonyMasterOption;
use App\Models\User;
use App\Models\Varan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminUsername = trim((string) env('ADMIN_ID', 'admin'));
        $adminEmail = trim((string) env('ADMIN_EMAIL', 'admin@mastermatrimony.example'));
        $adminPassword = (string) env('ADMIN_PASSWORD', 'password');

        if ($adminUsername === '') {
            $adminUsername = 'admin';
        }
        if ($adminEmail === '') {
            $adminEmail = 'admin@mastermatrimony.example';
        }
        if ($adminPassword === '') {
            $adminPassword = 'password';
        }

        // Sync Filament / Laravel User account
        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminUsername,
                'password' => Hash::make($adminPassword),
            ]
        );

        // Sync Matrimony Portal custom admin_auth options if custom env vars are provided
        if (env('ADMIN_ID') || env('ADMIN_PASSWORD') || env('ADMIN_EMAIL')) {
            MatrimonyMasterOption::updateOrCreate(
                ['category' => 'admin_auth', 'name_ta' => 'admin_username'],
                ['name_en' => $adminUsername, 'sort_order' => 1]
            );
            MatrimonyMasterOption::updateOrCreate(
                ['category' => 'admin_auth', 'name_ta' => 'admin_email'],
                ['name_en' => $adminEmail, 'sort_order' => 2]
            );
            MatrimonyMasterOption::updateOrCreate(
                ['category' => 'admin_auth', 'name_ta' => 'admin_password'],
                ['name_en' => Hash::make($adminPassword), 'sort_order' => 3]
            );
        }

        if (Varan::count() === 0) {
            $profiles = [
                [
                    'varan_type' => 'aan',
                    'reg_no' => 'MM-2026-0001',
                    'reg_date' => '2026-10-15',
                    'name' => 'KARTHIK R',
                    'community' => 'முதலியார்',
                    'dob' => '1998-05-20',
                    'birth_time' => '07:15 AM',
                    'birth_place' => 'சென்னை',
                    'education' => 'M.E / M.Tech',
                    'job_title' => 'Software Architect',
                    'company_details' => 'TCS, Chennai',
                    'monthly_income' => '1,25,000',
                    'height' => '175 cm',
                    'weight' => '68 kg',
                    'complexion' => 'மாநிறம்',
                    'kuladeivam' => 'ஸ்ரீ முருகன் கோவில், பழனி',
                    'gothram' => 'சிவ கோத்திரம்',
                    'kootam' => 'முத்துராசர் கூட்டம்',
                    'father_name' => 'Rajendran K',
                    'father_job' => 'Business',
                    'father_mobile' => '9000000001',
                    'father_native' => 'சென்னை',
                    'mother_name' => 'Lakshmi R',
                    'mother_job' => 'Home Maker',
                    'mother_mobile' => '9000000002',
                    'mother_native' => 'சென்னை',
                    'address' => '12, அண்ணா நகர், சென்னை - 600040',
                    'family_wealth' => 'சொந்த வீடு மற்றும் தோட்டம்',
                    'siblings_details' => '1 தம்பி, B.E முடித்து பணியில் உள்ளார்',
                    'brothers' => '1 தம்பி',
                    'sisters' => 'இல்லை',
                    'tamil_month' => 'வைகாசி 6',
                    'tamil_year' => 'வெகுதானிய',
                    'rasi' => 'மேஷம்',
                    'natchathiram' => 'அஸ்வினி',
                    'lagnam' => 'ரிஷபம்',
                    'dosham' => 'சுத்தம்',
                    'thisai_iruppu' => 'கேது திசை 2 வருடம்',
                    'expectations' => 'பட்டதாரி, குடும்ப பாங்கான மணமகள் தேவை',
                    'marriage_type' => 'mudhal_manama',
                    'blood_group' => 'O+',
                    'email' => 'karthik.demo@mastermatrimony.example',
                    'photo_path' => 'images/avatar_groom.png',
                    'rasi_chart' => ['1' => ['சூரி', 'புத'], '2' => ['சுக்'], '11' => ['குரு']],
                    'navamsam_chart' => ['4' => ['சந்'], '9' => ['செவ்']],
                ],
                [
                    'varan_type' => 'penn',
                    'reg_no' => 'MM-2026-0002',
                    'reg_date' => '2026-10-18',
                    'name' => 'DIVYA S',
                    'community' => 'முதலியார்',
                    'dob' => '1999-07-15',
                    'birth_time' => '10:30 AM',
                    'birth_place' => 'மதுரை',
                    'education' => 'B.E (Computer Science)',
                    'job_title' => 'Software Engineer',
                    'company_details' => 'Infosys, Bangalore',
                    'monthly_income' => '85,000',
                    'height' => '162 cm',
                    'weight' => '54 kg',
                    'complexion' => 'சிவப்பு',
                    'kuladeivam' => 'ஸ்ரீ மீனாட்சி அம்மன், மதுரை',
                    'gothram' => 'சிவ கோத்திரம்',
                    'kootam' => 'காடை கூட்டம்',
                    'father_name' => 'Sundaram S',
                    'father_job' => 'Teacher (Govt School)',
                    'father_mobile' => '9000000003',
                    'father_native' => 'மதுரை',
                    'mother_name' => 'Kavitha S',
                    'mother_job' => 'Home Maker',
                    'mother_mobile' => '9000000004',
                    'mother_native' => 'மதுரை',
                    'address' => '45, கே.கே. நகர், மதுரை - 625020',
                    'family_wealth' => 'சொந்த வீடு, 5 ஏக்கர் விவசாய நிலம்',
                    'siblings_details' => '1 தம்பி - B.Tech படித்து வருகிறார்',
                    'brothers' => '1 தம்பி',
                    'sisters' => 'இல்லை',
                    'tamil_month' => 'ஆனி 30',
                    'tamil_year' => 'பிரமாதி',
                    'rasi' => 'சிம்மம்',
                    'natchathiram' => 'மகம்',
                    'lagnam' => 'கன்னி',
                    'dosham' => 'சுத்தம்',
                    'thisai_iruppu' => 'சுக்கிரன் திசை 4 வருடம், 2 மாதம்',
                    'expectations' => 'நன்கு படித்த, நல்ல குணமுள்ள மணமகன் தேவை',
                    'marriage_type' => 'mudhal_manama',
                    'blood_group' => 'A1B+',
                    'email' => 'divya.demo@mastermatrimony.example',
                    'photo_path' => 'images/avatar_bride.png',
                    'rasi_chart' => ['5' => ['குரு'], '8' => ['லக்', 'சூரி', 'சந்', 'செவ்', 'புத']],
                    'navamsam_chart' => ['12' => ['சனி', 'கேது']],
                ],
                [
                    'varan_type' => 'aan',
                    'reg_no' => 'MM-2026-0003',
                    'reg_date' => '2026-11-02',
                    'name' => 'ARUN K',
                    'community' => 'முதலியார்',
                    'dob' => '1997-09-10',
                    'birth_time' => '05:45 AM',
                    'birth_place' => 'கோயம்புத்தூர்',
                    'education' => 'MBA (Finance)',
                    'job_title' => 'Senior Financial Analyst',
                    'company_details' => 'Zoho Corp, Chennai',
                    'monthly_income' => '1,10,000',
                    'height' => '178 cm',
                    'weight' => '72 kg',
                    'complexion' => 'மாநிறம்',
                    'kuladeivam' => 'ஸ்ரீ மருதமலை முருகன்',
                    'gothram' => 'விஷ்ணு கோத்திரம்',
                    'kootam' => 'காடை கூட்டம்',
                    'father_name' => 'Kumaravel P',
                    'father_job' => 'Retired Bank Manager',
                    'father_mobile' => '9000000005',
                    'father_native' => 'கோயம்புத்தூர்',
                    'mother_name' => 'Meena K',
                    'mother_job' => 'Home Maker',
                    'mother_mobile' => '9000000006',
                    'mother_native' => 'கோயம்புத்தூர்',
                    'address' => '78, ஆர்.எஸ். புரம், கோயம்புத்தூர் - 641002',
                    'family_wealth' => 'சொந்த வீடு',
                    'siblings_details' => '1 அக்கா (திருமணமானவர்)',
                    'brothers' => 'இல்லை',
                    'sisters' => '1 அக்கா',
                    'tamil_month' => 'ஆவணி 25',
                    'tamil_year' => 'ஈஸ்வர',
                    'rasi' => 'துலாம்',
                    'natchathiram' => 'சுவாதி',
                    'lagnam' => 'விருச்சிகம்',
                    'dosham' => 'சுத்தம்',
                    'thisai_iruppu' => 'ராகு திசை 6 வருடம்',
                    'expectations' => 'படித்த, நற்குணமுள்ள மணமகள் தேவை',
                    'marriage_type' => 'mudhal_manama',
                    'blood_group' => 'B+',
                    'email' => 'arun.demo@mastermatrimony.example',
                    'photo_path' => 'images/avatar_groom.png',
                    'rasi_chart' => ['7' => ['சந்', 'சுக்'], '10' => ['சூரி']],
                    'navamsam_chart' => ['3' => ['குரு'], '8' => ['லக்']],
                ],
                [
                    'varan_type' => 'penn',
                    'reg_no' => 'MM-2026-0004',
                    'reg_date' => '2026-11-10',
                    'name' => 'PRIYA M',
                    'community' => 'முதலியார்',
                    'dob' => '2000-02-14',
                    'birth_time' => '09:20 AM',
                    'birth_place' => 'திருச்சி',
                    'education' => 'M.Sc (Data Science)',
                    'job_title' => 'Data Analyst',
                    'company_details' => 'Cognizant, Chennai',
                    'monthly_income' => '75,000',
                    'height' => '160 cm',
                    'weight' => '52 kg',
                    'complexion' => 'சிவப்பு',
                    'kuladeivam' => 'ஸ்ரீ ரங்கநாதர், ஸ்ரீரங்கம்',
                    'gothram' => 'சிவ கோத்திரம்',
                    'kootam' => 'முத்துராசர் கூட்டம்',
                    'father_name' => 'Muruganandam V',
                    'father_job' => 'Civil Engineer',
                    'father_mobile' => '9000000007',
                    'father_native' => 'திருச்சி',
                    'mother_name' => 'Valli M',
                    'mother_job' => 'School Teacher',
                    'mother_mobile' => '9000000008',
                    'mother_native' => 'திருச்சி',
                    'address' => '22, தில்லை நகர், திருச்சி - 620018',
                    'family_wealth' => 'சொந்த வீடு மற்றும் நிலம்',
                    'siblings_details' => '1 தங்கை',
                    'brothers' => 'இல்லை',
                    'sisters' => '1 தங்கை',
                    'tamil_month' => 'மாசி 2',
                    'tamil_year' => 'பிரமாதி',
                    'rasi' => 'ரிஷபம்',
                    'natchathiram' => 'ரோகிணி',
                    'lagnam' => 'மிதுனம்',
                    'dosham' => 'சுத்தம்',
                    'thisai_iruppu' => 'சந்திர திசை 3 வருடம்',
                    'expectations' => 'நல்ல குடும்ப பின்னணி கொண்ட மணமகன் தேவை',
                    'marriage_type' => 'mudhal_manama',
                    'blood_group' => 'AB+',
                    'email' => 'priya.demo@mastermatrimony.example',
                    'photo_path' => 'images/avatar_bride.png',
                    'rasi_chart' => ['2' => ['சந்'], '6' => ['லக்', 'புத']],
                    'navamsam_chart' => ['1' => ['சூரி'], '5' => ['சுக்']],
                ],
            ];

            foreach ($profiles as $profile) {
                Varan::create($profile);
            }
        }
    }
}
