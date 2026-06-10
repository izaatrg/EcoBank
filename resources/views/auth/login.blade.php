<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Digital - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* RESET TOTAL agar tidak bentrok dengan CSS bawaan template lama */
        html,
        body,
        div,
        form,
        input,
        button,
        p,
        h1,
        h2,
        label {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #e3f7ee 0%, #f4fbf7 100%) !important;
            position: relative;
            overflow-x: hidden;
            padding: 20px;
        }

        /* Container Card Utama di Tengah */
        .login-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 460px;
            padding: 40px 35px;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(18, 73, 52, 0.06);
            text-align: center;
            z-index: 10;
        }

        /* Logo Ikon Eco */
        .logo-box {
            background-color: #124934;
            color: white;
            width: 48px;
            height: 48px;
            font-size: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .main-title {
            color: #124934;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #667085;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        /* Form Layout */
        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .field-label {
            font-size: 12px;
            font-weight: 600;
            color: #475467;
        }

        .link-green {
            font-size: 12px;
            font-weight: 600;
            color: #0d8354;
            text-decoration: none;
        }

        .link-green:hover {
            text-decoration: underline;
        }

        /* Wrapper Input + Ikon */
        .input-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .icon-left {
            position: absolute;
            left: 14px;
            color: #98a2b3;
            font-size: 16px;
        }

        .icon-right {
            position: absolute;
            right: 14px;
            color: #98a2b3;
            font-size: 16px;
            cursor: pointer;
        }

        .input-field {
            width: 100%;
            padding: 13px 16px 13px 42px;
            border: 1px solid #d0d5dd;
            border-radius: 10px;
            font-size: 14px;
            color: #1d2939;
            outline: none;
            transition: all 0.2s;
        }

        .input-field-pass {
            padding-right: 42px;
        }

        .input-field:focus {
            border-color: #0d8354;
            box-shadow: 0 0 0 3px rgba(13, 131, 84, 0.1);
        }

        /* Checkbox Ingat Saya */
        .remember-box {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            cursor: pointer;
            font-size: 13px;
            color: #475467;
            text-align: left;
        }

        .remember-box input {
            width: 16px;
            height: 16px;
            accent-color: #124934;
        }

        /* Tombol Login Utama */
        .btn-login {
            width: 100%;
            background-color: #124934;
            color: white;
            border: none;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(18, 73, 52, 0.15);
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: #0d3827;
        }

        /* Session Alert Error Bawaan Laravel */
        .alert-error {
            background-color: #fef3f2;
            border: 1px solid #fecdca;
            color: #b42318;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: left;
        }

        .footer-text {
            margin-top: 25px;
            font-size: 13px;
            color: #475467;
        }

        /* Dekorasi Luar Bawah */
        .bottom-decor {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
        }

        .dots-row {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 8px;
        }

        .dot {
            width: 6px;
            height: 6px;
            background-color: #94cfb6;
            border-radius: 50%;
        }

        .dot.active {
            background-color: #0d8354;
            width: 16px;
            border-radius: 4px;
        }

        .tagline {
            font-size: 10px;
            letter-spacing: 1.5px;
            color: #8fa399;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <div class="logo-box">
            <i class="fa-solid fa-recycle"></i>
        </div>

        <h1 class="main-title">Bank Sampah Digital</h1>
        <p class="subtitle">Kelola sampah Anda dengan lebih efisien dan dapatkan koin reward secara cerdas.</p>

        @if ($errors->any())
        <div class="alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> Email atau kata sandi salah.
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="field-label">Username atau Email</label>
                <div class="input-box">
                    <i class="fa-regular fa-user icon-left"></i>
                    <input type="text" name="email" class="input-field" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label class="field-label">Kata Sandi</label>
                    <a href="{{ route('password.request') }}" class="link-green">Lupa Kata Sandi?</a>
                </div>
                <div class="input-box">
                    <i class="fa-solid fa-lock icon-left"></i>
                    <input type="password" name="password" id="passwordField" class="input-field input-field-pass" placeholder="••••••••" required>
                    <i class="fa-regular fa-eye icon-right" id="eyeIcon"></i>
                </div>
            </div>

            <label class="remember-box">
                <input type="checkbox" name="remember">
                Ingat saya di perangkat ini
            </label>

            <button type="submit" class="btn-login">
                Masuk Ke Akun <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        </form>

        <p class="footer-text">
            Belum menjadi bagian dari komunitas kami?<br>
            <a href="{{ route('register') }}" class="link-green">Daftar Akun Baru</a>
        </p>

    </div>

    <div class="bottom-decor">
        <div class="dots-row">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
        <div class="tagline">SUSTAINABILITY FIRST</div>
    </div>

    <script>
        const eyeIcon = document.querySelector('#eyeIcon');
        const passwordField = document.querySelector('#passwordField');

        eyeIcon.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>