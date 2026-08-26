<!DOCTYPE html>
<html lang="th" class="light-style customizer-hide" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>เข้าสู่ระบบนักเรียน | โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</title>
    <meta name="description" content="ระบบงานนักเรียน โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ (@skj.ac.th)" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" />

    <!-- Google Fonts: Sarabun & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Sarabun:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet" />

    <!-- Icons & Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css?v=3') ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Google Identity Services Library -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <style>
        :root {
            --primary-pink: #e83e8c;
            --primary-dark: #a81c5d;
            --primary-light: #f472b6;
            --accent-cyan: #06b6d4;
            --bg-gradient: linear-gradient(135deg, #180312 0%, #3b0726 35%, #5c0d38 70%, #9d1757 100%);
        }

        html {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            font-family: 'Sarabun', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: clamp(12px, 3vw, 24px);
            color: #f8fafc;
            position: relative;
            overflow-x: hidden;
        }

        /* Fixed Background Container preventing scrollbars */
        .bg-animation-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        /* Ambient Animated Orbs */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 0;
            pointer-events: none;
            opacity: 0.6;
            animation: orbFloat 12s ease-in-out infinite alternate;
        }

        .bg-orb-1 {
            width: clamp(280px, 45vw, 500px);
            height: clamp(280px, 45vw, 500px);
            background: rgba(232, 62, 140, 0.7);
            top: -100px;
            left: -100px;
        }

        .bg-orb-2 {
            width: clamp(300px, 50vw, 550px);
            height: clamp(300px, 50vw, 550px);
            background: rgba(244, 114, 182, 0.6);
            bottom: -120px;
            right: -120px;
            animation-delay: -6s;
        }

        @keyframes orbFloat {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(35px, 25px) scale(1.12);
            }
        }

        /* Background Animated SVGs */
        .svg-float-bg {
            position: absolute;
            z-index: 1;
            pointer-events: none;
            opacity: 0.16;
            filter: drop-shadow(0 0 15px rgba(232, 62, 140, 0.6));
            animation: svgFloat 8s ease-in-out infinite alternate;
        }

        .svg-cap {
            top: 8%;
            left: 6%;
            width: clamp(80px, 12vw, 130px);
            animation-duration: 7s;
        }

        .svg-book {
            bottom: 8%;
            left: 7%;
            width: clamp(70px, 10vw, 110px);
            animation-duration: 9s;
            animation-delay: -2s;
        }

        .svg-cloud {
            top: 10%;
            right: 6%;
            width: clamp(90px, 14vw, 140px);
            animation-duration: 8.5s;
            animation-delay: -4s;
        }

        .svg-badge {
            bottom: 10%;
            right: 7%;
            width: clamp(80px, 11vw, 120px);
            animation-duration: 10s;
            animation-delay: -1s;
        }

        @keyframes svgFloat {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-16px) rotate(3deg);
            }

            100% {
                transform: translateY(8px) rotate(-3deg);
            }
        }

        /* Glassmorphism Auth Card */
        .glass-auth-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: clamp(20px, 5vw, 32px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.5), 0 0 40px rgba(232, 62, 140, 0.25);
            color: #1e293b;
            overflow: hidden;
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 2;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            padding: clamp(24px, 5vw, 36px) clamp(18px, 4vw, 28px);
            text-align: center;
            color: #ffffff;
            position: relative;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .brand-logo {
            width: clamp(70px, 18vw, 90px);
            height: clamp(70px, 18vw, 90px);
            object-fit: contain;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.3));
            margin-bottom: 12px;
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.06) rotate(2deg);
        }

        .auth-body {
            padding: clamp(20px, 5vw, 32px) clamp(16px, 4vw, 26px);
        }

        /* Section Cards */
        .modern-section-card {
            background: #ffffff;
            border-radius: 20px;
            padding: clamp(14px, 3.5vw, 20px);
            border: 1.5px solid #f1f5f9;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease;
        }

        .modern-section-card:hover {
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .section-card-login {
            background: linear-gradient(180deg, #ffffff 0%, #faf5ff 100%);
            border-color: #f3e8ff;
        }

        .section-card-register {
            background: linear-gradient(180deg, #ffffff 0%, #ecfeff 100%);
            border-color: #cffafe;
        }

        .section-pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .pill-login {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .pill-register {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }

        /* Google Login Button (Pink Theme) */
        .btn-google-modern {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            border: none;
            border-radius: 16px;
            padding: 13px 18px;
            font-size: clamp(0.95rem, 2.5vw, 1.05rem);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            min-height: 52px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 6px 18px rgba(232, 62, 140, 0.35);
            text-decoration: none;
        }

        .btn-google-modern:hover {
            background: linear-gradient(135deg, #f472b6 0%, var(--primary-pink) 100%);
            color: #ffffff;
            box-shadow: 0 10px 26px rgba(232, 62, 140, 0.5);
            transform: translateY(-2px);
        }

        /* Forgot Password Text Link */
        .reset-link-btn {
            color: #64748b;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .reset-link-btn:hover {
            color: var(--primary-pink);
            background: rgba(232, 62, 140, 0.08);
        }

        /* Action Link Button */
        .btn-action-register {
            background: linear-gradient(135deg, #06b6d4 0%, #0284c7 100%);
            color: #ffffff;
            border: none;
            border-radius: 16px;
            padding: 12px 18px;
            font-size: clamp(0.9rem, 2.3vw, 1rem);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            min-height: 48px;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(6, 182, 212, 0.35);
            transition: all 0.25s ease;
        }

        .btn-action-register:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(6, 182, 212, 0.45);
        }

        /* Ultra Modern Modal Cards */
        .modal-feature-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.28s ease;
            position: relative;
            overflow: hidden;
        }

        .modal-feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.09);
        }

        .modal-feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            border-radius: 4px 0 0 4px;
        }

        .card-accent-purple::before {
            background: linear-gradient(180deg, #a855f7, #6b21a8);
        }

        .card-accent-blue::before {
            background: linear-gradient(180deg, #3b82f6, #1d4ed8);
        }

        .card-accent-emerald::before {
            background: linear-gradient(180deg, #10b981, #047857);
        }

        .card-accent-amber::before {
            background: linear-gradient(180deg, #f59e0b, #b45309);
        }

        .feature-icon-badge {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            flex-shrink: 0;
        }

        .badge-purple {
            background: linear-gradient(135deg, #a855f7 0%, #7e22ce 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.35);
        }

        .badge-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
        }

        .badge-emerald {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
        }

        .badge-amber {
            background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.35);
        }

        /* High Contrast Modal Close Button */
        .btn-modal-close {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            color: #ffffff !important;
            border: none;
            border-radius: 14px;
            padding: 12px 28px;
            font-size: 1rem;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(232, 62, 140, 0.4);
            transition: all 0.25s ease;
        }

        .btn-modal-close:hover {
            background: linear-gradient(135deg, #f472b6 0%, var(--primary-pink) 100%);
            color: #ffffff !important;
            box-shadow: 0 8px 24px rgba(232, 62, 140, 0.55);
            transform: translateY(-2px);
        }

        /* High Contrast Why Google Button */
        .btn-why-google {
            background-color: #ffffff;
            color: #0f172a;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 8px 12px;
            font-size: clamp(0.75rem, 2.1vw, 0.85rem);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-why-google:hover {
            background-color: #ffffff;
            border-color: var(--primary-pink);
            color: var(--primary-pink);
            box-shadow: 0 6px 18px rgba(232, 62, 140, 0.25);
            transform: translateY(-2px);
        }

        /* Mobile specific fine-tuning */
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .auth-body {
                padding: 18px 14px;
            }

            .svg-float-bg {
                opacity: 0.1;
            }
        }
    </style>
</head>

<body>

    <!-- Fixed Animation Container to prevent overflow scrollbars -->
    <div class="bg-animation-container">
        <!-- Ambient Glowing Orbs -->
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>

        <!-- Floating Background SVGs -->
        <svg class="svg-float-bg svg-cap" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
            <path d="M6 12v5c3 3 9 3 12 0v-5" />
        </svg>
        <svg class="svg-float-bg svg-book" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
        </svg>
        <svg class="svg-float-bg svg-cloud" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z" />
        </svg>
        <svg class="svg-float-bg svg-badge" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            <path d="m9 12 2 2 4-4" />
        </svg>
    </div>

    <!-- Main Auth Glass Card -->
    <div class="glass-auth-card">
        <!-- Header -->
        <div class="auth-header">
            <img src="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" alt="SKJ Logo" class="brand-logo" />
            <h4 class="fw-bold mb-1 text-white" style="font-size: clamp(1.2rem, 3.5vw, 1.5rem);">ระบบงานนักเรียน</h4>
            <p class="mb-0 text-white-50 small">โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</p>
        </div>

        <!-- Body -->
        <div class="auth-body">


            <!-- Notice Alert Box for Unverified Email Students -->
            <div class="alert alert-warning border-warning d-flex align-items-center mb-3 rounded-3 shadow-sm p-3"
                role="alert">
                <i class="bx bx-bell fs-3 me-2 text-warning flex-shrink-0"></i>
                <div class="small">
                    <strong>แจ้งเตือน:</strong> หากยังใช้อีเมลไม่ได้ หรือเพิ่งเข้าใช้งานครั้งแรก กรุณา <a
                        href="<?= base_url('verify-email') ?>"
                        class="fw-bold text-dark text-decoration-underline">กดยืนยันตัวตนออกอีเมลที่นี่</a> ก่อนนะครับ
                </div>
            </div>

            <!-- SECTION 1: LOGIN & RESET PASSWORD -->
            <div class="modern-section-card section-card-login mb-3">

                <!-- Google Login Button -->
                <button type="button" class="btn-google-modern" id="btnGoogleCustomLogin">
                    <span class="bg-white rounded-circle p-1 d-inline-flex align-items-center justify-content-center">
                        <svg width="18" height="18" viewBox="0 0 18 18">
                            <path fill="#4285F4"
                                d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l-.01.12 2.67 2.07.18.02c1.7-1.57 2.68-3.88 2.68-6.63z" />
                            <path fill="#34A853"
                                d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.41-1.57-5.13-3.72l-.11.01-2.78 2.15-.04.1C2.46 15.99 5.48 18 9 18z" />
                            <path fill="#FBBC05"
                                d="M3.87 10.8c-.2-.59-.31-1.22-.31-1.8s.11-1.21.31-1.8l-.01-.13-2.79-2.17-.09.04C.35 6.13 0 7.52 0 9s.35 2.87.98 4.09l2.89-2.29z" />
                            <path fill="#EA4335"
                                d="M9 3.58c1.32 0 2.5.45 3.44 1.35l2.58-2.58C13.46.89 11.43 0 9 0 5.48 0 2.46 2.01.98 4.91l2.89 2.29c.72-2.15 2.75-3.62 5.13-3.62z" />
                        </svg>
                    </span>
                    เข้าสู่ระบบด้วย Google (@skj.ac.th)
                </button>

                <!-- Small Forgot Password Link Right-Aligned -->
                <div class="text-end mt-2">
                    <a href="javascript:void(0)" id="btnHomeResetPassword" class="reset-link-btn">
                        <i class="bx bx-key"></i> ลืมรหัสผ่าน / รีเซ็ตรหัสผ่าน?
                    </a>
                </div>
            </div>

            <!-- SECTION 2: NEW M.1 STUDENTS REGISTRATION -->
            <div class="modern-section-card section-card-register">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="section-pill-badge pill-register">
                        <i class="bx bx-user-plus"></i> นักเรียนใหม่และเก่า
                    </span>
                    <span class="text-info small fw-bold">ยังไม่มีอีเมล</span>
                </div>

                <!-- Registration Button -->
                <a href="<?= base_url('verify-email') ?>" class="btn-action-register">
                    <i class="bx bx-shield-quarter fs-5"></i> ยืนยันตัวตนขอรับอีเมลครั้งแรก &rarr;
                </a>
            </div>

            <!-- Read Details Button (Why Google Account) & User Guide -->
            <div class="mt-3 d-flex flex-column gap-2 text-center">
                <a href="<?= base_url('guide') ?>" class="btn btn-outline-danger w-100 shadow-sm rounded-3 fw-bold py-2">
                    <i class="bx bx-book-open fs-5 me-1 align-middle"></i>
                    <span>คู่มือการใช้งาน & การใช้อีเมลโรงเรียน (@skj.ac.th)</span>
                </a>
                <button type="button" class="btn btn-why-google w-100 shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#modalWhyGoogle">
                    <i class="bx bx-info-circle text-primary fs-6"></i>
                    <span>ทำไมต้องเข้าสู่ระบบด้วย Google? (อ่านรายละเอียด)</span>
                </button>
            </div>

            <!-- Footer Link -->
            <div class="mt-3 text-center">
                <a href="https://m.me/skjnews" target="_blank"
                    class="text-muted small text-decoration-none opacity-75 hover-opacity-100">
                    <i class="bx bx-help-circle me-1"></i> ติดต่อศูนย์ช่วยเหลือเทคโนโลยีสารสนเทศ
                </a>
            </div>

        </div>
    </div>

    <!-- Ultra Modern Modal Why Google Login -->
    <div class="modal fade" id="modalWhyGoogle" tabindex="-1" aria-labelledby="modalWhyGoogleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header text-white p-4"
                    style="background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);">
                    <div class="d-flex align-items-center gap-3">
                        <span
                            class="p-2 bg-white bg-opacity-20 rounded-circle text-white d-flex align-items-center justify-content-center">
                            <i class="bx bx-bulb fs-3"></i>
                        </span>
                        <h5 class="modal-title text-white fw-bold mb-0" id="modalWhyGoogleLabel"
                            style="font-size: 1.2rem;">
                            ทำไมต้องเข้าสู่ระบบด้วย Google (@skj.ac.th)?
                        </h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 text-dark" style="background: #f8fafc;">
                    <p class="text-dark mb-4 fs-6 fw-normal bg-white p-3 rounded-3 border shadow-sm">
                        โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ ได้ปรับเปลี่ยนมาใช้อีเมลบัญชี Google
                        (<code>@skj.ac.th</code>) เป็นมาตรฐานหลักในการเข้าสู่ระบบงานนักเรียน
                        เพื่อสิทธิประโยชน์และความปลอดภัยสูงสุดของนักเรียนดังนี้:
                    </p>

                    <div class="row g-3">
                        <!-- Point 1 -->
                        <div class="col-md-6">
                            <div class="modal-feature-card card-accent-purple">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="feature-icon-badge badge-purple">
                                        <i class="bx bx-shield-quarter"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-1 fs-6">1. ความปลอดภัยสูงสุด</div>
                                        <div class="small text-dark lh-sm">
                                            เข้าใช้งานผ่านระบบความปลอดภัยมาตรฐานโลกของ Google
                                            ป้องกันการถูกแอบอ้างรหัสผ่านเข้าใช้บัญชีได้อย่างเด็ดขาด
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Point 2 -->
                        <div class="col-md-6">
                            <div class="modal-feature-card card-accent-blue">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="feature-icon-badge badge-blue">
                                        <i class="bx bx-bolt-circle"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-1 fs-6">2. สะดวกรวดเร็ว คลิกเดียวจบ</div>
                                        <div class="small text-dark lh-sm">
                                            ไม่ต้องจำรหัสนักเรียนหรือเลขบัตรประชาชนหลายตัว แค่กดเลือกบัญชี Google
                                            โรงเรียนก็ล็อกอินเข้าใช้ได้ทันที
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Point 3 -->
                        <div class="col-md-6">
                            <div class="modal-feature-card card-accent-emerald">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="feature-icon-badge badge-emerald">
                                        <i class="bx bx-cloud"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-1 fs-6">3. ใช้ Google Workspace ฟรี</div>
                                        <div class="small text-dark lh-sm">
                                            ใช้อีเมลโรงเรียนเข้าใช้งาน Google Classroom, Drive, Meet, Docs, Sheets
                                            ได้ฟรีไม่จำกัดเนื้อหาตลอดการเป็นนักเรียน
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Point 4 -->
                        <div class="col-md-6">
                            <div class="modal-feature-card card-accent-amber">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="feature-icon-badge badge-amber">
                                        <i class="bx bx-key"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-1 fs-6">4. จัดการรหัสผ่านได้เอง 24 ชม.</div>
                                        <div class="small text-dark lh-sm">
                                            นักเรียนตั้งรหัสผ่านใหม่ส่วนตัวผ่าน Google ได้เอง
                                            หากลืมรหัสก็กดสุ่มรีเซ็ตรหัสผ่านใหม่ผ่านหน้าเว็บได้ตลอดเวลา
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3" style="background: #f1f5f9;">
                    <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal">
                        <i class="bx bx-check-circle me-1"></i> เข้าใจแล้ว ขอบคุณครับ/ค่ะ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Google OAuth2 Popup Login - opens a real Google sign-in window
        document.getElementById('btnGoogleCustomLogin').addEventListener('click', function () {
            if (typeof google !== 'undefined' && google.accounts && google.accounts.oauth2) {
                const tokenClient = google.accounts.oauth2.initTokenClient({
                    client_id: '<?= env('GOOGLE_CLIENT_ID') ?: getenv('GOOGLE_CLIENT_ID') ?>',
                    scope: 'openid email profile',
                    hint: '',
                    hosted_domain: 'skj.ac.th',
                    callback: function (tokenResponse) {
                        if (tokenResponse && tokenResponse.access_token) {
                            // Show loading while we fetch user info
                            Swal.fire({
                                title: 'กำลังเข้าสู่ระบบ...',
                                text: 'กำลังตรวจสอบข้อมูลกับ Google',
                                allowOutsideClick: false,
                                didOpen: function () { Swal.showLoading(); }
                            });

                            // Fetch user email from Google using the access token
                            fetch('https://www.googleapis.com/oauth2/v3/userinfo', {
                                headers: { 'Authorization': 'Bearer ' + tokenResponse.access_token }
                            })
                            .then(function (res) { return res.json(); })
                            .then(function (userInfo) {
                                if (userInfo && userInfo.email) {
                                    // Send email to our backend
                                    $.ajax({
                                        url: '<?= base_url('login/google') ?>',
                                        type: 'POST',
                                        data: { email: userInfo.email },
                                        dataType: 'json',
                                        success: function (res) {
                                            if (res.status === 1) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'เข้าสู่ระบบสำเร็จ!',
                                                    text: res.message,
                                                    timer: 1500,
                                                    showConfirmButton: false
                                                }).then(function () {
                                                    window.location.href = res.redirect;
                                                });
                                            } else {
                                                showUnverifiedEmailAlert(res.message);
                                            }
                                        },
                                        error: function () {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'เกิดข้อผิดพลาด',
                                                text: 'ไม่สามารถเชื่อมต่อระบบได้ กรุณาลองใหม่อีกครั้ง',
                                                confirmButtonColor: '#e83e8c'
                                            });
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ไม่พบอีเมล',
                                        text: 'ไม่สามารถดึงข้อมูลอีเมลจาก Google ได้ กรุณาลองใหม่',
                                        confirmButtonColor: '#e83e8c'
                                    });
                                }
                            })
                            .catch(function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถเชื่อมต่อกับ Google ได้',
                                    confirmButtonColor: '#e83e8c'
                                });
                            });
                        }
                    },
                    error_callback: function (error) {
                        // If popup was blocked or user closed it, do nothing gracefully
                        console.log('Google OAuth popup error:', error);
                    }
                });

                // This opens the Google Sign-In popup window
                tokenClient.requestAccessToken();
            } else {
                // GIS library not loaded - fall back to manual email input
                promptGoogleEmailLogin();
            }
        });

        // Friendly warning alert prompting student to verify identity first if email is not found/usable
        function showUnverifiedEmailAlert(msg) {
            Swal.fire({
                icon: 'warning',
                title: 'ยังไม่ได้ยืนยันตัวตนออกอีเมล',
                html: '<div class="mb-3 text-secondary">' + (msg || 'ไม่พบบัญชีอีเมลนี้ในระบบ') + '</div>' +
                    '<div class="alert alert-info small text-start mb-0"><i class="bx bx-info-circle me-1"></i> <b>คำแนะนำ:</b> นักเรียนต้องทำรายการยืนยันตัวตน (ใช้เลขนักเรียน + เลขบัตรประชาชน 13 หลัก) เพื่อออกอีเมลโรงเรียนก่อนเข้าใช้งาน</div>',
                showCancelButton: true,
                confirmButtonText: '✨ ไปหน้ายืนยันตัวตนรับอีเมลเลย',
                cancelButtonText: 'ปิดหน้าต่าง',
                confirmButtonColor: '#e83e8c',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('verify-email') ?>';
                }
            });
        }


        // Direct email input modal fallback for Google login testing
        function promptGoogleEmailLogin() {
            Swal.fire({
                title: 'เข้าสู่ระบบด้วย Google Account',
                text: 'กรุณาระบุอีเมลโรงเรียนของคุณ (เช่น skj12345@skj.ac.th)',
                input: 'email',
                inputPlaceholder: 'skjXXXXX@skj.ac.th',
                showCancelButton: true,
                confirmButtonText: 'เข้าสู่ระบบ',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#e83e8c',
                inputValidator: (value) => {
                    if (!value) {
                        return 'กรุณาระบุอีเมลโรงเรียน';
                    }
                    if (!value.endsWith('@skj.ac.th')) {
                        return 'กรุณาใช้อีเมลโดเมนโรงเรียน (@skj.ac.th) เท่านั้น';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    Swal.fire({
                        title: 'กำลังเข้าสู่ระบบ...',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    $.ajax({
                        url: '<?= base_url('login/google') ?>',
                        type: 'POST',
                        data: { email: result.value },
                        dataType: 'json',
                        success: function (res) {
                            if (res.status === 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เข้าสู่ระบบสำเร็จ!',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = res.redirect;
                                });
                            } else {
                                showUnverifiedEmailAlert(res.message);
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
                                confirmButtonColor: '#e83e8c'
                            });
                        }
                    });
                }
            });
        }

        // Home Page Reset Password Modal Handler
        document.getElementById('btnHomeResetPassword').addEventListener('click', function () {
            Swal.fire({
                title: '🔑 รีเซ็ตรหัสผ่านอีเมลโรงเรียน',
                html:
                    '<div class="text-start mb-3">' +
                    '<label class="form-label small fw-bold">เลขประจำตัวนักเรียน</label>' +
                    '<input id="swal_student_code" class="form-control mb-2" placeholder="เช่น 12345" autocomplete="off">' +
                    '<label class="form-label small fw-bold">เลขประจำตัวประชาชน (13 หลัก)</label>' +
                    '<input id="swal_id_card" type="password" class="form-control" placeholder="ระบุเลขบัตรประชาชน 13 หลัก" maxlength="13" autocomplete="off">' +
                    '</div>',
                showCancelButton: true,
                confirmButtonText: 'ยืนยันรีเซ็ตรหัสผ่าน',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#e83e8c',
                cancelButtonColor: '#6c757d',
                preConfirm: () => {
                    const studentCode = document.getElementById('swal_student_code').value.trim();
                    const idCard = document.getElementById('swal_id_card').value.trim();
                    if (!studentCode || !idCard) {
                        Swal.showValidationMessage('กรุณากรอกเลขประจำตัวนักเรียนและเลขประจำตัวประชาชนให้ครบถ้วน');
                        return false;
                    }
                    return { student_code: studentCode, id_card: idCard };
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    Swal.fire({
                        title: 'กำลังรีเซ็ตรหัสผ่าน...',
                        text: 'กำลังอัปเดตรหัสผ่านใหม่ไปยัง Google Workspace',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    $.ajax({
                        url: '<?= base_url('verify-email/reset-password') ?>',
                        type: 'POST',
                        data: result.value,
                        dataType: 'json',
                        success: function (res) {
                            if (res.status === 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'รีเซ็ตรหัสผ่านสำเร็จ!',
                                    html:
                                        '<div class="text-start bg-light p-3 rounded-3 mb-3 border">' +
                                        '<div><b>ชื่อ-นามสกุล:</b> ' + res.data.student_name + '</div>' +
                                        '<div><b>อีเมลโรงเรียน:</b> <span class="font-monospace text-primary fw-bold">' + res.data.email + '</span></div>' +
                                        '<div class="mt-2 text-muted small">รหัสผ่านใหม่ของคุณ:</div>' +
                                        '<div class="p-2 bg-white border rounded text-center font-monospace fs-4 text-danger fw-bold my-2" id="homeResPass">' + res.data.new_password + '</div>' +
                                        '<div class="text-center"><button class="btn btn-sm btn-secondary" onclick="navigator.clipboard.writeText(\'' + res.data.new_password + '\'); this.textContent=\'คัดลอกรหัสแล้ว!\';"><i class="bx bx-copy me-1"></i> คัดลอกรหัสผ่าน</button></div>' +
                                        '</div>' +
                                        '<div class="alert alert-info small text-start mb-0"><i class="bx bx-info-circle me-1"></i>นำรหัสผ่านนี้ไปล็อกอินใน Gmail เมื่อเข้าสู่ระบบครั้งแรก Google จะบังคับให้ตั้งรหัสผ่านใหม่ส่วนตัวทันที</div>',
                                    confirmButtonText: 'ตกลง',
                                    confirmButtonColor: '#e83e8c'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'รีเซ็ตไม่สำเร็จ',
                                    text: res.message || 'ข้อมูลไม่ถูกต้อง',
                                    confirmButtonColor: '#e83e8c'
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
                                confirmButtonColor: '#e83e8c'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>