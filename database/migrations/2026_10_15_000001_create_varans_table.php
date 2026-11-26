<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('varans', function (Blueprint $table) {
            $table->id();
            $table->string('varan_type')->default('penn'); // aan, penn
            $table->string('reg_no')->nullable(); // பதிவு எண் (e.g. SAM-2026-0001)
            $table->date('reg_date')->nullable(); // பதிவு தேதி
            $table->string('name'); // வரன் பெயர்
            $table->string('community')->nullable()->default('செங்குந்தர்'); // செங்குந்தர் / கைக்கோளர்
            $table->date('dob')->nullable(); // பிறந்த தேதி
            $table->string('birth_time')->nullable(); // நேரம் (12:24 PM)
            $table->string('birth_place')->nullable(); // பிறந்த ஊர் (திருப்பூர்)
            
            // படிப்பு & வேலை
            $table->string('education')->nullable(); // வரனின் படிப்பு (B.E, 10th, 12th...)
            $table->string('job_title')->nullable(); // வேலை (IT, Govt, Doctor...)
            $table->string('company_details')->nullable(); // நிறுவனம் பெயர் & ஊர்
            $table->string('monthly_income')->nullable(); // மாத வருமானம் (95,000)
            
            // உடல் & தோற்றம்
            $table->string('height')->nullable(); // உயரம் (157 cm)
            $table->string('weight')->nullable(); // எடை (55 kg)
            $table->string('complexion')->nullable(); // நிறம் (சிவப்பு, மாநிறம்...)
            
            // குலம் & கூட்டம்
            $table->string('kuladeivam')->nullable(); // குலதெய்வம் & ஊர்
            $table->string('gothram')->nullable(); // கோத்திரம் (சிவ கோத்திரம்)
            $table->string('kootam')->nullable(); // கூட்டம் (கீரனூரார் கூட்டம்)
            
            // பெற்றோர் & குடும்பம்
            $table->string('father_name')->nullable(); // தந்தை பெயர்
            $table->string('father_job')->nullable(); // தந்தையின் பணி
            $table->string('father_mobile')->nullable(); // தந்தை அலைபேசி
            $table->string('father_native')->nullable(); // தந்தை பூர்வீகம்
            
            $table->string('mother_name')->nullable(); // தாய் பெயர்
            $table->string('mother_job')->nullable(); // தாயின் பணி
            $table->string('mother_mobile')->nullable(); // தாய் அலைபேசி
            $table->string('mother_native')->nullable(); // தாய் பூர்வீகம்
            
            $table->text('address')->nullable(); // முகவரி
            $table->string('family_wealth')->nullable(); // குடும்ப வருமானம் / வசதிகள் (சொந்த வீடு...)
            $table->string('siblings_details')->nullable(); // உடன் பிறந்தோர் விவரம் (1 தங்கை, Designer)
            
            // ஜாதகம் (Astrology Constants)
            $table->string('rasi')->nullable(); // ராசி (கடகம்)
            $table->string('natchathiram')->nullable(); // நட்சத்திரம் (ஆயில்யம்)
            $table->string('lagnam')->nullable(); // லக்னம் (மீனம்)
            $table->string('dosham')->nullable(); // சுத்தம் / ராகு கேது / செவ்வாய் நிவர்த்தி
            
            // 12 கட்ட ஜாதகம் (JSON format)
            $table->json('rasi_chart')->nullable(); // 12 boxes planets
            $table->json('navamsam_chart')->nullable(); // 12 boxes planets
            
            // இதர குறிப்புகள்
            $table->string('marriage_type')->default('mudhal_manama'); // முதல் மணமா / மறுமணமா
            $table->text('divorce_details')->nullable(); // மறுமணம் விவரம்
            $table->string('thisai_iruppu')->nullable(); // திசை இருப்பு (சுக்கிரன் திசை)
            $table->text('expectations')->nullable(); // எதிர்பார்ப்புகள்
            $table->string('blood_group')->nullable(); // Blood group (A1B+)
            $table->string('email')->nullable(); // Email
            $table->string('photo_path')->nullable(); // Uploaded image file
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varans');
    }
};
