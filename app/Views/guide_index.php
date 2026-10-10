<!DOCTYPE html>
<html lang="th" class="light-style customizer-hide" dir="ltr">

<head>
    <!-- ตรวจจับและเปิดออกนอกแอป LINE / In-App Browser ไปยัง Chrome/Safari อัตโนมัติ -->
    <script>
    (function () {
        var ua = navigator.userAgent || navigator.vendor || window.opera;
        var isLine = /Line\//i.test(ua);
        var isAndroid = /Android/i.test(ua);
        var isIOS = /iPhone|iPad|iPod/i.test(ua);

        if (isLine) {
            var currentUrl = window.location.href;
            if (isAndroid) {
                var cleanUrl = currentUrl.replace(/^https?:\/\//, '');
                window.location.href = 'intent://' + cleanUrl + '#Intent;scheme=https;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;end;';
            } else if (isIOS) {
                if (currentUrl.indexOf('openExternalBrowser=1') === -1) {
                    var separator = currentUrl.indexOf('?') !== -1 ? '&' : '?';
                    window.location.href = currentUrl + separator + 'openExternalBrowser=1';
                }
            }
        }
    })();
    </script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>คู่มือการใช้งานระบบนักเรียน | โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</title>
    <meta name="description" content="คู่มือการใช้งานระบบนักเรียน และการเริ่มต้นใช้งานอีเมลโรงเรียน (@skj.ac.th) สำหรับนักเรียนทุกคน โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" />

    <!-- Google Fonts: Sarabun & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Sarabun:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet" />

    <!-- Icons & Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css?v=3') ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        :root {
            --primary-pink: #e83e8c;
            --primary-dark: #a81c5d;
            --primary-light: #f472b6;
            --accent-cyan: #06b6d4;
            --accent-amber: #f59e0b;
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
            margin: 0;
            padding: clamp(16px, 4vw, 36px) clamp(12px, 3vw, 24px);
            color: #f8fafc;
            position: relative;
            overflow-x: hidden;
        }

        /* Fixed Background Container */
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

        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 0;
            pointer-events: none;
            opacity: 0.55;
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
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(35px, 25px) scale(1.12); }
        }

        /* Main Glass Container */
        .guide-container {
            max-width: 980px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: clamp(20px, 4vw, 32px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.5), 0 0 40px rgba(232, 62, 140, 0.25);
            color: #1e293b;
            overflow: hidden;
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

        .guide-header {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            padding: clamp(26px, 5vw, 38px) clamp(18px, 4vw, 32px);
            text-align: center;
            color: #ffffff;
            position: relative;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .brand-logo {
            width: clamp(70px, 15vw, 88px);
            height: clamp(70px, 15vw, 88px);
            object-fit: contain;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.3));
            margin-bottom: 10px;
        }

        .guide-body {
            padding: clamp(18px, 4vw, 36px) clamp(14px, 3.5vw, 32px);
        }

        /* DEDICATED TOP MENU BUTTONS / TABS (คนละปุ่มชัดเจน) */
        .guide-tab-nav {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .guide-tab-btn {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            text-align: left;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #334155;
            width: 100%;
        }

        .guide-tab-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
        }

        .tab-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .tab-title-text {
            font-weight: 800;
            font-size: 0.95rem;
            line-height: 1.2;
            margin-bottom: 2px;
        }

        .tab-subtitle-text {
            font-size: 0.76rem;
            color: #64748b;
            line-height: 1.2;
        }

        /* Active states for each distinct menu button */
        .btn-tab-cyan .tab-icon-box { background: #ecfeff; color: #0891b2; }
        .btn-tab-cyan.active {
            background: linear-gradient(135deg, #06b6d4 0%, #0284c7 100%);
            border-color: #06b6d4;
            color: #ffffff !important;
            box-shadow: 0 8px 25px rgba(6, 182, 212, 0.4);
            transform: translateY(-2px);
        }
        .btn-tab-cyan.active .tab-icon-box { background: rgba(255, 255, 255, 0.25); color: #ffffff; }
        .btn-tab-cyan.active .tab-subtitle-text { color: rgba(255, 255, 255, 0.85); }

        .btn-tab-pink .tab-icon-box { background: #fdf2f8; color: var(--primary-pink); }
        .btn-tab-pink.active {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            border-color: var(--primary-pink);
            color: #ffffff !important;
            box-shadow: 0 8px 25px rgba(232, 62, 140, 0.4);
            transform: translateY(-2px);
        }
        .btn-tab-pink.active .tab-icon-box { background: rgba(255, 255, 255, 0.25); color: #ffffff; }
        .btn-tab-pink.active .tab-subtitle-text { color: rgba(255, 255, 255, 0.85); }

        .btn-tab-amber .tab-icon-box { background: #fffbeb; color: #d97706; }
        .btn-tab-amber.active {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-color: #f59e0b;
            color: #ffffff !important;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
            transform: translateY(-2px);
        }
        .btn-tab-amber.active .tab-icon-box { background: rgba(255, 255, 255, 0.25); color: #ffffff; }
        .btn-tab-amber.active .tab-subtitle-text { color: rgba(255, 255, 255, 0.85); }

        /* Step Card Styling */
        .step-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1.5px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
            padding: clamp(18px, 3.5vw, 28px);
            margin-bottom: 24px;
            position: relative;
        }

        .step-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .step-badge-1 {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            box-shadow: 0 4px 14px rgba(6, 182, 212, 0.4);
        }

        .step-badge-2 {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 14px rgba(232, 62, 140, 0.4);
        }

        .step-badge-3 {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 4px 14px rgba(245, 158, 11, 0.4);
        }

        .step-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .step-list li {
            position: relative;
            padding-left: 38px;
            margin-bottom: 24px;
            font-size: 1rem;
            line-height: 1.6;
            color: #334155;
        }

        .step-list li:last-child {
            margin-bottom: 0;
        }

        .step-number {
            position: absolute;
            left: 0;
            top: 2px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #f1f5f9;
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--primary-light);
            box-shadow: 0 2px 6px rgba(232, 62, 140, 0.2);
        }

        .info-box {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-left: 4px solid #3b82f6;
            border-radius: 14px;
            padding: 14px 18px;
            margin: 14px 0;
        }

        .tip-box {
            background: linear-gradient(135deg, #fefce8 0%, #fef08a 100%);
            border-left: 4px solid #eab308;
            border-radius: 14px;
            padding: 14px 18px;
            margin: 14px 0;
            color: #713f12;
        }

        /* UI MOCKUP SCREEN PREVIEWS */
        .ui-mockup-window {
            background: #ffffff;
            border-radius: 18px;
            border: 1.5px solid #cbd5e1;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin: 14px 0 20px;
            position: relative;
        }

        .ui-mockup-topbar {
            background: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ui-mockup-dots {
            display: flex;
            gap: 5px;
        }

        .ui-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .ui-dot-red { background-color: #ef4444; }
        .ui-dot-yellow { background-color: #f59e0b; }
        .ui-dot-green { background-color: #10b981; }

        .ui-mockup-url {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 2px 12px;
            font-size: 0.75rem;
            color: #64748b;
            flex-grow: 1;
            max-width: 280px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .ui-mockup-body {
            padding: 18px;
            background: #fafafa;
        }

        /* Highlight Callout Pointer */
        .ui-pointer-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ec4899;
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
            animation: pulsePointer 1.8s infinite alternate;
        }

        @keyframes pulsePointer {
            0% { transform: translateY(0); }
            100% { transform: translateY(-3px); }
        }

        .ui-pulse-target {
            outline: 2.5px dashed #e83e8c !important;
            outline-offset: 3px;
            border-radius: 14px;
        }

        .ui-pulse-target-cyan {
            outline: 2.5px dashed #06b6d4 !important;
            outline-offset: 3px;
            border-radius: 14px;
        }

        /* Mockup Component Details */
        .mock-logo {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .mock-btn-google {
            background: linear-gradient(135deg, #e83e8c 0%, #a81c5d 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 700;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
        }

        .mock-btn-register {
            background: linear-gradient(135deg, #06b6d4 0%, #0284c7 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 700;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            text-decoration: none;
        }

        .mock-account-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.2s;
        }

        .mock-account-selected {
            border-color: #10b981;
            background: #f0fdf4;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.2);
        }

        /* Action Buttons */
        .btn-action-primary {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            border: none;
            border-radius: 16px;
            padding: 12px 22px;
            font-size: 1rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(232, 62, 140, 0.4);
            transition: all 0.25s ease;
        }

        .btn-action-primary:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(232, 62, 140, 0.55);
        }

        .btn-action-secondary {
            background: linear-gradient(135deg, #06b6d4 0%, #0284c7 100%);
            color: #ffffff;
            border: none;
            border-radius: 16px;
            padding: 12px 22px;
            font-size: 1rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
            transition: all 0.25s ease;
        }

        .btn-action-secondary:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(6, 182, 212, 0.55);
        }

        .back-home-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 10px 20px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            transition: all 0.25s ease;
            margin-top: 20px;
        }

        .back-home-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <!-- Background Orbs -->
    <div class="bg-animation-container">
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>
    </div>

    <!-- Main Container -->
    <div class="guide-container">

        <div class="glass-card">
            <!-- Header -->
            <div class="guide-header">
                <img src="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" alt="SKJ Logo" class="brand-logo" />
                <h3 class="fw-bold mb-1 text-white">คู่มือการใช้งานระบบนักเรียน & อีเมลโรงเรียน</h3>
                <p class="mb-0 text-white-50 fs-6">เลือกหัวข้อที่ต้องการดูคู่มือได้จากปุ่มด้านล่างนี้ได้เลยครับ</p>
            </div>

            <!-- Body -->
            <div class="guide-body">

                <!-- TOP SEPARATE MENU BUTTONS (คนละปุ่มชัดเจน) -->
                <div class="row g-3 mb-4" id="guideMenuButtons" role="tablist">
                    <!-- Button 1: ยืนยันตัวตนรับอีเมล -->
                    <div class="col-12 col-md-4">
                        <button class="guide-tab-btn btn-tab-cyan active" id="tab-btn-1" data-bs-toggle="pill" data-bs-target="#tab-content-1" type="button" role="tab" aria-controls="tab-content-1" aria-selected="true">
                            <div class="tab-icon-box">
                                <i class="bx bx-shield-quarter"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="tab-title-text">1. ยืนยันรับอีเมล</div>
                                <div class="tab-subtitle-text">สำหรับนักเรียนใหม่/ยังไม่มีอีเมล</div>
                            </div>
                        </button>
                    </div>

                    <!-- Button 2: เข้าสู่ระบบด้วย Google -->
                    <div class="col-12 col-md-4">
                        <button class="guide-tab-btn btn-tab-pink" id="tab-btn-2" data-bs-toggle="pill" data-bs-target="#tab-content-2" type="button" role="tab" aria-controls="tab-content-2" aria-selected="false">
                            <div class="tab-icon-box">
                                <i class="bx bxl-google"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="tab-title-text">2. เข้าสู่ระบบ Google</div>
                                <div class="tab-subtitle-text">ใช้งานประจำวัน / ดูเกรด / ชุมนุม</div>
                            </div>
                        </button>
                    </div>

                    <!-- Button 3: ลืมรหัสผ่าน / ขอรหัสใหม่ -->
                    <div class="col-12 col-md-4">
                        <button class="guide-tab-btn btn-tab-amber" id="tab-btn-3" data-bs-toggle="pill" data-bs-target="#tab-content-3" type="button" role="tab" aria-controls="tab-content-3" aria-selected="false">
                            <div class="tab-icon-box">
                                <i class="bx bx-key"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="tab-title-text">3. ลืมรหัสผ่าน / รีเซ็ต</div>
                                <div class="tab-subtitle-text">ขอรหัสผ่านใหม่ได้เอง 24 ชม.</div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- TAB CONTENT CONTAINER -->
                <div class="tab-content" id="guideTabContent">

                    <!-- ========================================== -->
                    <!-- TAB 1: ยืนยันตัวตนรับอีเมลครั้งแรก -->
                    <!-- ========================================== -->
                    <div class="tab-pane fade show active" id="tab-content-1" role="tabpanel" aria-labelledby="tab-btn-1">
                        <div class="step-card border-info">
                            <span class="step-badge step-badge-1">
                                <i class="bx bx-shield-quarter fs-5"></i> ขั้นตอนที่ 1: ยืนยันตัวตนรับอีเมลโรงเรียน (ทำครั้งแรกครั้งเดียว)
                            </span>

                            <div class="info-box">
                                <div class="fw-bold text-primary mb-1"><i class="bx bx-bulb me-1"></i> ทำไมต้องทำขั้นตอนนี้?</div>
                                <div class="small">นักเรียนโรงเรียนเราทุกคนจะมีอีเมลประจำตัวพิเศษที่ลงท้ายด้วย <code>@skj.ac.th</code> (ใช้ล็อกอินเข้าเรียน Google Classroom, ดูเกรด และใช้บริการ Google ได้ฟรีตลอดการเรียน)</div>
                            </div>

                            <ol class="step-list">
                                <li>
                                    <span class="step-number">1</span>
                                    เปิดหน้าแรกของ <strong>ระบบนักเรียน</strong> แล้วกดที่ปุ่มสีฟ้า <span class="badge bg-info text-dark fw-bold">"ยืนยันตัวตนขอรับอีเมลครั้งแรก"</span>

                                    <!-- UI MOCKUP 1: HOME PAGE LOGIN PREVIEW -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bx-lock-alt text-success"></i> skj.ac.th/student
                                            </div>
                                            <span class="badge bg-light text-secondary border small ms-auto">ภาพหน้าแรกระบบ</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 440px;">
                                                <div class="text-center mb-3">
                                                    <img src="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" alt="" class="mock-logo mb-1">
                                                    <div class="fw-bold text-dark fs-6">ระบบงานนักเรียน SKJ</div>
                                                </div>

                                                <!-- Login Section -->
                                                <div class="p-2 bg-light rounded-3 border mb-3 opacity-50">
                                                    <button class="mock-btn-google" disabled>
                                                        <i class="bx bxl-google text-white fs-5"></i> เข้าสู่ระบบด้วย Google (@skj.ac.th)
                                                    </button>
                                                </div>

                                                <!-- Register Section Target -->
                                                <div class="p-2 bg-white rounded-3 border border-info ui-pulse-target-cyan position-relative">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="badge bg-info text-dark">สำหรับนักเรียนที่ยังไม่มีอีเมล</span>
                                                        <span class="ui-pointer-tag">👉 1. กดปุ่มสีฟ้านี้</span>
                                                    </div>
                                                    <div class="mock-btn-register">
                                                        <i class="bx bx-shield-quarter fs-5"></i> ยืนยันตัวตนขอรับอีเมลครั้งแรก &rarr;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <span class="step-number">2</span>
                                    กรอกข้อมูลส่วนตัว 2 อย่าง ในหน้าระบบยืนยันตัวตน แล้วกดปุ่ม <strong>"ตรวจสอบและรับอีเมลโรงเรียน"</strong>

                                    <!-- UI MOCKUP 2: VERIFICATION FORM PREVIEW -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bx-lock-alt text-success"></i> skj.ac.th/verify-email
                                            </div>
                                            <span class="badge bg-light text-secondary border small ms-auto">ภาพหน้ารับอีเมล</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 440px;">
                                                <div class="text-center mb-3">
                                                    <div class="fw-bold text-danger fs-6"><i class="bx bx-shield-quarter"></i> ยืนยันตัวตนรับอีเมลโรงเรียน</div>
                                                    <div class="text-muted small">กรอกเลขประจำตัวและเลขบัตรประชาชน</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-dark d-flex justify-content-between">
                                                        <span><i class="bx bx-id-card text-primary"></i> เลขประจำตัวนักเรียน</span>
                                                        <span class="text-primary fw-normal">เช่น 12345 (5 หลัก)</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-sm bg-light" value="12345" readonly style="font-weight: 600;">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-dark d-flex justify-content-between">
                                                        <span><i class="bx bx-credit-card text-primary"></i> เลขบัตรประชาชน</span>
                                                        <span class="text-primary fw-normal">13 หลัก</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-sm bg-light" value="1609900123456" readonly style="font-weight: 600;">
                                                </div>

                                                <div class="position-relative">
                                                    <div class="d-flex justify-content-end mb-1">
                                                        <span class="ui-pointer-tag">👉 2. กดตรวจสอบข้อมูล</span>
                                                    </div>
                                                    <button class="mock-btn-google py-2" disabled>
                                                        <i class="bx bx-search-alt fs-5"></i> ตรวจสอบและรับอีเมลโรงเรียน
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <span class="step-number">3</span>
                                    <strong>จดบันทึกอีเมลและรหัสผ่านที่ได้</strong> แล้วกดปุ่ม <strong>"ไปเข้าสู่ระบบ Gmail"</strong> เพื่อตั้งรหัสผ่านใหม่

                                    <!-- UI MOCKUP 3: RESULT & ACTIVATION PREVIEW -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bx-check-circle text-success"></i> ผลการออกอีเมลสำเร็จ
                                            </div>
                                            <span class="badge bg-success-subtle text-success border border-success small ms-auto">สำเร็จ!</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 440px;">
                                                <div class="text-center mb-3">
                                                    <span class="badge bg-success p-2 rounded-circle mb-1"><i class="bx bx-check fs-4"></i></span>
                                                    <div class="fw-bold text-success fs-6">สร้างและออกอีเมลโรงเรียนสำเร็จ!</div>
                                                    <div class="text-muted small">ด.ช. สมชาย รักเรียน (ชั้น ม.1/1)</div>
                                                </div>

                                                <!-- Email Display -->
                                                <div class="p-2 bg-light border rounded-3 text-center mb-2">
                                                    <div class="text-muted small">อีเมลโรงเรียนของคุณ:</div>
                                                    <div class="fw-bold text-danger fs-5" style="font-family: monospace;">skj12345@skj.ac.th</div>
                                                    <span class="badge bg-secondary mt-1"><i class="bx bx-copy"></i> คัดลอกอีเมล</span>
                                                </div>

                                                <!-- Password Display -->
                                                <div class="p-2 bg-warning-subtle border border-warning rounded-3 text-center mb-3">
                                                    <div class="text-dark small">รหัสผ่านเริ่มต้น:</div>
                                                    <div class="fw-bold text-dark fs-5" style="font-family: monospace;">Skj@123456</div>
                                                    <span class="badge bg-secondary mt-1"><i class="bx bx-key"></i> คัดลอกรหัสผ่าน</span>
                                                </div>

                                                <!-- Next step trigger -->
                                                <div class="position-relative">
                                                    <div class="d-flex justify-content-end mb-1">
                                                        <span class="ui-pointer-tag">👉 3. กดเพื่อไปตั้งรหัสใหม่ที่ Google</span>
                                                    </div>
                                                    <button class="btn btn-outline-dark w-100 fw-bold d-flex align-items-center justify-content-center gap-2 py-2 rounded-3" disabled>
                                                        <i class="bx bxl-google text-danger fs-5"></i> ไปเข้าสู่ระบบ Gmail เพื่อตั้งรหัสผ่านใหม่
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tip-box mt-2 mb-0">
                                        <strong>⚠️ สำคัญมาก:</strong> เมื่อนำอีเมลไปล็อกอินเข้า Gmail ครั้งแรก Google จะให้ <strong>"ตั้งรหัสผ่านใหม่ส่วนตัว"</strong> ทันที ให้น้อง ๆ ตั้งรหัสผ่านที่จำได้ง่ายและจดบันทึกไว้ให้เรียบร้อยนะครับ
                                    </div>
                                </li>
                            </ol>

                            <div class="mt-4 d-flex justify-content-between flex-wrap gap-2">
                                <a href="<?= base_url('verify-email') ?>" class="btn-action-secondary">
                                    <i class="bx bx-shield-quarter"></i> ไปหน้ายืนยันตัวตนรับอีเมลทันที &rarr;
                                </a>
                                <button class="btn btn-outline-primary rounded-3 fw-bold px-3 py-2" onclick="switchGuideTab('tab-btn-2')">
                                    ดูขั้นตอนที่ 2: การเข้าสู่ระบบ Google &rarr;
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- TAB 2: เข้าสู่ระบบด้วย Google -->
                    <!-- ========================================== -->
                    <div class="tab-pane fade" id="tab-content-2" role="tabpanel" aria-labelledby="tab-btn-2">
                        <div class="step-card border-danger">
                            <span class="step-badge step-badge-2">
                                <i class="bx bxl-google fs-5"></i> ขั้นตอนที่ 2: เข้าสู่ระบบนักเรียนด้วย Google (สำหรับใช้งานประจำวัน)
                            </span>

                            <div class="info-box" style="background: #fdf2f8; border-color: var(--primary-pink); color: #831843;">
                                <div class="fw-bold mb-1"><i class="bx bx-rocket me-1"></i> เมื่อเปลี่ยนรหัสผ่านเสร็จแล้ว ต่อไปนี้เข้าใช้งานระบบได้ด้วยคลิกเดียว!</div>
                            </div>

                            <ol class="step-list">
                                <li>
                                    <span class="step-number">1</span>
                                    เปิดหน้าแรกของระบบนักเรียน แล้วกดปุ่มสีชมพู <strong>"เข้าสู่ระบบด้วย Google (@skj.ac.th)"</strong>
                                </li>

                                <li>
                                    <span class="step-number">2</span>
                                    จะมีหน้าต่าง Google ปรากฏขึ้นมา ให้น้อง <strong>เลือกบัญชีอีเมลโรงเรียน (@skj.ac.th)</strong> เท่านั้น

                                    <!-- UI MOCKUP 4: GOOGLE ACCOUNT CHOOSER PREVIEW -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bxl-google text-danger"></i> accounts.google.com/signin
                                            </div>
                                            <span class="badge bg-light text-secondary border small ms-auto">หน้าต่างเลือกบัญชี</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 440px;">
                                                <div class="text-center mb-3">
                                                    <i class="bx bxl-google text-danger fs-2"></i>
                                                    <div class="fw-bold text-dark fs-6">เลือกบัญชีเพื่อเข้าสู่ระบบ SKJ</div>
                                                </div>

                                                <!-- Wrong Account (Personal) -->
                                                <div class="mock-account-item mb-2 opacity-50">
                                                    <div class="rounded-circle bg-secondary text-white p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                        <i class="bx bx-user"></i>
                                                    </div>
                                                    <div class="text-start flex-grow-1">
                                                        <div class="fw-bold small text-dark">somchai.playgame@gmail.com</div>
                                                        <div class="text-danger small"><i class="bx bx-x-circle"></i> บัญชีส่วนตัว (ห้ามเลือก)</div>
                                                    </div>
                                                </div>

                                                <!-- Correct Account (School) Target -->
                                                <div class="mock-account-item mock-account-selected position-relative ui-pulse-target">
                                                    <div class="rounded-circle bg-danger text-white p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                        <i class="bx bx-check"></i>
                                                    </div>
                                                    <div class="text-start flex-grow-1">
                                                        <div class="fw-bold small text-dark">skj12345@skj.ac.th</div>
                                                        <div class="text-success small fw-bold"><i class="bx bx-check-circle"></i> บัญชีโรงเรียน (ถูกต้อง)</div>
                                                    </div>
                                                    <span class="ui-pointer-tag">👉 เลือกบัญชีนี้</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <span class="step-number">3</span>
                                    🎉 <strong>เข้าสู่ระบบสำเร็จ!</strong> ระบบจะพาน้องเข้าสู่หน้าจอหลัก เพื่อดูผลการเรียน หรือลงทะเบียนกิจกรรมชุมนุม

                                    <!-- UI MOCKUP 5: STUDENT DASHBOARD PREVIEW -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bx-home-alt text-primary"></i> skj.ac.th/dashboard
                                            </div>
                                            <span class="badge bg-success-subtle text-success border border-success small ms-auto">หน้าหลักนักเรียน</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 500px;">
                                                <!-- Welcome Banner -->
                                                <div class="p-3 text-white rounded-3 mb-3" style="background: linear-gradient(135deg, #e83e8c 0%, #b8266d 100%);">
                                                    <div class="fw-bold fs-6">สวัสดี, ด.ช. สมชาย รักเรียน 👋</div>
                                                    <div class="small opacity-75">รหัสนักเรียน: 12345 | ชั้น ม.1/1 | สถานะ: ปกติ</div>
                                                </div>

                                                <!-- Quick Action Cards -->
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <div class="p-2 border rounded-3 text-center bg-light">
                                                            <i class="bx bx-book-content text-primary fs-3"></i>
                                                            <div class="fw-bold small mt-1 text-dark">ดูผลการเรียน</div>
                                                            <span class="badge bg-primary w-100 mt-1">เข้าดูเกรด</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="p-2 border rounded-3 text-center bg-light">
                                                            <i class="bx bx-group text-success fs-3"></i>
                                                            <div class="fw-bold small mt-1 text-dark">กิจกรรมชุมนุม</div>
                                                            <span class="badge bg-success w-100 mt-1">ลงทะเบียน</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>

                            <div class="mt-4 d-flex justify-content-between flex-wrap gap-2">
                                <a href="<?= base_url() ?>" class="btn-action-primary">
                                    <i class="bx bx-log-in-circle"></i> ไปที่หน้าเข้าสู่ระบบนักเรียนทันที &rarr;
                                </a>
                                <button class="btn btn-outline-warning text-dark rounded-3 fw-bold px-3 py-2" onclick="switchGuideTab('tab-btn-3')">
                                    ดูขั้นตอนที่ 3: วิธีรีเซ็ตรหัสผ่าน &rarr;
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- TAB 3: ลืมรหัสผ่าน / ขอรีเซ็ตรหัสผ่านใหม่ -->
                    <!-- ========================================== -->
                    <div class="tab-pane fade" id="tab-content-3" role="tabpanel" aria-labelledby="tab-btn-3">
                        <div class="step-card border-warning">
                            <span class="step-badge step-badge-3">
                                <i class="bx bx-key fs-5"></i> ขั้นตอนที่ 3: ลืมรหัสผ่านอีเมลโรงเรียน / รีเซ็ตรหัสผ่านใหม่ (ทำได้ตลอด 24 ชม.)
                            </span>

                            <div class="info-box" style="background: #fffbeb; border-color: #f59e0b; color: #92400e;">
                                <div class="fw-bold mb-1"><i class="bx bx-shield-quarter me-1"></i> ลืมรหัสผ่าน ไม่ต้องไปหาครู! ระบบสามารถรีเซ็ตรหัสผ่านใหม่ให้อัตโนมัติทันที</div>
                                <div class="small">หากน้องจำรหัสผ่านเข้า Gmail ไม่ได้ สามารถทำตาม 3 ขั้นตอนง่าย ๆ ด้านล่างนี้เพื่อขอรหัสผ่านใหม่ได้ทันทีครับ</div>
                            </div>

                            <ol class="step-list">
                                <li>
                                    <span class="step-number">1</span>
                                    เปิดหน้าแรกของระบบนักเรียน แล้วกดที่ข้อความลิงก์ <strong class="text-primary">"ลืม / รีเซ็ตรหัสผ่าน?"</strong> (อยู่ใต้ปุ่มเข้าสู่ระบบ Google)

                                    <!-- UI MOCKUP 6: FORGOT PASSWORD BUTTON PREVIEW -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bx-lock-alt text-success"></i> หน้าแรกระบบนักเรียน
                                            </div>
                                            <span class="badge bg-light text-secondary border small ms-auto">จุดกดลืมรหัสผ่าน</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 440px;">
                                                <div class="p-2 bg-light rounded-3 border mb-2 opacity-50">
                                                    <button class="mock-btn-google py-2" disabled>
                                                        <i class="bx bxl-google text-white fs-5"></i> เข้าสู่ระบบด้วย Google (@skj.ac.th)
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-2 p-2 rounded-3 ui-pulse-target">
                                                    <span class="text-muted" style="font-size: 0.72rem;"><i class="bx bx-info-circle text-primary"></i> บัญชี @skj.ac.th เท่านั้น</span>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="ui-pointer-tag">👉 1. กดตรงนี้</span>
                                                        <span class="text-danger fw-bold small"><i class="bx bx-key"></i> ลืม / รีเซ็ตรหัสผ่าน?</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <span class="step-number">2</span>
                                    จะมีหน้าต่างป๊อปอัปขึ้นมา ให้น้อง <strong>กรอกเลขประจำตัวนักเรียน (5 หลัก)</strong> และ <strong>เลขบัตรประชาชน (13 หลัก)</strong> แล้วกดปุ่ม <strong>"ยืนยันรีเซ็ตรหัสผ่าน"</strong>

                                    <!-- UI MOCKUP 7: RESET PASSWORD POPUP MODAL -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bx-key text-warning"></i> หน้าต่างรีเซ็ตรหัสผ่าน
                                            </div>
                                            <span class="badge bg-warning-subtle text-warning border border-warning small ms-auto">ป๊อปอัปอัตโนมัติ</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 420px;">
                                                <div class="text-center mb-3">
                                                    <div class="fw-bold fs-6 text-dark">🔑 รีเซ็ตรหัสผ่านอีเมลโรงเรียน</div>
                                                </div>

                                                <div class="text-start mb-2">
                                                    <label class="form-label small fw-bold text-muted mb-1">เลขประจำตัวนักเรียน</label>
                                                    <input type="text" class="form-control form-control-sm bg-light" value="12345" readonly style="font-weight: 600;">
                                                </div>

                                                <div class="text-start mb-3">
                                                    <label class="form-label small fw-bold text-muted mb-1">เลขประจำตัวประชาชน (13 หลัก)</label>
                                                    <input type="text" class="form-control form-control-sm bg-light" value="1609900123456" readonly style="font-weight: 600;">
                                                </div>

                                                <div class="position-relative">
                                                    <div class="d-flex justify-content-end mb-1">
                                                        <span class="ui-pointer-tag">👉 2. กดยืนยัน</span>
                                                    </div>
                                                    <button class="mock-btn-google py-2 w-100" style="background: linear-gradient(135deg, #e83e8c 0%, #a81c5d 100%);" disabled>
                                                        ยืนยันรีเซ็ตรหัสผ่าน
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <span class="step-number">3</span>
                                    ระบบจะแสดง <strong>รหัสผ่านใหม่</strong> ทันที ให้น้องกด <strong>"คัดลอกรหัสผ่าน"</strong> แล้วนำไปล็อกอินที่ Gmail เพื่อตั้งรหัสผ่านใหม่ส่วนตัวได้เลยครับ

                                    <!-- UI MOCKUP 8: RESET RESULT & COPY PASSWORD -->
                                    <div class="ui-mockup-window">
                                        <div class="ui-mockup-topbar">
                                            <div class="ui-mockup-dots">
                                                <span class="ui-dot ui-dot-red"></span>
                                                <span class="ui-dot ui-dot-yellow"></span>
                                                <span class="ui-dot ui-dot-green"></span>
                                            </div>
                                            <div class="ui-mockup-url">
                                                <i class="bx bx-check-circle text-success"></i> รีเซ็ตรหัสผ่านสำเร็จ
                                            </div>
                                            <span class="badge bg-success-subtle text-success border border-success small ms-auto">รหัสผ่านใหม่</span>
                                        </div>
                                        <div class="ui-mockup-body">
                                            <div class="bg-white p-3 rounded-4 shadow-sm border mx-auto" style="max-width: 440px;">
                                                <div class="text-center mb-2">
                                                    <span class="badge bg-success p-2 rounded-circle mb-1"><i class="bx bx-check fs-4"></i></span>
                                                    <div class="fw-bold text-success fs-6">รีเซ็ตรหัสผ่านสำเร็จ!</div>
                                                    <div class="text-muted small">ด.ช. สมชาย รักเรียน (อีเมล: skj12345@skj.ac.th)</div>
                                                </div>

                                                <!-- New Password Card -->
                                                <div class="p-2 bg-light border border-warning rounded-3 text-center mb-3">
                                                    <div class="text-muted small">รหัสผ่านใหม่ของคุณ:</div>
                                                    <div class="fw-bold text-danger fs-4 my-1" style="font-family: monospace;">Skj@893214</div>
                                                    <div class="position-relative">
                                                        <button class="btn btn-sm btn-secondary" disabled>
                                                            <i class="bx bx-copy me-1"></i> คัดลอกรหัสผ่าน
                                                        </button>
                                                        <span class="ui-pointer-tag ms-2">👉 3. คัดลอกรหัสไปล็อกอิน</span>
                                                    </div>
                                                </div>

                                                <div class="alert alert-info small text-start p-2 mb-0">
                                                    <i class="bx bx-info-circle me-1"></i> <strong>คำแนะนำ:</strong> นำรหัสผ่านนี้ไปเข้า Gmail แล้วระบบ Google จะให้ตั้งรหัสใหม่ส่วนตัวทันที
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>

                            <div class="mt-4 text-end">
                                <a href="<?= base_url() ?>" class="btn btn-action-primary" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                    <i class="bx bx-key"></i> ไปที่หน้าแรกเพื่อรีเซ็ตรหัสผ่าน &rarr;
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- FAQ SECTION -->
                <div class="mt-4">
                    <h5 class="fw-bold text-dark mb-3">❓ คำถามที่พบบ่อย & วิธีแก้ปัญหา (FAQ)</h5>

                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    🔑 1. ลืมรหัสผ่านอีเมลโรงเรียน ต้องทำอย่างไร?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    หากน้องจำรหัสผ่านไม่ได้ ไม่ต้องตกใจครับ! น้องสามารถไปที่หน้าแรก แล้วกดปุ่ม <strong>"ลืมรหัสผ่าน / ขอรีเซ็ตรหัสผ่านใหม่"</strong> เพื่อกดสุ่มรีเซ็ตรหัสผ่านใหม่ได้เองตลอด 24 ชั่วโมงครับ
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    ⚠️ 2. กดเข้าสู่ระบบด้วย Google แล้วระบบแจ้งเตือนว่าไม่พบข้อมูล?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    ให้ตรวจสอบ 2 จุดนี้ครับ:
                                    <br>1) น้องได้ทำ **ขั้นตอนที่ 1 (ยืนยันตัวตน)** เรียบร้อยแล้วหรือยัง?
                                    <br>2) ในตอนกดเลือกล็อกอินด้วย Google ต้องกดเลือกอีเมลโรงเรียนที่ลงท้ายด้วย <code>@skj.ac.th</code> เท่านั้น (ไม่ใช่อีเมลส่วนตัวที่เป็น `@gmail.com`)
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    📞 3. ติดปัญหาใช้งานไม่ได้ ต้องติดต่อใคร?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    หากทำตามคู่มือแล้วยังพบปัญหา น้อง ๆ หรือผู้ปกครองสามารถทักแชตติดต่อพี่ ๆ ครูงานเทคโนโลยีสารสนเทศ ได้ที่เพจ Facebook โรงเรียน หรือกดปุ่ม <strong>"ติดต่อศูนย์ช่วยเหลือเทคโนโลยีสารสนเทศ"</strong> ด้านล่างนี้ได้เลยครับ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Support Link -->
                <div class="mt-4 pt-3 text-center border-top">
                    <a href="https://m.me/skjnews" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="bx bx-help-circle me-1"></i> ติดต่อศูนย์ช่วยเหลือเทคโนโลยีสารสนเทศ (เพจโรงเรียน)
                    </a>
                </div>

            </div>
        </div>

        <!-- Back to Main Page Link -->
        <div class="text-center mb-4">
            <a href="<?= base_url() ?>" class="back-home-link">
                <i class="bx bx-left-arrow-alt fs-5"></i> กลับสู่หน้าหลักระบบนักเรียน
            </a>
        </div>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchGuideTab(buttonId) {
            const btn = document.getElementById(buttonId);
            if (btn) {
                const tab = new bootstrap.Tab(btn);
                tab.show();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    </script>
</body>

</html>
