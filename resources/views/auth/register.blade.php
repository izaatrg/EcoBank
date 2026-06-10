<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - EcoBank</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* BASE DESIGN SYSTEM RESET */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background-color: #f8fafc !important;
            margin: 0;
            display: flex;
            overflow-x: hidden;
        }

        /* SCREEN SPLIT LAYOUT WRAPPER */
        .app-split-container {
            display: grid;
            grid-template-columns: 1.15fr 1fr;
            width: 100vw;
            min-height: 100vh;
        }

        /* ================= LEFT SIDE PANEL: PREMIUM BRANDING ================= */
        .brand-panel-left {
            background: linear-gradient(135deg, #00382c 0%, #004d3d 100%) !important;
            color: #ffffff !important;
            padding: 55px 70px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .identity-logo-wrapper {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .identity-logo-icon {
            background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
            color: #ffffff;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            box-shadow: 0 4px 12px rgba(56, 239, 125, 0.25);
        }

        .content-text-group {
            margin-top: auto;
            margin-bottom: auto;
            padding-bottom: 30px;
        }

        .headline-main-title {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: -1px;
            margin-bottom: 22px;
            color: #ffffff !important;
        }

        .headline-sub-title {
            color: rgba(241, 245, 249, 0.75) !important;
            font-size: 15.5px;
            line-height: 1.65;
            margin-bottom: 42px;
            max-width: 520px;
        }

        /* GRID DUA KARTU FITUR MODERN (GLASSMORPHISM) */
        .services-features-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            max-width: 540px;
            margin-bottom: 45px;
        }

        .service-glass-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.09);
            border-radius: 20px;
            padding: 24px;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), background 0.2s ease;
        }

        .service-glass-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.07);
        }

        .service-card-icon-box {
            background-color: rgba(56, 239, 125, 0.12);
            color: #38ef7d !important;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 18px;
        }

        .service-card-main-title {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff !important;
            margin-bottom: 6px;
        }

        .service-card-tag-info {
            color: rgba(255, 255, 255, 0.45) !important;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.75px;
        }

        /* FRAME MEDIA ILUSTRASI PRESISI */
        .media-illustration-frame {
            width: 100%;
            height: 250px;
            border-radius: 24px;
            overflow: hidden;
            margin-top: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .media-illustration-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ================= RIGHT SIDE PANEL: MINIMALIST REGISTRATION FORM ================= */
        .form-panel-right {
            background-color: #f8fafc !important;
            /* Warna latar bersih premium */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
        }

        .form-structural-box {
            width: 100%;
            max-width: 450px;
        }

        .form-identity-headline {
            color: #0f172a !important;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .form-identity-sub-headline {
            color: #64748b !important;
            font-size: 14.5px;
            margin-bottom: 35px;
        }

        .form-input-element-row {
            margin-bottom: 22px;
        }

        .form-input-label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155 !important;
            margin-bottom: 8px;
        }

        /* STRUKTUR INPUT DENGAN EFEK ELEGAN */
        .interactive-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .interactive-input-container i {
            position: absolute;
            left: 18px;
            color: #94a3b8;
            font-size: 15px;
            transition: color 0.2s ease;
        }

        .functional-input-tag {
            width: 100%;
            padding: 14px 18px 14px 48px;
            background-color: #ffffff !important;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14.5px;
            color: #0f172a;
            outline: none;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 分0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .functional-input-tag::placeholder {
            color: #94a3b8;
        }

        .functional-input-tag:focus {
            border-color: #004d3d;
            box-shadow: 0 0 0 4px rgba(0, 77, 61, 0.08);
        }

        .functional-input-tag:focus+i {
            color: #004d3d;
        }

        /* LAYOUT PASSWORD SEJAJAR (ROW GRID) */
        .password-grid-double {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* CHECKBOX PERSETUJUAN LAYANAN */
        .checkbox-agreement-label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 24px;
            margin-bottom: 28px;
            cursor: pointer;
            font-size: 13.5px;
            color: #475569 !important;
            line-height: 1.5;
        }

        .checkbox-agreement-label input {
            width: 17px;
            height: 17px;
            margin-top: 2px;
            accent-color: #004d3d;
            flex-shrink: 0;
            border-radius: 4px;
        }

        .checkbox-agreement-label a {
            color: #004d3d;
            text-decoration: none;
            font-weight: 600;
        }

        .checkbox-agreement-label a:hover {
            text-decoration: underline;
        }

        /* ACTION SUBMIT BUTTON */
        .btn-execution-action {
            width: 100%;
            background-color: #004d3d !important;
            color: #ffffff !important;
            border: none;
            padding: 15px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(0, 77, 61, 0.15);
            transition: all 0.2s ease;
        }

        .btn-execution-action:hover {
            background-color: #00382c !important;
            box-shadow: 0 6px 16px rgba(0, 77, 61, 0.25);
            transform: translateY(-1px);
        }

        /* SEPARATOR LINE & REDIRECTION ROUTE */
        .separator-container {
            position: relative;
            text-align: center;
            margin-top: 35px;
            margin-bottom: 25px;
        }

        .separator-line {
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background-color: #e2e8f0;
            z-index: 1;
        }

        .separator-text {
            position: relative;
            background-color: #f8fafc !important;
            padding: 0 18px;
            color: #64748b !important;
            font-size: 13.5px;
            z-index: 2;
        }

        .login-route-fallback {
            text-align: center;
        }

        .login-route-fallback a {
            color: #004d3d !important;
            text-decoration: none;
            font-weight: 700;
            font-size: 14.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s ease;
        }

        .login-route-fallback a:hover {
            color: #00241c !important;
        }

        /* ERROR VALIDATION MESSAGES DISPLAY */
        .error-validation-card {
            background-color: #fef2f2;
            border: 1px solid #fee2e2;
            color: #991b1b;
            padding: 14px;
            border-radius: 12px;
            font-size: 13.5px;
            margin-bottom: 24px;
        }

        /* MEDIA QUERIES FOR ADAPTIVE RESPONSIVENESS */
        @media (max-width: 1024px) {
            .app-split-container {
                grid-template-columns: 1fr;
            }

            .brand-panel-left {
                display: none;
                /* Sembunyikan panel info pada smartphone */
            }

            .form-panel-right {
                padding: 50px 24px;
            }
        }
    </style>
</head>

<body>

    <div class="app-split-container">

        <div class="brand-panel-left">
            <div class="identity-logo-wrapper">
                <div class="identity-logo-icon">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                EcoBank
            </div>

            <div class="content-text-group">
                <h1 class="headline-main-title">Mulai Langkah Hijau Anda</h1>
                <p class="headline-sub-title">
                    Bergabunglah dengan ribuan nasabah lainnya yang telah mengubah sampah menjadi nilai ekonomi. Kelola masa depan bumi sambil memperkuat stabilitas finansial Anda.
                </p>

                <div class="services-features-layout">
                    <div class="service-glass-card">
                        <div class="service-card-icon-box">
                            <i class="fa-solid fa-recycle"></i>
                        </div>
                        <div class="service-card-main-title">Setor Mudah</div>
                        <div class="service-card-tag-info">Layanan Jemput</div>
                    </div>
                    <div class="service-glass-card">
                        <div class="service-card-icon-box">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        </div>
                        <div class="service-card-main-title">Poin Lestari</div>
                        <div class="service-card-tag-info">Reward Menarik</div>
                    </div>
                </div>
            </div>

            <div class="media-illustration-frame">
                <img src="https://images.unsplash.com/photo-1511497584788-876760111969?auto=format&fit=crop&w=800&q=80" alt="Eco Hutan Lestari">
            </div>
        </div>

        <div class="form-panel-right">
            <div class="form-structural-box">
                <h2 class="form-identity-headline">Daftar Akun Baru</h2>
                <p class="form-identity-sub-headline">Lengkapi data diri Anda untuk memulai perjalanan lestari.</p>

                @if ($errors->any())
                <div class="error-validation-card">
                    <ul style="margin: 0; padding-left: 16px;">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-input-element-row">
                        <label class="form-input-label">Nama Lengkap</label>
                        <div class="interactive-input-container">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="name" class="functional-input-tag" placeholder="Budi Santoso" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-input-element-row">
                        <label class="form-input-label">Email</label>
                        <div class="interactive-input-container">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" name="email" class="functional-input-tag" placeholder="budi.lestari@email.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-input-element-row">
                        <label class="form-input-label">No. Telepon</label>
                        <div class="interactive-input-container">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="phone" class="functional-input-tag" placeholder="0812 3456 7890" value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    <div class="password-grid-double">
                        <div class="form-input-element-row">
                            <label class="form-input-label">Kata Sandi</label>
                            <div class="interactive-input-container">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="password" class="functional-input-tag" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="form-input-element-row">
                            <label class="form-input-label">Konfirmasi Kata Sandi</label>
                            <div class="interactive-input-container">
                                <i class="fa-solid fa-rotate-left"></i>
                                <input type="password" name="password_confirmation" class="functional-input-tag" placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>

                    <label class="checkbox-agreement-label">
                        <input type="checkbox" required>
                        <span>Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> EcoBank.</span>
                    </label>

                    <button type="submit" class="btn-execution-action">
                        Daftar Sekarang <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div class="separator-container">
                    <div class="separator-line"></div>
                    <span class="separator-text">Sudah punya akun?</span>
                </div>

                <div class="login-route-fallback">
                    <a href="{{ route('login') }}">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Akun Anda
                    </a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>