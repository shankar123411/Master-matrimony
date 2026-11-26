<!DOCTYPE html>
<html lang="ta">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>மாஸ்டர் மணமாலை (Master Matrimony) - புதிய வரன் பதிவு</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar:wght@400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #c62828;
            --primary-dark: #8e0000;
            --gold: #ffd600;
            --gold-dark: #b78103;
            --bg: #fffde7;
            --card-bg: #ffffff;
            --border: #e0d080;
            --text-dark: #1a1a1a;
            --text-muted: #555555;
            --focus-ring: rgba(198, 40, 40, 0.25);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Mukta Malar', 'Outfit', Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #fff9c4 0%, #fffde7 50%, #fff8e1 100%);
            color: var(--text-dark);
            min-height: 100vh;
            padding: 20px 10px 40px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: var(--card-bg);
            border: 4px solid var(--gold);
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(183, 129, 3, 0.25);
            overflow: hidden;
        }

        /* Top Header */
        .header {
            background: linear-gradient(135deg, #ffd600 0%, #ffea00 100%);
            border-bottom: 3px solid var(--gold-dark);
            padding: 18px 24px;
            text-align: center;
            position: relative;
        }

        .header-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary);
            text-shadow: 1px 1px 0 #fff;
            line-height: 1.2;
        }

        .header-sub {
            font-size: 17px;
            font-weight: 700;
            color: #0d47a1;
            margin-top: 3px;
        }

        .header-contact {
            font-size: 14px;
            font-weight: 700;
            color: #222;
            margin-top: 3px;
        }

        .top-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 10px 24px;
            border-bottom: 1px solid #eee;
        }

        .lang-switch {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 14px;
        }

        .lang-btn {
            background: #f0f0f0;
            border: 1px solid #ccc;
            padding: 4px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.2s;
        }

        .lang-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary-dark);
        }

        .admin-link {
            color: #0d47a1;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Voice Status Toast */
        .voice-indicator {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background: #c62828;
            color: #fff;
            padding: 12px 20px;
            border-radius: 30px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(198, 40, 40, 0.4);
            z-index: 9999;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Form Styles */
        .form-body {
            padding: 24px;
        }

        .section-card {
            background: #fffdf5;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 22px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .section-title {
            font-size: 17px;
            font-weight: 800;
            color: var(--primary);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 6px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 650px) {
            .grid-2, .grid-3 {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 14px;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #222;
            margin-bottom: 6px;
        }

        .required {
            color: var(--primary);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            padding-right: 42px; /* for mic button */
            font-size: 15px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            background: #fff;
            color: #000;
            outline: none;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .select-control {
            padding-right: 14px;
            cursor: pointer;
            font-weight: 600;
        }

        /* Voice Mic Button */
        .mic-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            color: #555;
        }

        .mic-btn:hover {
            background: var(--gold);
            color: #000;
            transform: translateY(-50%) scale(1.1);
        }

        .mic-btn.listening {
            background: #c62828;
            color: #fff;
            border-color: #8e0000;
            animation: pulse 1s infinite;
        }

        /* Gender Radio Tabs */
        .gender-selector {
            display: flex;
            gap: 12px;
            margin-bottom: 14px;
        }

        .gender-option {
            flex: 1;
            position: relative;
        }

        .gender-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .gender-card {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            font-weight: 800;
            font-size: 16px;
            transition: all 0.2s;
            background: #fff;
        }

        .gender-option input:checked + .gender-card {
            border-color: var(--primary);
            background: #ffebee;
            color: var(--primary);
            box-shadow: 0 3px 10px rgba(198,40,40,0.15);
        }

        /* Photo Upload Preview */
        .photo-upload-box {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .photo-preview {
            width: 100px;
            height: 120px;
            border: 2px dashed #b78103;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            overflow: hidden;
            flex-shrink: 0;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* 12-Kattam Astrology Grid Interactive UI */
        .astrology-builder {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .astrology-builder {
                grid-template-columns: 1fr;
            }
        }

        .chart-box {
            background: #fff;
            border: 2px solid #c62828;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }

        .chart-heading {
            font-weight: 800;
            color: #c62828;
            margin-bottom: 6px;
            font-size: 15px;
        }

        .south-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(4, 52px);
            border: 1.5px solid #c62828;
            background: #fff;
        }

        .grid-cell {
            border: 1px solid #c62828;
            padding: 2px;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            position: relative;
            background: #fff;
        }

        .grid-cell-center {
            grid-column: 2 / span 2;
            grid-row: 2 / span 2;
            background: #fffde7;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #c62828;
            font-size: 14px;
        }

        .cell-planets-input {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 11px;
            font-weight: 700;
            text-align: center;
            color: #0d47a1;
            margin-top: 4px;
            outline: none;
        }

        .cell-label {
            font-size: 9px;
            color: #888;
            align-self: flex-start;
        }

        /* Planet Tag buttons helper */
        .planets-palette {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 8px;
            background: #f7f7f7;
            padding: 8px;
            border-radius: 6px;
        }

        .planet-tag {
            background: #ffd600;
            border: 1px solid #b78103;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s;
        }

        .planet-tag:hover {
            background: #ffea00;
            transform: scale(1.05);
        }

        /* Submit Button */
        .submit-bar {
            text-align: center;
            padding: 20px;
            background: #fff8e1;
            border-top: 2px solid var(--gold);
        }

        .btn-submit {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            padding: 14px 40px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(198, 40, 40, 0.35);
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(198, 40, 40, 0.45);
        }
    </style>
</head>
<body>

    <!-- Voice Indicator Toast -->
    <div id="voiceToast" class="voice-indicator">
        🎙️ பேசவும் (Listening in Tamil/English)...
    </div>

    <div class="container">
        <!-- Top Toolbar -->
        <div class="top-toolbar">
            <div class="lang-switch">
                <span>🌐 Language / மொழி:</span>
                <button type="button" class="lang-btn active" id="btnTamil" onclick="setLanguage('ta')">தமிழ்</button>
                <button type="button" class="lang-btn" id="btnEnglish" onclick="setLanguage('en')">English</button>
            </div>
            <div>
                <a href="{{ url('/admin/varans') }}" class="admin-link">
                    ⚙️ Admin Panel / பட்டியல்
                </a>
            </div>
        </div>

        <!-- Header -->
        <div class="header">
            <h1 class="header-title" data-ta="மாஸ்டர் மணமாலை" data-en="Master Matrimony">
                மாஸ்டர் மணமாலை
            </h1>
            <div class="header-sub" data-ta="திருமண தகவல் மையம் - புதிய வரன் பதிவு" data-en="Matrimonial Information Centre - New Profile Entry">
                திருமண தகவல் மையம் - புதிய வரன் பதிவு
            </div>
            <div class="header-contact">
                Master Matrimony Desk • Cell: <strong style="color: #c62828;">+91 90000 00000</strong>
            </div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('varans.store') }}" method="POST" enctype="multipart/form-data" class="form-body" id="varanForm">
            @csrf
            <input type="hidden" name="lang" id="standalone_form_lang" value="ta">

            <!-- 1. வரன் தேர்வு (Bride / Groom) -->
            <div class="section-card">
                <div class="section-title">
                    <span>👤</span>
                    <span data-ta="1. வரன் தேர்வு (மணமகன் / மணமகள்)" data-en="1. Candidate Type (Bride / Groom)">1. வரன் தேர்வு (மணமகன் / மணமகள்)</span>
                </div>

                <div class="gender-selector">
                    <label class="gender-option">
                        <input type="radio" name="varan_type" value="penn" checked>
                        <div class="gender-card">
                            👰 <span data-ta="பெண் வரன் (Bride)" data-en="Bride (Female)">பெண் வரன் (Bride)</span>
                        </div>
                    </label>
                    <label class="gender-option">
                        <input type="radio" name="varan_type" value="aan">
                        <div class="gender-card">
                            🤵 <span data-ta="ஆண் வரன் (Groom)" data-en="Groom (Male)">ஆண் வரன் (Groom)</span>
                        </div>
                    </label>
                </div>

                <div class="grid-2" style="margin-bottom: 14px;">
                    <div class="form-group">
                        <label class="form-label">
                            <span data-ta="பதிவு எண் (Reg. No)" data-en="Registration No">பதிவு எண் (Reg. No)</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="SAM-2026-XXXX">
                            <button type="button" class="mic-btn" onclick="startSpeech('reg_no')" title="Voice Type">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span data-ta="பதிவு தேதி (Reg. Date)" data-en="Registration Date">பதிவு தேதி (Reg. Date)</span>
                        </label>
                        <input type="date" name="reg_date" id="reg_date" class="form-control select-control" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">
                            <span data-ta="வரன் பெயர்" data-en="Candidate Name">வரன் பெயர்</span> <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g. AMIRTHAVADIVU N" required>
                            <button type="button" class="mic-btn" onclick="startSpeech('name')" title="Voice Type">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="இனம் / சமூகம்" data-en="Community">இனம் / சமூகம்</label>
                        <div class="input-wrapper">
                            <select name="community" class="form-control select-control">
                                <option value="கைக்கோளர்">கைக்கோளர் (Kaikolar)</option>
                                <option value="செங்குந்தர்">செங்குந்தர் (Sengunthar)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Photo Upload -->
                <div class="form-group" style="margin-top: 10px;">
                    <label class="form-label" data-ta="வரன் புகைப்படம் (Photo Upload)" data-en="Candidate Photo">வரன் புகைப்படம் (Photo Upload)</label>
                    <div class="photo-upload-box">
                        <div class="photo-preview" id="photoPreview">
                            <span style="font-size: 24px;">📷</span>
                        </div>
                        <div>
                            <input type="file" name="photo" id="photoInput" accept="image/*" onchange="previewImage(event)" class="form-control" style="padding-right: 14px;">
                            <small style="color: #666;" data-ta="பாஸ்போர்ட் அளவு போட்டோ தேர்ந்தெடுக்கவும் (Max 5MB)" data-en="Choose passport size photo (Max 5MB)">
                                பாஸ்போர்ட் அளவு போட்டோ தேர்ந்தெடுக்கவும் (Max 5MB)
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. பிறப்பு விபரங்கள் -->
            <div class="section-card">
                <div class="section-title">
                    <span>📅</span>
                    <span data-ta="2. பிறப்பு விபரங்கள்" data-en="2. Birth Details">2. பிறப்பு விபரங்கள்</span>
                </div>

                <div class="grid-3">
                    <div class="form-group">
                        <label class="form-label" data-ta="பிறந்த தேதி (DOB)" data-en="Date of Birth">பிறந்த தேதி (DOB)</label>
                        <div class="input-wrapper">
                            <input type="date" name="dob" id="dob" max="{{ date('Y-m-d') }}" min="1920-01-01" class="form-control select-control">
                            <button type="button" class="mic-btn" onclick="startSpeech('dob')" title="குரல் பதிவு - பிறந்த தேதி (Voice Mic for DOB)">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="பிறந்த நேரம் (Birth Time)" data-en="Birth Time">பிறந்த நேரம் (Birth Time)</label>
                        <div class="input-wrapper">
                            <input type="text" name="birth_time" id="birth_time" class="form-control" placeholder="e.g. 12:24 PM">
                            <button type="button" class="mic-btn" onclick="startSpeech('birth_time')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="பிறந்த ஊர் (Birth Place)" data-en="Birth Place">பிறந்த ஊர் (Birth Place)</label>
                        <div class="input-wrapper">
                            <input type="text" name="birth_place" id="birth_place" class="form-control" placeholder="e.g. திருப்பூர்">
                            <button type="button" class="mic-btn" onclick="startSpeech('birth_place')">🎙️</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. படிப்பு & வேலை -->
            <div class="section-card">
                <div class="section-title">
                    <span>🎓</span>
                    <span data-ta="3. கல்வி & பணி விபரம்" data-en="3. Education & Career">3. கல்வி & பணி விபரம்</span>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" data-ta="வரனின் படிப்பு (Select Education)" data-en="Education">வரனின் படிப்பு (Select Education)</label>
                        <select name="education" class="form-control select-control">
                            <option value="">-- தேர்ந்தெடுக்கவும் (Select) --</option>
                            @foreach($educations as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="வேலை / பணி (Select or Voice)" data-en="Job Title">வேலை / பணி (Select or Voice)</label>
                        <div class="input-wrapper">
                            <input type="text" name="job_title" id="job_title" list="jobList" class="form-control" placeholder="e.g. IT, Govt Job, Doctor">
                            <datalist id="jobList">
                                @foreach($jobs as $key => $val)
                                    <option value="{{ $key }}"></option>
                                @endforeach
                            </datalist>
                            <button type="button" class="mic-btn" onclick="startSpeech('job_title')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="நிறுவனம் பெயர் & ஊர்" data-en="Company Name & City">நிறுவனம் பெயர் & ஊர்</label>
                        <div class="input-wrapper">
                            <input type="text" name="company_details" id="company_details" class="form-control" placeholder="e.g. Cognizant, Coimbatore">
                            <button type="button" class="mic-btn" onclick="startSpeech('company_details')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="மாத வருமானம் (Monthly Income)" data-en="Monthly Income">மாத வருமானம் (Monthly Income)</label>
                        <div class="input-wrapper">
                            <input type="text" name="monthly_income" id="monthly_income" class="form-control" placeholder="e.g. 95,000">
                            <button type="button" class="mic-btn" onclick="startSpeech('monthly_income')">🎙️</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. தோற்றம் & குலம் -->
            <div class="section-card">
                <div class="section-title">
                    <span>🚩</span>
                    <span data-ta="4. தோற்றம், குலதெய்வம் & கூட்டம்" data-en="4. Physical & Clan Details">4. தோற்றம், குலதெய்வம் & கூட்டம்</span>
                </div>

                <div class="grid-3">
                    <div class="form-group">
                        <label class="form-label" data-ta="உயரம் (Height)" data-en="Height">உயரம் (Height)</label>
                        <div class="input-wrapper">
                            <input type="text" name="height" id="height" class="form-control" placeholder="e.g. 157 cm">
                            <button type="button" class="mic-btn" onclick="startSpeech('height')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="எடை (Weight)" data-en="Weight">எடை (Weight)</label>
                        <div class="input-wrapper">
                            <input type="text" name="weight" id="weight" class="form-control" placeholder="e.g. 55 kg">
                            <button type="button" class="mic-btn" onclick="startSpeech('weight')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="நிறம் (Complexion)" data-en="Complexion">நிறம் (Complexion)</label>
                        <select name="complexion" class="form-control select-control">
                            @foreach($complexions as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid-3">
                    <div class="form-group">
                        <label class="form-label" data-ta="குலதெய்வம், ஊர்" data-en="Kuladeivam & Place">குலதெய்வம், ஊர்</label>
                        <div class="input-wrapper">
                            <input type="text" name="kuladeivam" id="kuladeivam" class="form-control" placeholder="e.g. செல்வநாயகி அம்மன், கீரனூர்">
                            <button type="button" class="mic-btn" onclick="startSpeech('kuladeivam')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="கோத்திரம் (Gothram)" data-en="Gothram">கோத்திரம் (Gothram)</label>
                        <div class="input-wrapper">
                            <input type="text" name="gothram" id="gothram" class="form-control" placeholder="e.g. சிவ கோத்திரம்">
                            <button type="button" class="mic-btn" onclick="startSpeech('gothram')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="கூட்டம் (Kootam)" data-en="Kootam">கூட்டம் (Kootam)</label>
                        <div class="input-wrapper">
                            <input type="text" name="kootam" id="kootam" class="form-control" placeholder="e.g. கீரனூரார் கூட்டம்">
                            <button type="button" class="mic-btn" onclick="startSpeech('kootam')">🎙️</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. பெற்றோர் & குடும்ப விபரம் -->
            <div class="section-card">
                <div class="section-title">
                    <span>👨‍👩‍👧</span>
                    <span data-ta="5. குடும்ப விபரம் & முகவரி" data-en="5. Family Details & Address">5. குடும்ப விபரம் & முகவரி</span>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" data-ta="தந்தை பெயர்" data-en="Father's Name">தந்தை பெயர்</label>
                        <div class="input-wrapper">
                            <input type="text" name="father_name" id="father_name" class="form-control" placeholder="e.g. Nandhakumar D">
                            <button type="button" class="mic-btn" onclick="startSpeech('father_name')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="தந்தையின் பணி & பூர்வீகம்" data-en="Father's Job & Native">தந்தையின் பணி & பூர்வீகம்</label>
                        <div class="input-wrapper">
                            <input type="text" name="father_job" id="father_job" class="form-control" placeholder="e.g. Employed / திருப்பூர்">
                            <button type="button" class="mic-btn" onclick="startSpeech('father_job')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="தாய் பெயர்" data-en="Mother's Name">தாய் பெயர்</label>
                        <div class="input-wrapper">
                            <input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="e.g. Usha N">
                            <button type="button" class="mic-btn" onclick="startSpeech('mother_name')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="தாயின் பணி & பூர்வீகம்" data-en="Mother's Job & Native">தாயின் பணி & பூர்வீகம்</label>
                        <div class="input-wrapper">
                            <input type="text" name="mother_job" id="mother_job" class="form-control" placeholder="e.g. Employed / திருப்பூர்">
                            <button type="button" class="mic-btn" onclick="startSpeech('mother_job')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="தொடர்பு அலைபேசி (Mobile)" data-en="Contact Mobile">தொடர்பு அலைபேசி (Mobile)</label>
                        <div class="input-wrapper">
                            <input type="text" name="father_mobile" id="father_mobile" class="form-control" placeholder="e.g. 9994792523, 8148478085">
                            <button type="button" class="mic-btn" onclick="startSpeech('father_mobile')">🎙️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="குடும்ப வருமானம் / வசதிகள்" data-en="Family Wealth / Assets">குடும்ப வருமானம் / வசதிகள்</label>
                        <div class="input-wrapper">
                            <input type="text" name="family_wealth" id="family_wealth" class="form-control" placeholder="e.g. 60,000 / சொந்த வீடு">
                            <button type="button" class="mic-btn" onclick="startSpeech('family_wealth')">🎙️</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" data-ta="உடன் பிறந்தோர் விவரம்" data-en="Siblings Details">உடன் பிறந்தோர் விவரம்</label>
                    <div class="input-wrapper">
                        <input type="text" name="siblings_details" id="siblings_details" class="form-control" placeholder="e.g. 1 தங்கை, Designer">
                        <button type="button" class="mic-btn" onclick="startSpeech('siblings_details')">🎙️</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" data-ta="முழு முகவரி (Address)" data-en="Full Address">முழு முகவரி (Address)</label>
                    <div class="input-wrapper">
                        <input type="text" name="address" id="address" class="form-control" placeholder="e.g. 31/18, காமாட்சியம்மன் கோவில் தெரு, திருப்பூர்">
                        <button type="button" class="mic-btn" onclick="startSpeech('address')">🎙️</button>
                    </div>
                </div>
            </div>

            <!-- 6. ஜாதகம் & 12 கட்டங்கள் -->
            <div class="section-card">
                <div class="section-title">
                    <span>🔮</span>
                    <span data-ta="6. ஜோதிட விபரம் (மாறாத விபரங்கள் - Select Dropdowns)" data-en="6. Astrology Details (Fixed Dropdowns)">6. ஜோதிட விபரம் (மாறாத விபரங்கள் - Select Dropdowns)</span>
                </div>

                <div class="grid-3">
                    <div class="form-group">
                        <label class="form-label" data-ta="ராசி (Rasi)" data-en="Rasi (Zodiac)">ராசி (Rasi)</label>
                        <select name="rasi" class="form-control select-control">
                            <option value="">-- தேர்ந்தெடு --</option>
                            @foreach($rasis as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="நட்சத்திரம் (Star)" data-en="Natchathiram (Star)">நட்சத்திரம் (Star)</label>
                        <select name="natchathiram" class="form-control select-control">
                            <option value="">-- தேர்ந்தெடு (27 நட்சத்திரங்கள்) --</option>
                            @foreach($stars as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="லக்னம் (Lagnam)" data-en="Lagnam">லக்னம் (Lagnam)</label>
                        <select name="lagnam" class="form-control select-control">
                            <option value="">-- தேர்ந்தெடு --</option>
                            @foreach($lagnams as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" data-ta="தோஷ விபரம்" data-en="Dosham">தோஷ விபரம்</label>
                        <select name="dosham" class="form-control select-control">
                            @foreach($doshams as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="திசை இருப்பு" data-en="Thisai Iruppu">திசை இருப்பு</label>
                        <div class="input-wrapper">
                            <input type="text" name="thisai_iruppu" id="thisai_iruppu" class="form-control" placeholder="e.g. சுக்கிரன் திசை 4 வருடம்">
                            <button type="button" class="mic-btn" onclick="startSpeech('thisai_iruppu')">🎙️</button>
                        </div>
                    </div>
                </div>

                <!-- Interactive 12-Kattam Builder -->
                <div style="margin-top: 10px;">
                    <label class="form-label" style="color: #c62828;">
                        🪐 12 கட்ட ஜாதகம் (ராசி & நவாம்சம் கட்டங்களில் கிரகங்களை தட்டச்சு செய்யலாம்):
                    </label>
                    <div class="planets-palette">
                        <span style="font-size: 11px; font-weight: 700; color: #555;">கிரகங்கள்:</span>
                        @foreach($planets as $pk => $pv)
                            <span class="planet-tag" onclick="insertPlanet('{{ $pk }}')">{{ $pk }}</span>
                        @endforeach
                    </div>

                    <div class="astrology-builder">
                        <!-- Rasi Chart 12 Houses -->
                        <div class="chart-box">
                            <div class="chart-heading">ராசி கட்டம் (Rasi)</div>
                            <div class="south-grid">
                                <!-- Row 1 -->
                                <div class="grid-cell"><span class="cell-label">12 மீனம்</span><input type="text" name="rasi_chart[12][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">1 மேஷம்</span><input type="text" name="rasi_chart[1][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">2 ரிஷபம்</span><input type="text" name="rasi_chart[2][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">3 மிதுனம்</span><input type="text" name="rasi_chart[3][]" class="cell-planets-input" placeholder="-"></div>

                                <!-- Row 2 -->
                                <div class="grid-cell"><span class="cell-label">11 கும்பம்</span><input type="text" name="rasi_chart[11][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell-center">
                                    <span style="font-size: 20px;">☸️</span>
                                    <span>ராசி</span>
                                </div>
                                <div class="grid-cell"><span class="cell-label">4 கடகம்</span><input type="text" name="rasi_chart[4][]" class="cell-planets-input" placeholder="-"></div>

                                <!-- Row 3 -->
                                <div class="grid-cell"><span class="cell-label">10 மகரம்</span><input type="text" name="rasi_chart[10][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">5 சிம்மம்</span><input type="text" name="rasi_chart[5][]" class="cell-planets-input" placeholder="-"></div>

                                <!-- Row 4 -->
                                <div class="grid-cell"><span class="cell-label">9 தனுசு</span><input type="text" name="rasi_chart[9][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">8 விருச்சி</span><input type="text" name="rasi_chart[8][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">7 துலாம்</span><input type="text" name="rasi_chart[7][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">6 கன்னி</span><input type="text" name="rasi_chart[6][]" class="cell-planets-input" placeholder="-"></div>
                            </div>
                        </div>

                        <!-- Navamsam Chart 12 Houses -->
                        <div class="chart-box">
                            <div class="chart-heading">நவாம்சம் கட்டம் (Navamsam)</div>
                            <div class="south-grid">
                                <!-- Row 1 -->
                                <div class="grid-cell"><span class="cell-label">12 மீனம்</span><input type="text" name="navamsam_chart[12][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">1 மேஷம்</span><input type="text" name="navamsam_chart[1][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">2 ரிஷபம்</span><input type="text" name="navamsam_chart[2][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">3 மிதுனம்</span><input type="text" name="navamsam_chart[3][]" class="cell-planets-input" placeholder="-"></div>

                                <!-- Row 2 -->
                                <div class="grid-cell"><span class="cell-label">11 கும்பம்</span><input type="text" name="navamsam_chart[11][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell-center" style="background: #fff8e1;">
                                    <span style="font-size: 20px;">⭐</span>
                                    <span>நவாம்சம்</span>
                                </div>
                                <div class="grid-cell"><span class="cell-label">4 கடகம்</span><input type="text" name="navamsam_chart[4][]" class="cell-planets-input" placeholder="-"></div>

                                <!-- Row 3 -->
                                <div class="grid-cell"><span class="cell-label">10 மகரம்</span><input type="text" name="navamsam_chart[10][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">5 சிம்மம்</span><input type="text" name="navamsam_chart[5][]" class="cell-planets-input" placeholder="-"></div>

                                <!-- Row 4 -->
                                <div class="grid-cell"><span class="cell-label">9 தனுசு</span><input type="text" name="navamsam_chart[9][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">8 விருச்சி</span><input type="text" name="navamsam_chart[8][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">7 துலாம்</span><input type="text" name="navamsam_chart[7][]" class="cell-planets-input" placeholder="-"></div>
                                <div class="grid-cell"><span class="cell-label">6 கன்னி</span><input type="text" name="navamsam_chart[6][]" class="cell-planets-input" placeholder="-"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 7. எதிர்பார்ப்புகள் & தொடர்புகள் -->
            <div class="section-card">
                <div class="section-title">
                    <span>📝</span>
                    <span data-ta="7. எதிர்பார்ப்புகள் & இதர குறிப்புகள்" data-en="7. Expectations & Contact Details">7. எதிர்பார்ப்புகள் & இதர குறிப்புகள்</span>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" data-ta="திருமண வகை" data-en="Marriage Type">திருமண வகை</label>
                        <select name="marriage_type" class="form-control select-control">
                            <option value="mudhal_manama">முதல் மணமா (First Marriage)</option>
                            <option value="marumanama">மறுமணமா (Remarriage)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" data-ta="ரத்த வகை (Blood Group)" data-en="Blood Group">ரத்த வகை (Blood Group)</label>
                        <select name="blood_group" class="form-control select-control">
                            <option value="">-- தேர்ந்தெடு --</option>
                            @foreach($bloodGroups as $bg)
                                <option value="{{ $bg }}">{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" data-ta="மின்னஞ்சல் (Email ID)" data-en="Email ID">மின்னஞ்சல் (Email ID)</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" id="email" class="form-control" placeholder="e.g. ushanandhakumar15@gmail.com">
                        <button type="button" class="mic-btn" onclick="startSpeech('email')">🎙️</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" data-ta="எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்" data-en="Expectations & Notes">எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்</label>
                    <div class="input-wrapper">
                        <textarea name="expectations" id="expectations" rows="3" class="form-control" style="padding-right: 42px;" placeholder="e.g. நன்கு படித்த, நல்ல குணமுள்ள, IT அல்லது பிற துறையில் பணிபுரியும் வரன்"></textarea>
                        <button type="button" class="mic-btn" style="top: 24px;" onclick="startSpeech('expectations')">🎙️</button>
                    </div>
                </div>
            </div>

            <!-- Submit Button Bar -->
            <div class="submit-bar">
                <button type="submit" class="btn-submit">
                    💾 சேமித்து PDF ஆக பதிவிறக்கு (Save & Download PDF)
                </button>
            </div>
        </form>
    </div>

    <!-- Speech Recognition & Interactive JS -->
    <script>
        let currentLang = 'ta';
        let activeInput = null;

        // Language Switcher Function
        function setLanguage(lang) {
            currentLang = lang;
            document.getElementById('btnTamil').classList.toggle('active', lang === 'ta');
            document.getElementById('btnEnglish').classList.toggle('active', lang === 'en');

            const sLang = document.getElementById('standalone_form_lang');
            if (sLang) sLang.value = lang;

            document.querySelectorAll('[data-ta]').forEach(el => {
                el.innerText = lang === 'ta' ? el.getAttribute('data-ta') : el.getAttribute('data-en');
            });
        }

        // Comprehensive Spoken Number Parser (Tamil & English)
        function parseSpokenWordsToNumber(text) {
            if (!text) return null;
            let s = String(text).trim().toLowerCase();

            // 1. Direct digits
            const m = s.match(/(\d+(?:\.\d+)?)/);
            if (m) return parseFloat(m[1]);

            // Tamil digits
            const tamilDigits = {'௦':0,'௧':1,'௨':2,'௩':3,'௪':4,'௫':5,'௬':6,'௭':7,'௮':8,'௯':9};
            s = s.replace(/[௦-௯]/g, d => tamilDigits[d]);
            const m2 = s.match(/(\d+(?:\.\d+)?)/);
            if (m2) return parseFloat(m2[1]);

            // 2. English words
            const engWords = {
                'zero': 0, 'one': 1, 'two': 2, 'three': 3, 'four': 4, 'five': 5,
                'six': 6, 'seven': 7, 'eight': 8, 'nine': 9, 'ten': 10,
                'eleven': 11, 'twelve': 12, 'thirteen': 13, 'fourteen': 14, 'fifteen': 15,
                'sixteen': 16, 'seventeen': 17, 'eighteen': 18, 'nineteen': 19,
                'twenty': 20, 'thirty': 30, 'forty': 40, 'fifty': 50,
                'sixty': 60, 'seventy': 70, 'eighty': 80, 'ninety': 90,
                'hundred': 100
            };

            let engTotal = 0;
            let hasEng = false;
            let tokens = s.replace(/[^a-z0-9]/g, ' ').split(/\s+/).filter(Boolean);
            for (let i = 0; i < tokens.length; i++) {
                let t = tokens[i];
                if (engWords[t] !== undefined) {
                    hasEng = true;
                    let val = engWords[t];
                    if (val === 100) {
                        if (engTotal === 0) engTotal = 100;
                        else engTotal = engTotal * 100;
                    } else {
                        engTotal += val;
                    }
                }
            }
            if (hasEng && engTotal > 0) return engTotal;

            // 3. Tamil compound spoken numbers
            let total = 0;

            if (/இருநூற்று|இருநூறு|ரெண்டு\s*நூறு|இரண்டு\s*நூறு/.test(s)) {
                total += 200;
                s = s.replace(/இருநூற்று|இருநூறு|ரெண்டு\s*நூறு|இரண்டு\s*நூறு/, ' ');
            } else if (/நூற்று|நூத்தி|நூறு/.test(s)) {
                total += 100;
                s = s.replace(/நூற்று|நூத்தி|நூறு/, ' ');
            }

            const tamilCompounds = [
                { p: /தொண்ணூற்றொன்பது|தொண்ணூற்றொம்பது/, v: 99 },
                { p: /தொண்ணூற்றெட்டு/, v: 98 },
                { p: /தொண்ணூற்றேழு/, v: 97 },
                { p: /தொண்ணூற்றாறு/, v: 96 },
                { p: /தொண்ணூற்றைந்து|தொண்ணூத்தஞ்சு/, v: 95 },
                { p: /தொண்ணூற்றுநான்கு|தொண்ணூற்றுநாலு/, v: 94 },
                { p: /தொண்ணூற்றுமூன்று|தொண்ணூத்துமூணு/, v: 93 },
                { p: /தொண்ணூற்றிரண்டு|தொண்ணூத்திரெண்டு/, v: 92 },
                { p: /தொண்ணூற்றொன்று|தொண்ணூத்தொன்னு/, v: 91 },
                { p: /தொண்ணூறு/, v: 90 },

                { p: /எண்பத்தொன்பது|எம்பத்தொம்பது/, v: 89 },
                { p: /எண்பத்தெட்டு|எம்பத்தெட்டு/, v: 88 },
                { p: /எண்பத்தேழு|எம்பத்தேழு/, v: 87 },
                { p: /எண்பத்தாறு|எம்பத்தாறு/, v: 86 },
                { p: /எண்பத்தைந்து|எண்பத்தஞ்சு|எம்பத்தஞ்சு/, v: 85 },
                { p: /எண்பத்துநான்கு|எண்பத்துநாலு|எம்பத்துநாலு/, v: 84 },
                { p: /எண்பத்துமூன்று|எண்பத்துமூணு|எம்பத்துமூணு/, v: 83 },
                { p: /எண்பத்திரண்டு|எண்பத்திரெண்டு|எம்பத்திரெண்டு/, v: 82 },
                { p: /எண்பத்தொன்று|எண்பத்தொன்னு|எம்பத்தொன்னு/, v: 81 },
                { p: /எண்பது|எம்பது/, v: 80 },

                { p: /எழுபத்தொன்பது|எழுபத்தொம்பது/, v: 79 },
                { p: /எழுபத்தெட்டு/, v: 78 },
                { p: /எழுபத்தேழு/, v: 77 },
                { p: /எழுபத்தாறு/, v: 76 },
                { p: /எழுபத்தைந்து|எழுபத்தஞ்சு/, v: 75 },
                { p: /எழுபத்துநான்கு|எழுபத்துநாலு/, v: 74 },
                { p: /எழுபத்துமூன்று|எழுபத்துமூணு/, v: 73 },
                { p: /எழுபத்திரண்டு|எழுபத்திரெண்டு/, v: 72 },
                { p: /எழுபத்தொன்று|எழுபத்தொன்னு/, v: 71 },
                { p: /எழுபது/, v: 70 },

                { p: /அறுபத்தொன்பது|அறுபத்தொம்பது/, v: 69 },
                { p: /அறுபத்தெட்டு/, v: 68 },
                { p: /அறுபத்தேழு/, v: 67 },
                { p: /அறுபத்தாறு/, v: 66 },
                { p: /அறுபத்தைந்து|அறுபத்தஞ்சு/, v: 65 },
                { p: /அறுபத்துநான்கு|அறுபத்துநாலு/, v: 64 },
                { p: /அறுபத்துமூன்று|அறுபத்துமூணு/, v: 63 },
                { p: /அறுபத்திரண்டு|அறுபத்திரெண்டு/, v: 62 },
                { p: /அறுபத்தொன்று|அறுபத்தொன்னு/, v: 61 },
                { p: /அறுபது/, v: 60 },

                { p: /ஐம்பத்தொன்பது|ஐம்பத்தொம்பது|அம்பத்தொம்பது/, v: 59 },
                { p: /ஐம்பத்தெட்டு|அம்பத்தெட்டு/, v: 58 },
                { p: /ஐம்பத்தேழு|அம்பத்தேழு/, v: 57 },
                { p: /ஐம்பத்தாறு|அம்பத்தாறு/, v: 56 },
                { p: /ஐம்பத்தைந்து|ஐம்பத்தஞ்சு|அம்பத்தஞ்சு/, v: 55 },
                { p: /ஐம்பத்துநான்கு|ஐம்பத்துநாலு|அம்பத்துநாலு/, v: 54 },
                { p: /ஐம்பத்துமூன்று|ஐம்பத்துமூணு|அம்பத்துமூணு/, v: 53 },
                { p: /ஐம்பத்திரண்டு|ஐம்பத்திரெண்டு|அம்பத்திரெண்டு/, v: 52 },
                { p: /ஐம்பத்தொன்று|ஐம்பத்தொன்னு|அம்பத்தொன்னு/, v: 51 },
                { p: /ஐம்பது|அம்பது/, v: 50 },

                { p: /நாற்பத்தொன்பது|நாற்பத்தொம்பது|நாப்பத்தொம்பது/, v: 49 },
                { p: /நாற்பத்தெட்டு|நாப்பத்தெட்டு/, v: 48 },
                { p: /நாற்பத்தேழு|நாப்பத்தேழு/, v: 47 },
                { p: /நாற்பத்தாறு|நாப்பத்தாறு/, v: 46 },
                { p: /நாற்பத்தைந்து|நாற்பத்தஞ்சு|நாப்பத்தஞ்சு/, v: 45 },
                { p: /நாற்பத்துநான்கு|நாற்பத்துநாலு|நாப்பத்துநாலு/, v: 44 },
                { p: /நாற்பத்துமூன்று|நாற்பத்துமூணு|நாப்பத்துமூணு/, v: 43 },
                { p: /நாற்பத்திரண்டு|நாற்பத்திரெண்டு|நாப்பத்திரெண்டு/, v: 42 },
                { p: /நாற்பத்தொன்று|நாற்பத்தொன்னு|நாப்பத்தொன்னு/, v: 41 },
                { p: /நாற்பது|நாப்பது/, v: 40 },

                { p: /முப்பத்தொன்பது|முப்பத்தொம்பது/, v: 39 },
                { p: /முப்பத்தெட்டு/, v: 38 },
                { p: /முப்பத்தேழு/, v: 37 },
                { p: /முப்பத்தாறு/, v: 36 },
                { p: /முப்பத்தைந்து|முப்பத்தஞ்சு/, v: 35 },
                { p: /முப்பத்துநான்கு|முப்பத்துநாலு/, v: 34 },
                { p: /முப்பத்துமூன்று|முப்பத்துமூணு/, v: 33 },
                { p: /முப்பத்திரண்டு|முப்பத்திரெண்டு/, v: 32 },
                { p: /முப்பத்தொன்று|முப்பத்தொன்னு/, v: 31 },
                { p: /முப்பது/, v: 30 },

                { p: /இருபத்தொன்பது|இருபத்தொம்பது/, v: 29 },
                { p: /இருபத்தெட்டு/, v: 28 },
                { p: /இருபத்தேழு/, v: 27 },
                { p: /இருபத்தாறு/, v: 26 },
                { p: /இருபத்தைந்து|இருபத்தஞ்சு/, v: 25 },
                { p: /இருபத்துநான்கு|இருபத்துநாலு/, v: 24 },
                { p: /இருபத்துமூன்று|இருபத்துமூணு/, v: 23 },
                { p: /இருபத்திரண்டு|இருபத்திரெண்டு/, v: 22 },
                { p: /இருபத்தொன்று|இருபத்தொன்னு/, v: 21 },
                { p: /இருபது/, v: 20 },

                { p: /பத்தொன்பது|பத்தொம்பது/, v: 19 },
                { p: /பதினெட்டு/, v: 18 },
                { p: /பதினேழு/, v: 17 },
                { p: /பதினாறு/, v: 16 },
                { p: /பதினைந்து|பதினஞ்சு/, v: 15 },
                { p: /பதினான்கு|பதினாலு/, v: 14 },
                { p: /பதின்மூன்று|பதிமூன்று|பதிமூணு/, v: 13 },
                { p: /பன்னிரண்டு|பன்னிரெண்டு/, v: 12 },
                { p: /பதினொன்று|பதினொன்னு/, v: 11 },
                { p: /பத்து/, v: 10 },

                { p: /ஒன்பது|ஒம்பது/, v: 9 },
                { p: /எட்டு/, v: 8 },
                { p: /ஏழு/, v: 7 },
                { p: /ஆறு/, v: 6 },
                { p: /ஐந்து|அஞ்சு/, v: 5 },
                { p: /நான்கு|நாலு/, v: 4 },
                { p: /மூன்று|மூணு/, v: 3 },
                { p: /இரண்டு|ரெண்டு/, v: 2 },
                { p: /ஒன்று|ஒன்னு|ஒரு/, v: 1 }
            ];

            for (const c of tamilCompounds) {
                if (c.p.test(s)) {
                    total += c.v;
                    s = s.replace(c.p, ' ');
                    break;
                }
            }

            return total > 0 ? total : null;
        }

        // Normalize Height speech input: always format as '[number] cm' in English
        function normalizeHeightSpeech(text) {
            if (!text) return '';
            let s = String(text).trim();
            if (/(?:ft|feet|inch|inches|அடி|அங்குலம்)/i.test(s)) {
                return s;
            }
            const num = parseSpokenWordsToNumber(s);
            if (num !== null) {
                return num + ' cm';
            }
            s = s.replace(/(?:சென்டி\s*மீட்டர்|செண்டி\s*மீட்டர்|செ\.?\s*மீ|centi\s*meters?|cente\s*meters?|centi\s*metres?|cms?)/gi, '').trim();
            return s ? (s + ' cm') : text;
        }

        // Normalize Weight speech input: always format as '[number] kg' in English
        function normalizeWeightSpeech(text) {
            if (!text) return '';
            let s = String(text).trim();
            const num = parseSpokenWordsToNumber(s);
            if (num !== null) {
                return num + ' kg';
            }
            s = s.replace(/(?:கிலோ\s*கிராம்|கிலோ|கி\.?\s*கி|kilo\s*grams?|kilos?|kgs?)/gi, '').trim();
            return s ? (s + ' kg') : text;
        }

        // Web Speech API - Voice to Text
        function startSpeech(targetId) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                alert('Your browser does not support Speech Recognition. Please use Google Chrome.');
                return;
            }

            const recognition = new SpeechRecognition();
            // Set recognition language based on current toggle (Tamil or Indian English)
            recognition.lang = currentLang === 'ta' ? 'ta-IN' : 'en-IN';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            const toast = document.getElementById('voiceToast');
            toast.style.display = 'block';
            toast.innerText = currentLang === 'ta' ? '🎙️ தமிழில் பேசவும் (Listening in Tamil)...' : '🎙️ Speak in English...';

            recognition.onstart = function() {
                const btn = event.currentTarget;
                if (btn) btn.classList.add('listening');
            };

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                const input = document.getElementById(targetId);
                if (input) {
                    if (targetId === 'dob') {
                        parseAndSetStandaloneDob(transcript);
                    } else if (targetId === 'height') {
                        input.value = normalizeHeightSpeech(transcript);
                    } else if (targetId === 'weight') {
                        input.value = normalizeWeightSpeech(transcript);
                    } else if (targetId === 'birth_place') {
                        if (/[0-9]/.test(transcript)) {
                            alert('பிறந்த ஊரில் எண்கள் இருக்கக்கூடாது! ஊர் பெயரை மட்டும் கூறவும் (Numbers are not allowed in Birth Place).');
                            return;
                        }
                        input.value = transcript.trim();
                    } else {
                        if (input.value) {
                            input.value += ' ' + transcript;
                        } else {
                            input.value = transcript;
                        }
                    }
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            };

            recognition.onerror = function(event) {
                console.error('Speech error:', event.error);
                toast.style.display = 'none';
            };

            recognition.onend = function() {
                toast.style.display = 'none';
                document.querySelectorAll('.mic-btn').forEach(b => b.classList.remove('listening'));
            };

            recognition.start();
        }

        function parseAndSetStandaloneDob(text) {
            if (!text) return;
            const dobInput = document.getElementById('dob');
            if (!dobInput) return;

            let str = text.toLowerCase().trim();
            const months = {
                'january': '01', 'jan': '01', 'ஜனவரி': '01',
                'february': '02', 'feb': '02', 'பிப்ரவரி': '02',
                'march': '03', 'mar': '03', 'மார்ச்': '03',
                'april': '04', 'apr': '04', 'ஏப்ரல்': '04',
                'may': '05', 'மே': '05',
                'june': '06', 'jun': '06', 'ஜூன்': '06',
                'july': '07', 'jul': '07', 'ஜூலை': '07',
                'august': '08', 'aug': '08', 'ஆகஸ்ட்': '08',
                'september': '09', 'sep': '09', 'செப்டம்பர்': '09',
                'october': '10', 'oct': '10', 'அக்டோபர்': '10',
                'november': '11', 'nov': '11', 'நவம்பர்': '11',
                'december': '12', 'dec': '12', 'டிசம்பர்': '12'
            };

            let monthVal = null;
            for (const [mName, mNum] of Object.entries(months)) {
                if (str.includes(mName)) {
                    monthVal = mNum;
                    str = str.replace(mName, ' ');
                    break;
                }
            }

            str = str.replace(/[./\\-]/g, ' ');
            const nums = str.match(/\d+/g);
            let day = null, month = monthVal, year = null;

            if (nums && nums.length >= 2) {
                if (monthVal) {
                    let n1 = parseInt(nums[0], 10);
                    let n2 = parseInt(nums[1], 10);
                    if (n1 > 31 && n2 <= 31) {
                        year = n1; day = n2;
                    } else {
                        day = n1; year = n2;
                    }
                } else if (nums.length >= 3) {
                    let n1 = parseInt(nums[0], 10);
                    let n2 = parseInt(nums[1], 10);
                    let n3 = parseInt(nums[2], 10);

                    if (n1 > 1000) {
                        year = n1; month = String(n2).padStart(2, '0'); day = n3;
                    } else if (n3 > 1000) {
                        year = n3; day = n1; month = String(n2).padStart(2, '0');
                    } else {
                        day = n1; month = String(n2).padStart(2, '0'); year = n3;
                    }
                }
            }

            if (year && year < 100) {
                year = year > 30 ? 1900 + year : 2000 + year;
            }

            if (day && month && year) {
                const dNum = parseInt(day, 10);
                const mNum = parseInt(month, 10);
                const yNum = parseInt(year, 10);
                const isLeap = (yNum % 4 === 0 && (yNum % 100 !== 0 || yNum % 400 === 0));
                const maxDaysInMonth = [0, 31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                if (mNum >= 1 && mNum <= 12 && dNum >= 1 && dNum <= maxDaysInMonth[mNum] && yNum >= 1920 && yNum <= 2030) {
                    const formattedDay = String(dNum).padStart(2, '0');
                    const formattedMonth = String(mNum).padStart(2, '0');
                    dobInput.value = `${yNum}-${formattedMonth}-${formattedDay}`;
                    dobInput.dispatchEvent(new Event('input', { bubbles: true }));
                    dobInput.dispatchEvent(new Event('change', { bubbles: true }));
                } else {
                    alert('தவறான பிறந்த தேதி! காலண்டரில் உள்ள சரியான தேதியை குறிப்பிடவும் (Invalid Date of Birth).');
                }
            }
        }

        // Photo Preview Helper
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photoPreview').innerHTML = `<img src="${e.target.result}" alt="Photo">`;
                };
                reader.readAsDataURL(file);
            }
        }

        // Insert Planet into currently focused kattam cell
        document.querySelectorAll('.cell-planets-input').forEach(input => {
            input.addEventListener('focus', () => {
                activeInput = input;
            });
        });

        function insertPlanet(planet) {
            if (activeInput) {
                activeInput.value = (activeInput.value ? activeInput.value + ' ' : '') + planet;
            } else {
                alert('முதலில் ராசி அல்லது நவாம்சம் கட்டத்தின் ஒரு பெட்டியை கிளிக் செய்யவும் (Click on a chart box first)');
            }
        }

        // Auto-normalize Height & Weight on blur
        window.addEventListener('DOMContentLoaded', () => {
            const hInput = document.getElementById('height');
            if (hInput) {
                hInput.addEventListener('blur', function() {
                    if (this.value && this.value.trim()) {
                        this.value = normalizeHeightSpeech(this.value);
                    }
                });
            }
            const wInput = document.getElementById('weight');
            if (wInput) {
                wInput.addEventListener('blur', function() {
                    if (this.value && this.value.trim()) {
                        this.value = normalizeWeightSpeech(this.value);
                    }
                });
            }
        });
    </script>
</body>
</html>
