<!DOCTYPE html>
<html lang="ta">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>மாஸ்டர் மணமாலை | Master Matrimony</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #881337;
            --primary-dark: #4c0519;
            --gold: #b45309;
            --gold-border: #f59e0b;
            --dark: #0f172a;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Mukta Malar', 'Plus Jakarta Sans', 'Outfit', sans-serif;
        }

        body {
            background: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(136, 19, 55, 0.4) 0px, transparent 60%),
                radial-gradient(at 100% 100%, rgba(180, 83, 9, 0.3) 0px, transparent 60%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border: 2px solid var(--gold-border);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            animation: fadeIn 0.35s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            background: #0f172a;
            border-bottom: 2px solid var(--gold-border);
            padding: 28px 24px 22px;
            text-align: center;
            position: relative;
        }

        .lang-switch-login {
            position: absolute;
            top: 14px;
            right: 16px;
            display: flex;
            gap: 4px;
            background: rgba(255, 255, 255, 0.1);
            padding: 2px;
            border-radius: 6px;
        }

        .btn-lang {
            border: none;
            background: transparent;
            color: #cbd5e1;
            font-size: 11.5px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-lang.active {
            background: #881337;
            color: #fff;
        }

        .emblem-symbol {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(245, 158, 11, 0.35);
        }

        .login-title {
            font-size: 21px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.25;
            letter-spacing: -0.2px;
        }

        .login-sub {
            font-size: 13.5px;
            font-weight: 700;
            color: #fcd34d;
            margin-top: 4px;
        }

        .login-body {
            padding: 28px 26px 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            height: 46px;
            padding: 0 16px;
            font-size: 15px;
            font-weight: 600;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            transition: all 0.2s;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(136, 19, 55, 0.12);
        }

        .btn-login {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #881337 0%, #4c0519 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(136, 19, 55, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #9f1239 0%, #701a25 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(136, 19, 55, 0.45);
        }

        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="lang-switch-login">
                <button type="button" class="btn-lang active" id="btnTa" onclick="switchLoginLang('ta')">தமிழ்</button>
                <button type="button" class="btn-lang" id="btnEn" onclick="switchLoginLang('en')">English</button>
            </div>

            <div class="emblem-symbol" style="background: transparent; box-shadow: none; width: 64px; height: 64px; margin: 0 auto 10px; padding: 0;">
                <img src="{{ asset('images/logo.svg') }}" alt="Master Matrimony Logo" onerror="this.src='/images/logo.svg'" style="width: 64px; height: 64px; object-fit: contain; border-radius: 50%; display: block; margin: 0 auto;">
            </div>
            <h1 class="login-title" id="txt_title">மாஸ்டர் மணமாலை</h1>
            <div class="login-sub" id="txt_sub">Master Matrimony - கட்டுப்பாட்டு முகப்பு</div>
        </div>

        <div class="login-body">
            @if(session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('matrimony.doLogin') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label class="form-label" id="lbl_user">பயனர் பெயர் அல்லது அடையாள எண்</label>
                    <div style="position: relative; display: flex; align-items: center; width: 100%;">
                        <input type="text" name="username" id="login_username" class="form-control" placeholder="பயனர் பெயர் அல்லது ID" autocomplete="off" required autofocus style="padding-right: 44px;">
                        <button type="button" onclick="toggleLoginUserVis()" id="btnLoginUserVis" style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; font-size: 18px; color: #64748b; padding: 4px; display: flex; align-items: center; justify-content: center; z-index: 2;" title="Show/Hide ID">
                            🙈
                        </button>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label" id="lbl_pwd">கடவுச்சொல்</label>
                    <div style="position: relative; display: flex; align-items: center; width: 100%;">
                        <input type="password" name="password" id="login_password" class="form-control" placeholder="••••••••" autocomplete="new-password" required style="padding-right: 44px;">
                        <button type="button" onclick="toggleLoginPasswordVis()" id="btnLoginPassVis" style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; font-size: 18px; color: #64748b; padding: 4px; display: flex; align-items: center; justify-content: center; z-index: 2;" title="Show/Hide Password">
                            👁️
                        </button>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                    <button type="button" onclick="openForgotModal()" id="lnk_forgot" style="background: none; border: none; color: #881337; font-size: 13px; font-weight: 700; cursor: pointer; text-decoration: underline; padding: 0;">
                        கடவுச்சொல் அல்லது ID மறந்துவிட்டதா?
                    </button>
                </div>

                <button type="submit" class="btn-login">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span id="btn_submit_txt">உள்நுழைக</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Forgot Password / ID Modal -->
    <div id="forgotModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 20px; box-sizing: border-box;">
        <div style="background: #ffffff; width: 100%; max-width: 440px; border-radius: 20px; border: 2px solid #f59e0b; box-shadow: 0 25px 60px rgba(0,0,0,0.4); overflow: hidden; animation: fadeIn 0.25s ease-out;">
            <!-- Modal Header -->
            <div style="background: #0f172a; padding: 20px 22px; display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #f59e0b;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 22px;">🔑</span>
                    <div>
                        <h3 style="color: #ffffff; font-size: 16px; font-weight: 800; margin: 0;" id="txt_forgot_title">கடவுச்சொல் / ID மீட்டெடுப்பு</h3>
                        <div style="color: #fcd34d; font-size: 12px; font-weight: 600;" id="txt_forgot_sub">Password & ID Recovery via Email OTP</div>
                    </div>
                </div>
                <button type="button" onclick="closeForgotModal()" style="background: rgba(255,255,255,0.1); border: none; color: #ffffff; width: 32px; height: 32px; border-radius: 50%; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>
            </div>

            <!-- Modal Body -->
            <div style="padding: 24px 22px;">
                <!-- Live Alert Box -->
                <div id="forgotAlert" style="display: none; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 700; margin-bottom: 16px; line-height: 1.4;"></div>

                <!-- STEP 1: Enter Email & Send OTP -->
                <div id="stepSendOtp">
                    <p style="font-size: 13px; color: #475569; font-weight: 600; margin-bottom: 16px; line-height: 1.45;" id="txt_forgot_intro">
                        உங்கள் பதிவு செய்யப்பட்ட நிர்வாக மின்னஞ்சல் முகவரியை உள்ளிடவும். 6-இலக்க OTP உங்கள் மின்னஞ்சலுக்கு அனுப்பப்படும்.
                    </p>
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" id="lbl_forgot_email">நிர்வாக மின்னஞ்சல்</label>
                        <input type="email" id="forgot_email" class="form-control" placeholder="எ.கா: admin@gmail.com" value="{{ $currentEmail ?? 'admin@gmail.com' }}" required>
                    </div>
                    <button type="button" onclick="handleSendForgotOtp()" id="btnSendOtp" class="btn-login" style="height: 44px; font-size: 15px;">
                        <span id="btn_send_otp_txt">OTP அனுப்புக</span>
                    </button>
                </div>

                <!-- STEP 2: Verify OTP & Enter New Password -->
                <div id="stepVerifyOtp" style="display: none;">
                    <div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 10px; padding: 12px 14px; margin-bottom: 16px; font-size: 13px; color: #15803d; font-weight: 700; line-height: 1.45;" id="otpNoticeBox">
                        📩 உங்கள் மின்னஞ்சலுக்கு 6-இலக்க OTP அனுப்பப்பட்டுள்ளது! தயவுசெய்து உங்கள் Inbox அல்லது Spam ஃபோல்டரை சரிபார்த்து கீழே உள்ளிடவும்.
                    </div>

                    <div class="form-group" style="margin-bottom: 14px;">
                        <label class="form-label" id="lbl_enter_otp">6-இலக்க OTP எண்</label>
                        <input type="text" id="forgot_otp" class="form-control" placeholder="" maxlength="6" style="text-align: center; font-size: 20px; font-weight: 800; letter-spacing: 6px;" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 14px;">
                        <label class="form-label" id="lbl_forgot_newpwd">புதிய கடவுச்சொல்</label>
                        <div style="position: relative; display: flex; align-items: center; width: 100%;">
                            <input type="password" id="forgot_new_password" class="form-control" placeholder="குறைந்தது 4 எழுத்துக்கள்" style="padding-right: 44px;" required>
                            <button type="button" onclick="toggleForgotPassVis('forgot_new_password', this)" style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; font-size: 16px; color: #64748b; padding: 4px;">👁️</button>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" id="lbl_forgot_confirmpwd">புதிய கடவுச்சொல்லை உறுதி செய்க</label>
                        <div style="position: relative; display: flex; align-items: center; width: 100%;">
                            <input type="password" id="forgot_confirm_password" class="form-control" placeholder="மீண்டும் கடவுச்சொல்லை உள்ளிடவும்" style="padding-right: 44px;" required>
                            <button type="button" onclick="toggleForgotPassVis('forgot_confirm_password', this)" style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; font-size: 16px; color: #64748b; padding: 4px;">👁️</button>
                        </div>
                    </div>

                    <button type="button" onclick="handleVerifyForgotOtp()" id="btnVerifyOtp" class="btn-login" style="height: 44px; font-size: 15px;">
                        <span id="btn_verify_otp_txt">சரிபார்த்து மாற்றுக</span>
                    </button>

                    <div style="text-align: center; margin-top: 14px;">
                        <button type="button" onclick="backToSendOtpStep()" style="background: none; border: none; color: #64748b; font-size: 12.5px; font-weight: 700; cursor: pointer; text-decoration: underline;">
                            <span id="btn_resend_otp_txt">← மீண்டும் OTP அனுப்ப</span>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: Success Screen -->
                <div id="stepSuccessOtp" style="display: none; text-align: center; padding: 10px 0;">
                    <div style="width: 54px; height: 54px; border-radius: 50%; background: #dcfce7; color: #15803d; font-size: 26px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                        ✓
                    </div>
                    <h4 style="font-size: 16.5px; font-weight: 800; color: #1e293b; margin-bottom: 6px;" id="txt_forgot_success_title">கடவுச்சொல் வெற்றிகரமாக மாற்றப்பட்டது!</h4>
                    <p style="font-size: 13.5px; color: #475569; margin-bottom: 16px;" id="txt_forgot_success_body">
                        <span id="txt_forgot_user_lbl">உங்கள் நிர்வாக பயனர் ID:</span> <strong style="color: #881337; font-size: 16px;" id="resSuccessUsername">admin</strong>
                    </p>
                    <button type="button" onclick="proceedToLoginAfterReset()" class="btn-login" style="height: 44px; font-size: 15px;">
                        <span id="btn_proceed_login_txt">உள்நுழைவு பக்கத்திற்கு செல்க</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const hasCustom = {{ !empty($hasCustomCredentials) ? 'true' : 'false' }};
        let currentForgotLang = 'ta';
        let verifiedNewUsername = 'admin';

        function toggleLoginUserVis() {
            const usrInput = document.getElementById('login_username');
            const btn = document.getElementById('btnLoginUserVis');
            if (!usrInput) return;
            if (usrInput.type === 'password') {
                usrInput.type = 'text';
                if (btn) btn.innerHTML = '🙈';
            } else {
                usrInput.type = 'password';
                if (btn) btn.innerHTML = '👁️';
            }
        }

        function toggleLoginPasswordVis() {
            const pwdInput = document.getElementById('login_password');
            const btn = document.getElementById('btnLoginPassVis');
            if (!pwdInput) return;
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                if (btn) btn.innerHTML = '🙈';
            } else {
                pwdInput.type = 'password';
                if (btn) btn.innerHTML = '👁️';
            }
        }

        function toggleForgotPassVis(inputId, btn) {
            const el = document.getElementById(inputId);
            if (!el) return;
            if (el.type === 'password') {
                el.type = 'text';
                if (btn) btn.innerHTML = '🙈';
            } else {
                el.type = 'password';
                if (btn) btn.innerHTML = '👁️';
            }
        }

        function openForgotModal() {
            const m = document.getElementById('forgotModal');
            if (m) {
                m.style.display = 'flex';
                document.getElementById('stepSendOtp').style.display = 'block';
                document.getElementById('stepVerifyOtp').style.display = 'none';
                document.getElementById('stepSuccessOtp').style.display = 'none';
                hideForgotAlert();
                const emInp = document.getElementById('forgot_email');
                if (emInp) emInp.focus();
            }
        }

        function closeForgotModal() {
            const m = document.getElementById('forgotModal');
            if (m) m.style.display = 'none';
        }

        function backToSendOtpStep() {
            document.getElementById('stepSendOtp').style.display = 'block';
            document.getElementById('stepVerifyOtp').style.display = 'none';
            document.getElementById('stepSuccessOtp').style.display = 'none';
            hideForgotAlert();
        }

        function showForgotAlert(msg, type = 'error') {
            const box = document.getElementById('forgotAlert');
            if (!box) return;
            box.style.display = 'block';
            if (type === 'success') {
                box.style.background = '#f0fdf4';
                box.style.border = '1.5px solid #22c55e';
                box.style.color = '#15803d';
            } else {
                box.style.background = '#fef2f2';
                box.style.border = '1.5px solid #ef4444';
                box.style.color = '#991b1b';
            }
            box.innerText = msg;
        }

        function hideForgotAlert() {
            const box = document.getElementById('forgotAlert');
            if (box) box.style.display = 'none';
        }

        async function handleSendForgotOtp() {
            hideForgotAlert();
            const emailInp = document.getElementById('forgot_email');
            const email = emailInp ? emailInp.value.trim() : '';

            if (!email) {
                showForgotAlert(currentForgotLang === 'ta' ? 'மின்னஞ்சல் முகவரியை உள்ளிடவும்!' : 'Please enter your email address!', 'error');
                return;
            }

            const btn = document.getElementById('btnSendOtp');
            const btnTxt = document.getElementById('btn_send_otp_txt');
            if (btn) {
                btn.disabled = true;
                btn.style.opacity = '0.7';
            }
            if (btnTxt) {
                btnTxt.innerText = currentForgotLang === 'ta' ? 'OTP அனுப்பப்படுகிறது...' : 'Sending OTP...';
            }

            try {
                const res = await fetch("{{ route('matrimony.forgot.sendOtp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email: email, lang: currentForgotLang })
                });

                const data = await res.json();
                if (btn) {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                }
                if (btnTxt) {
                    btnTxt.innerText = currentForgotLang === 'ta' ? 'OTP அனுப்புக' : 'Send OTP';
                }

                if (res.ok && data.success) {
                    document.getElementById('stepSendOtp').style.display = 'none';
                    document.getElementById('stepVerifyOtp').style.display = 'block';

                    const otpInp = document.getElementById('forgot_otp');
                    if (otpInp) {
                        otpInp.value = '';
                        otpInp.focus();
                    }
                } else {
                    const errText = (currentForgotLang === 'en')
                        ? (data.message_en || data.message || 'Failed to send OTP!')
                        : (data.message_ta || data.message || 'OTP அனுப்புவதில் பிழை!');
                    showForgotAlert(errText, 'error');
                }
            } catch (err) {
                if (btn) {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                }
                if (btnTxt) {
                    btnTxt.innerText = currentForgotLang === 'ta' ? 'OTP அனுப்புக' : 'Send OTP';
                }
                showForgotAlert(currentForgotLang === 'en' ? 'Network connection error!' : 'நெட்வொர்க் பிழை ஏற்பட்டது!', 'error');
            }
        }

        async function handleVerifyForgotOtp() {
            hideForgotAlert();
            const emailInp = document.getElementById('forgot_email');
            const otpInp = document.getElementById('forgot_otp');
            const pInp = document.getElementById('forgot_new_password');
            const cpInp = document.getElementById('forgot_confirm_password');

            const email = emailInp ? emailInp.value.trim() : '';
            const otp = otpInp ? otpInp.value.trim() : '';
            const password = pInp ? pInp.value : '';
            const confirmPassword = cpInp ? cpInp.value : '';

            if (!otp || otp.length < 4) {
                showForgotAlert(currentForgotLang === 'ta' ? 'சரியான OTP எண்ணை உள்ளிடவும்!' : 'Please enter a valid OTP code!', 'error');
                return;
            }

            if (!password || password.length < 4) {
                showForgotAlert(currentForgotLang === 'ta' ? 'கடவுச்சொல் குறைந்தது 4 எழுத்துக்கள் இருக்க வேண்டும்!' : 'Password must be at least 4 characters!', 'error');
                return;
            }

            if (password !== confirmPassword) {
                showForgotAlert(currentForgotLang === 'ta' ? 'கடவுச்சொற்கள் பொருந்தவில்லை!' : 'Passwords do not match!', 'error');
                return;
            }

            const btn = document.getElementById('btnVerifyOtp');
            const btnTxt = document.getElementById('btn_verify_otp_txt');
            if (btn) {
                btn.disabled = true;
                btn.style.opacity = '0.7';
            }
            if (btnTxt) {
                btnTxt.innerText = currentForgotLang === 'ta' ? 'சரிபார்க்கப்படுகிறது...' : 'Verifying...';
            }

            try {
                const res = await fetch("{{ route('matrimony.forgot.verifyOtp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp,
                        password: password,
                        password_confirmation: confirmPassword,
                        lang: currentForgotLang
                    })
                });

                const data = await res.json();
                if (btn) {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                }
                if (btnTxt) {
                    btnTxt.innerText = currentForgotLang === 'ta' ? 'சரிபார்த்து மாற்றுக' : 'Verify & Reset Password';
                }

                if (res.ok && data.success) {
                    verifiedNewUsername = data.username || 'admin';
                    document.getElementById('stepVerifyOtp').style.display = 'none';
                    document.getElementById('stepSuccessOtp').style.display = 'block';
                    document.getElementById('resSuccessUsername').innerText = verifiedNewUsername;
                } else {
                    const errText = (currentForgotLang === 'en')
                        ? (data.message_en || data.message || 'Invalid OTP or error!')
                        : (data.message_ta || data.message || 'தவறான OTP அல்லது பிழை!');
                    showForgotAlert(errText, 'error');
                }
            } catch (err) {
                if (btn) {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                }
                if (btnTxt) {
                    btnTxt.innerText = currentForgotLang === 'ta' ? 'சரிபார்த்து மாற்றுக' : 'Verify & Reset Password';
                }
                showForgotAlert(currentForgotLang === 'en' ? 'Network connection error!' : 'நெட்வொர்க் பிழை ஏற்பட்டது!', 'error');
            }
        }

        function proceedToLoginAfterReset() {
            closeForgotModal();
            const uInp = document.getElementById('login_username');
            const pInp = document.getElementById('login_password');
            if (uInp) uInp.value = verifiedNewUsername;
            if (pInp) {
                pInp.value = '';
                pInp.focus();
            }
        }

        function switchLoginLang(lang) {
            currentForgotLang = lang;
            document.getElementById('btnTa').classList.toggle('active', lang === 'ta');
            document.getElementById('btnEn').classList.toggle('active', lang === 'en');

            const uInp = document.getElementById('login_username');
            const pInp = document.getElementById('login_password');
            const lnkForgot = document.getElementById('lnk_forgot');
            const forgotEmailInp = document.getElementById('forgot_email');
            const forgotOtpInp = document.getElementById('forgot_otp');
            const forgotPassInp = document.getElementById('forgot_new_password');
            const forgotConfInp = document.getElementById('forgot_confirm_password');

            if (lang === 'en') {
                document.getElementById('txt_title').innerText = 'Master Matrimony';
                document.getElementById('txt_sub').innerText = 'Matrimonial Information Centre - Login';
                document.getElementById('lbl_user').innerText = 'Username or ID';
                document.getElementById('lbl_pwd').innerText = 'Password';
                if (uInp) uInp.placeholder = 'Username or ID';
                if (pInp) pInp.placeholder = 'Password';
                document.getElementById('btn_submit_txt').innerText = 'Sign In';
                if (lnkForgot) lnkForgot.innerText = 'Forgot Password or ID?';

                // Forgot Modal texts
                document.getElementById('txt_forgot_title').innerText = 'Password & ID Recovery';
                document.getElementById('txt_forgot_sub').innerText = 'Reset Password via Email OTP';
                document.getElementById('txt_forgot_intro').innerText = 'Enter your registered Admin Email ID. A 6-digit OTP will be sent to your email to verify your identity.';
                document.getElementById('lbl_forgot_email').innerText = 'Admin Email Address';
                if (forgotEmailInp) forgotEmailInp.placeholder = 'e.g. admin@gmail.com';
                document.getElementById('btn_send_otp_txt').innerText = 'Send OTP';
                const otpNotice = document.getElementById('otpNoticeBox');
                if (otpNotice) otpNotice.innerText = '📩 A 6-digit OTP code has been sent to your email! Please check your Inbox or Spam folder and enter it below.';
                document.getElementById('lbl_enter_otp').innerText = '6-Digit OTP Code';
                if (forgotOtpInp) forgotOtpInp.placeholder = '';
                document.getElementById('lbl_forgot_newpwd').innerText = 'New Password';
                if (forgotPassInp) forgotPassInp.placeholder = 'At least 4 characters';
                document.getElementById('lbl_forgot_confirmpwd').innerText = 'Confirm New Password';
                if (forgotConfInp) forgotConfInp.placeholder = 'Re-enter new password';
                document.getElementById('btn_verify_otp_txt').innerText = 'Verify & Reset Password';
                const resendTxt = document.getElementById('btn_resend_otp_txt');
                if (resendTxt) resendTxt.innerText = '← Resend OTP';
                document.getElementById('txt_forgot_success_title').innerText = 'Password Reset Successfully!';
                const succUserLbl = document.getElementById('txt_forgot_user_lbl');
                if (succUserLbl) succUserLbl.innerText = 'Your Admin User ID:';
                const proceedTxt = document.getElementById('btn_proceed_login_txt');
                if (proceedTxt) proceedTxt.innerText = 'Back to Sign In';
            } else {
                document.getElementById('txt_title').innerText = 'மாஸ்டர் மணமாலை';
                document.getElementById('txt_sub').innerText = 'Master Matrimony - கட்டுப்பாட்டு முகப்பு';
                document.getElementById('lbl_user').innerText = 'பயனர் பெயர் அல்லது அடையாள எண்';
                document.getElementById('lbl_pwd').innerText = 'கடவுச்சொல்';
                if (uInp) uInp.placeholder = 'பயனர் பெயர் அல்லது ID';
                if (pInp) pInp.placeholder = 'கடவுச்சொல்';
                document.getElementById('btn_submit_txt').innerText = 'உள்நுழைக';
                if (lnkForgot) lnkForgot.innerText = 'கடவுச்சொல் அல்லது ID மறந்துவிட்டதா?';

                // Forgot Modal texts
                document.getElementById('txt_forgot_title').innerText = 'கடவுச்சொல் / ID மீட்டெடுப்பு';
                document.getElementById('txt_forgot_sub').innerText = 'Password & ID Recovery via Email OTP';
                document.getElementById('txt_forgot_intro').innerText = 'உங்கள் பதிவு செய்யப்பட்ட நிர்வாக மின்னஞ்சல் முகவரியை உள்ளிடவும். 6-இலக்க OTP உங்கள் மின்னஞ்சலுக்கு அனுப்பப்படும்.';
                document.getElementById('lbl_forgot_email').innerText = 'நிர்வாக மின்னஞ்சல்';
                if (forgotEmailInp) forgotEmailInp.placeholder = 'எ.கா: admin@gmail.com';
                document.getElementById('btn_send_otp_txt').innerText = 'OTP அனுப்புக';
                const otpNotice = document.getElementById('otpNoticeBox');
                if (otpNotice) otpNotice.innerText = '📩 உங்கள் மின்னஞ்சலுக்கு 6-இலக்க OTP அனுப்பப்பட்டுள்ளது! தயவுசெய்து உங்கள் Inbox அல்லது Spam ஃபோல்டரை சரிபார்த்து கீழே உள்ளிடவும்.';
                document.getElementById('lbl_enter_otp').innerText = '6-இலக்க OTP எண்';
                if (forgotOtpInp) forgotOtpInp.placeholder = '';
                document.getElementById('lbl_forgot_newpwd').innerText = 'புதிய கடவுச்சொல்';
                if (forgotPassInp) forgotPassInp.placeholder = 'குறைந்தது 4 எழுத்துக்கள்';
                document.getElementById('lbl_forgot_confirmpwd').innerText = 'புதிய கடவுச்சொல்லை உறுதி செய்க';
                if (forgotConfInp) forgotConfInp.placeholder = 'மீண்டும் கடவுச்சொல்லை உள்ளிடவும்';
                document.getElementById('btn_verify_otp_txt').innerText = 'சரிபார்த்து மாற்றுக';
                const resendTxt = document.getElementById('btn_resend_otp_txt');
                if (resendTxt) resendTxt.innerText = '← மீண்டும் OTP அனுப்ப';
                document.getElementById('txt_forgot_success_title').innerText = 'கடவுச்சொல் வெற்றிகரமாக மாற்றப்பட்டது!';
                const succUserLbl = document.getElementById('txt_forgot_user_lbl');
                if (succUserLbl) succUserLbl.innerText = 'உங்கள் நிர்வாக பயனர் ID:';
                const proceedTxt = document.getElementById('btn_proceed_login_txt');
                if (proceedTxt) proceedTxt.innerText = 'உள்நுழைவு பக்கத்திற்கு செல்க';
            }
        }
    </script>

</body>
</html>
