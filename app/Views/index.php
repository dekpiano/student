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
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Sarabun:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet" />

    <!-- Icons & Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css?v=3') ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Google Identity Services Library -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <style>
        :root {
            --primary-rose: #f43f5e;
            --primary-rose-dark: #be123c;
            --primary-rose-light: #fda4af;
            --accent-cyan: #06b6d4;
            --accent-blue: #0284c7;
            --accent-purple: #8b5cf6;
            --dark-surface: #0f172a;
            --glass-bg: rgba(255, 255, 255, 0.94);
            --glass-border: rgba(255, 255, 255, 0.65);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
            min-height: 100vh;
        }

        body {
            font-family: 'Sarabun', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #09020e;
            background-image: 
                radial-gradient(at 0% 0%, rgba(244, 63, 94, 0.35) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(6, 182, 212, 0.3) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(139, 92, 246, 0.35) 0px, transparent 50%),
                linear-gradient(135deg, #130319 0%, #260528 50%, #0d0b24 100%);
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: clamp(12px, 3vw, 32px);
            color: #1e293b;
            position: relative;
        }

        /* Ambient Dynamic Glow Orbs */
        .ambient-glow-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(95px);
            opacity: 0.6;
            animation: orbFloat 14s ease-in-out infinite alternate;
        }

        .glow-orb-1 {
            width: clamp(320px, 45vw, 650px);
            height: clamp(320px, 45vw, 650px);
            background: radial-gradient(circle, rgba(244, 63, 94, 0.75) 0%, rgba(225, 29, 72, 0.2) 70%);
            top: -120px;
            left: -120px;
        }

        .glow-orb-2 {
            width: clamp(340px, 48vw, 680px);
            height: clamp(340px, 48vw, 680px);
            background: radial-gradient(circle, rgba(6, 182, 212, 0.65) 0%, rgba(2, 132, 199, 0.2) 70%);
            bottom: -150px;
            right: -140px;
            animation-delay: -7s;
        }

        .glow-orb-3 {
            width: clamp(220px, 32vw, 420px);
            height: clamp(220px, 32vw, 420px);
            background: radial-gradient(circle, rgba(168, 85, 247, 0.55) 0%, rgba(139, 92, 246, 0.1) 70%);
            top: 45%;
            left: 55%;
            transform: translate(-50%, -50%);
            animation-duration: 20s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(45px, 35px) scale(1.18); }
        }

        /* Subtle Geometric Background Pattern */
        .bg-grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            pointer-events: none;
            z-index: 1;
        }

        /* Main Modern Container */
        .main-auth-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1060px;
            animation: modernEnter 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes modernEnter {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Modern Glassmorphic Split Card */
        .modern-split-card {
            background: var(--glass-bg);
            backdrop-filter: blur(32px);
            -webkit-backdrop-filter: blur(32px);
            border: 1px solid var(--glass-border);
            border-radius: clamp(24px, 3.5vw, 36px);
            box-shadow: 
                0 30px 80px -15px rgba(0, 0, 0, 0.65),
                0 0 50px rgba(244, 63, 94, 0.22),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            overflow: hidden;
            position: relative;
        }

        /* LEFT / TOP PANEL: Guide & Brand */
        .panel-guide {
            background: linear-gradient(165deg, rgba(255, 255, 255, 0.98) 0%, rgba(254, 242, 248, 0.92) 50%, rgba(240, 249, 255, 0.92) 100%);
            padding: clamp(20px, 3.2vw, 36px);
            border-right: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        /* Brand Row */
        .brand-header-row {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .brand-avatar-box {
            position: relative;
            flex-shrink: 0;
        }

        .brand-avatar-logo {
            width: clamp(52px, 6.5vw, 68px);
            height: clamp(52px, 6.5vw, 68px);
            object-fit: contain;
            filter: drop-shadow(0 6px 14px rgba(244, 63, 94, 0.35));
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .brand-avatar-logo:hover {
            transform: scale(1.1) rotate(4deg);
        }

        .portal-tag-badge {
            font-family: 'Outfit', sans-serif;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary-rose);
            background: rgba(244, 63, 94, 0.1);
            padding: 2px 8px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 2px;
        }

        .brand-system-name {
            font-family: 'Outfit', 'Sarabun', sans-serif;
            font-size: clamp(1.2rem, 2vw, 1.45rem);
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            margin: 0;
            background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-school-name {
            font-size: clamp(0.78rem, 1.1vw, 0.86rem);
            color: #64748b;
            margin-top: 2px;
            line-height: 1.35;
            font-weight: 500;
        }

        /* Live Status Pill */
        .system-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #475569;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            margin-bottom: 14px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 8px #10b981;
            animation: pulseDot 2s infinite;
        }

        @keyframes pulseDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        /* Compact Modern Guide Tiles */
        .guide-tiles-wrap {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .guide-tile {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            position: relative;
            overflow: hidden;
        }

        .guide-tile:hover {
            transform: translateY(-2px) translateX(2px);
            border-color: #cbd5e1;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .tile-icon-bubble {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
            color: #ffffff;
        }

        .icon-grad-rose { background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%); box-shadow: 0 3px 10px rgba(244, 63, 94, 0.35); }
        .icon-grad-cyan { background: linear-gradient(135deg, #06b6d4 0%, #0284c7 100%); box-shadow: 0 3px 10px rgba(6, 182, 212, 0.35); }
        .icon-grad-amber { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); box-shadow: 0 3px 10px rgba(245, 158, 11, 0.35); }
        .icon-grad-emerald { background: linear-gradient(135deg, #10b981 0%, #047857 100%); box-shadow: 0 3px 10px rgba(16, 185, 129, 0.35); }

        .tile-body {
            flex: 1;
            min-width: 0;
        }

        .tile-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            margin-bottom: 2px;
        }

        .tile-title {
            font-weight: 700;
            font-size: 0.86rem;
            color: #0f172a;
        }

        .tile-tag {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 4px;
            letter-spacing: 0.2px;
        }

        .tag-pink { background: #ffe4e6; color: #be123c; }
        .tag-blue { background: #e0f2fe; color: #0369a1; }
        .tag-amber { background: #fef3c7; color: #b45309; }
        .tag-green { background: #dcfce7; color: #15803d; }

        .tile-desc {
            font-size: 0.81rem;
            color: #475569;
            margin: 0;
            line-height: 1.35;
        }

        /* Guide Bottom Action Pills */
        .guide-footer-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-glass-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.22s ease;
            flex: 1 1 auto;
            justify-content: center;
            white-space: nowrap;
        }

        .btn-glass-rose {
            background: #ffffff;
            color: var(--primary-rose-dark);
            border: 1.5px solid #fecdd3;
            box-shadow: 0 2px 8px rgba(244, 63, 94, 0.08);
        }

        .btn-glass-rose:hover {
            background: #fff1f2;
            color: var(--primary-rose);
            border-color: var(--primary-rose);
            transform: translateY(-2px);
        }

        .btn-glass-cyan {
            background: #ffffff;
            color: #0369a1;
            border: 1.5px solid #bae6fd;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.08);
        }

        .btn-glass-cyan:hover {
            background: #f0f9ff;
            color: var(--accent-blue);
            border-color: var(--accent-blue);
            transform: translateY(-2px);
        }

        /* RIGHT / BOTTOM PANEL: Login & Services */
        .panel-login {
            background: #ffffff;
            padding: clamp(22px, 3.8vw, 40px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 30px;
            background: linear-gradient(135deg, rgba(244, 63, 94, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
            color: var(--primary-rose-dark);
            font-weight: 700;
            font-size: 0.78rem;
            width: fit-content;
            margin-bottom: 8px;
        }

        .login-hero-title {
            font-family: 'Outfit', 'Sarabun', sans-serif;
            font-size: clamp(1.4rem, 2.3vw, 1.8rem);
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
            letter-spacing: -0.3px;
        }

        .login-hero-subtitle {
            font-size: 0.88rem;
            color: #64748b;
            margin-bottom: 20px;
        }

        /* Ultra Modern Hero Google Login Button */
        .btn-hero-google {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 50%, #be123c 100%);
            color: #ffffff;
            border: none;
            border-radius: 18px;
            padding: 15px 22px;
            font-size: clamp(0.98rem, 2vw, 1.08rem);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            width: 100%;
            min-height: 56px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 28px rgba(244, 63, 94, 0.42), 0 0 1px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-hero-google::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.28), transparent);
            transition: left 0.7s ease;
        }

        .btn-hero-google:hover::before {
            left: 100%;
        }

        .btn-hero-google:hover {
            background: linear-gradient(135deg, #fb7185 0%, #f43f5e 50%, #e11d48 100%);
            color: #ffffff;
            box-shadow: 0 14px 36px rgba(244, 63, 94, 0.55);
            transform: translateY(-2px) scale(1.01);
        }

        .btn-hero-google:active {
            transform: translateY(0) scale(0.99);
        }

        .google-circle-icon {
            background: #ffffff;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.16);
            flex-shrink: 0;
        }

        .domain-tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            padding: 3px 12px;
            font-size: 0.76rem;
            color: #64748b;
        }

        /* Modern Sleek Divider */
        .modern-section-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: #94a3b8;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modern-section-divider::before,
        .modern-section-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #edf2f7;
        }

        .modern-section-divider:not(:empty)::before { margin-right: 1em; }
        .modern-section-divider:not(:empty)::after { margin-left: 1em; }

        /* Modern Quick Action Cards */
        .service-action-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 12px 14px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .service-action-card:hover {
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .card-cyan-glow {
            background: linear-gradient(135deg, #ffffff 0%, #ecfeff 100%);
            border-color: #cffafe;
        }

        .card-cyan-glow:hover {
            border-color: #38bdf8;
            box-shadow: 0 8px 22px rgba(6, 182, 212, 0.15);
        }

        .card-purple-glow {
            background: linear-gradient(135deg, #ffffff 0%, #faf5ff 100%);
            border-color: #f3e8ff;
        }

        .card-purple-glow:hover {
            border-color: #c084fc;
            box-shadow: 0 8px 22px rgba(168, 85, 247, 0.15);
        }

        .btn-modern-pill {
            padding: 8px 15px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.22s ease;
            border: none;
            cursor: pointer;
        }

        .btn-pill-cyan {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.32);
        }

        .btn-pill-cyan:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.48);
        }

        .btn-pill-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.32);
        }

        .btn-pill-purple:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(139, 92, 246, 0.48);
        }

        /* Help Center Footer */
        .login-help-footer {
            margin-top: 14px;
            text-align: center;
        }

        .help-link-modern {
            color: #64748b;
            font-size: 0.82rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            transition: all 0.2s ease;
            padding: 4px 10px;
            border-radius: 8px;
        }

        .help-link-modern:hover {
            color: var(--primary-rose);
            background: rgba(244, 63, 94, 0.08);
        }

        /* Modal Feature Cards */
        .modal-feature-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .modal-feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        }

        .modal-feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            border-radius: 4px 0 0 4px;
        }

        .card-accent-purple::before { background: linear-gradient(180deg, #a855f7, #6b21a8); }
        .card-accent-blue::before { background: linear-gradient(180deg, #3b82f6, #1d4ed8); }
        .card-accent-emerald::before { background: linear-gradient(180deg, #10b981, #047857); }
        .card-accent-amber::before { background: linear-gradient(180deg, #f59e0b, #b45309); }

        .feature-icon-badge {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
            color: #ffffff;
        }

        .badge-purple { background: linear-gradient(135deg, #a855f7, #7e22ce); }
        .badge-blue { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .badge-emerald { background: linear-gradient(135deg, #10b981, #047857); }
        .badge-amber { background: linear-gradient(135deg, #f59e0b, #b45309); }

        .btn-modal-close {
            background: linear-gradient(135deg, var(--primary-rose) 0%, var(--primary-rose-dark) 100%);
            color: #ffffff !important;
            border: none;
            border-radius: 12px;
            padding: 10px 24px;
            font-size: 0.92rem;
            font-weight: 700;
            box-shadow: 0 6px 18px rgba(244, 63, 94, 0.4);
            transition: all 0.25s ease;
        }

        .btn-modal-close:hover {
            background: linear-gradient(135deg, #fb7185 0%, var(--primary-rose) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(244, 63, 94, 0.55);
        }

        /* Responsive Breakpoints */
        @media (max-width: 991.98px) {
            .panel-guide {
                border-right: none;
                border-bottom: 1.5px solid #f1f5f9;
                padding: 18px 16px;
            }

            .panel-login {
                padding: 22px 16px;
            }

            .guide-tiles-wrap {
                gap: 6px;
            }

            .guide-tile {
                padding: 8px 12px;
            }
        }

        @media (max-width: 575.98px) {
            body {
                padding: 8px;
            }

            .service-action-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .btn-modern-pill {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <!-- Ambient Dynamic Background -->
    <div class="ambient-glow-container">
        <div class="glow-orb glow-orb-1"></div>
        <div class="glow-orb glow-orb-2"></div>
        <div class="glow-orb glow-orb-3"></div>
    </div>
    <div class="bg-grid-overlay"></div>

    <!-- Main Container -->
    <div class="main-auth-container">
        <div class="modern-split-card">
            <div class="row g-0">

                <!-- SIDE 1: คำแนะนำเบื้องต้นในการเข้าสู่ระบบ (Desktop: Left, Mobile: TOP) -->
                <div class="col-lg-6 panel-guide">
                    <div>
                        <!-- Brand Area -->
                        <div class="brand-header-row">
                            <div class="brand-avatar-box">
                                <img src="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" alt="SKJ Logo" class="brand-avatar-logo" />
                            </div>
                            <div>
                                <span class="portal-tag-badge">SKJ Student Portal</span>
                                <h1 class="brand-system-name">ระบบงานนักเรียน</h1>
                                <div class="brand-school-name">โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</div>
                            </div>
                        </div>

                        <!-- System Status -->
                        <div class="system-status-pill">
                            <span class="status-dot"></span>
                            <span>คำแนะนำ & ขั้นตอนการเข้าสู่ระบบ</span>
                        </div>

                        <!-- 4 Compact Glass Guide Tiles -->
                        <div class="guide-tiles-wrap">
                            <!-- Tile 1: Existing Google Account -->
                            <div class="guide-tile">
                                <div class="tile-icon-bubble icon-grad-rose">
                                    <i class="bx bxl-google"></i>
                                </div>
                                <div class="tile-body">
                                    <div class="tile-heading">
                                        <span class="tile-title">1. นักเรียนที่มีอีเมลแล้ว</span>
                                        <span class="tile-tag tag-pink">เข้าได้ทันที</span>
                                    </div>
                                    <p class="tile-desc">
                                        คลิกปุ่ม <strong>"Google Sign-In"</strong> ด้วยบัญชี <code>@skj.ac.th</code> ของตนเอง
                                    </p>
                                </div>
                            </div>

                            <!-- Tile 2: New Student Email Request -->
                            <div class="guide-tile">
                                <div class="tile-icon-bubble icon-grad-cyan">
                                    <i class="bx bx-user-plus"></i>
                                </div>
                                <div class="tile-body">
                                    <div class="tile-heading">
                                        <span class="tile-title">2. นักเรียนใหม่ / เข้าครั้งแรก</span>
                                        <span class="tile-tag tag-blue">ขอรับอีเมล</span>
                                    </div>
                                    <p class="tile-desc">
                                        กดยืนยันตัวตนด้วย <strong>เลขประจำตัว + เลขบัตร ปชช.</strong> เพื่อออกอีเมล
                                    </p>
                                </div>
                            </div>

                            <!-- Tile 3: Forgot Password -->
                            <div class="guide-tile">
                                <div class="tile-icon-bubble icon-grad-amber">
                                    <i class="bx bx-key"></i>
                                </div>
                                <div class="tile-body">
                                    <div class="tile-heading">
                                        <span class="tile-title">3. ลืมรหัสผ่าน</span>
                                        <span class="tile-tag tag-amber">รีเซ็ต 24 ชม.</span>
                                    </div>
                                    <p class="tile-desc">
                                        กด <strong>"รีเซ็ตรหัสผ่าน"</strong> รับรหัสชั่วคราวและนำไปตั้งรหัสใหม่ใน Gmail
                                    </p>
                                </div>
                            </div>

                            <!-- Tile 4: Domain Rule -->
                            <div class="guide-tile">
                                <div class="tile-icon-bubble icon-grad-emerald">
                                    <i class="bx bx-shield-quarter"></i>
                                </div>
                                <div class="tile-body">
                                    <div class="tile-heading">
                                        <span class="tile-title">4. ความปลอดภัย</span>
                                        <span class="tile-tag tag-green">เฉพาะ @skj.ac.th</span>
                                    </div>
                                    <p class="tile-desc">
                                        ระบบไม่อนุญาตให้อีเมลส่วนตัวภายนอก (เช่น @gmail.com) เข้าใช้งาน
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Helpful Guide Quick Buttons -->
                    <div class="guide-footer-actions">
                        <a href="<?= base_url('guide') ?>" class="btn-glass-action btn-glass-rose">
                            <i class="bx bx-book-open fs-5"></i>
                            <span>คู่มือการใช้งานระบบ</span>
                        </a>
                        <button type="button" class="btn-glass-action btn-glass-cyan" data-bs-toggle="modal" data-bs-target="#modalWhyGoogle">
                            <i class="bx bx-info-circle fs-5"></i>
                            <span>ทำไมต้อง @skj.ac.th?</span>
                        </button>
                    </div>
                </div>

                <!-- SIDE 2: หน้าต่างและปุ่มเข้าสู่ระบบ (Desktop: Right, Mobile: Bottom) -->
                <div class="col-lg-6 panel-login">
                    <div>
                        <!-- Login Header -->
                        <div class="login-badge-pill">
                            <i class="bx bx-lock-alt"></i> Google Secure Authentication
                        </div>
                        <h2 class="login-hero-title">เข้าสู่ระบบ</h2>
                        <p class="login-subtitle">
                            เลือกเข้าสู่ระบบด้วยบัญชี Google ของโรงเรียน (@skj.ac.th)
                        </p>

                        <!-- Main Google Login Button -->
                        <button type="button" class="btn-hero-google" id="btnGoogleCustomLogin">
                            <span class="google-circle-icon">
                                <svg width="19" height="19" viewBox="0 0 18 18">
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
                            <span>เข้าสู่ระบบด้วย Google (@skj.ac.th)</span>
                        </button>

                        <div class="text-center mt-2 mb-2">
                            <span class="domain-tag-pill">
                                <i class="bx bx-check-shield text-success"></i> รองรับเฉพาะบัญชี <code>@skj.ac.th</code>
                            </span>
                        </div>

                        <!-- Divider for other services -->
                        <div class="modern-section-divider">บริการเสริมสำหรับนักเรียน</div>

                        <!-- Service 1: Register / First time verify -->
                        <div class="service-action-card card-cyan-glow">
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-white p-2 rounded-circle text-primary shadow-sm d-inline-flex">
                                    <i class="bx bx-user-plus fs-4"></i>
                                </span>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 0.88rem;">ยังไม่มีอีเมล / นักเรียนใหม่?</div>
                                    <div class="text-muted" style="font-size: 0.78rem;">ยืนยันตัวตนเพื่อขอรับอีเมลโรงเรียน</div>
                                </div>
                            </div>
                            <a href="<?= base_url('verify-email') ?>" class="btn-modern-pill btn-pill-cyan">
                                <span>ยืนยันตัวตน</span>
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>

                        <!-- Service 2: Reset Password -->
                        <div class="service-action-card card-purple-glow">
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-white p-2 rounded-circle shadow-sm d-inline-flex" style="color: #8b5cf6;">
                                    <i class="bx bx-key fs-4"></i>
                                </span>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 0.88rem;">ลืมรหัสผ่านอีเมลโรงเรียน?</div>
                                    <div class="text-muted" style="font-size: 0.78rem;">ขอรหัสผ่านชั่วคราวและรีเซ็ตใหม่</div>
                                </div>
                            </div>
                            <button type="button" id="btnHomeResetPassword" class="btn-modern-pill btn-pill-purple">
                                <span>รีเซ็ตรหัสผ่าน</span>
                                <i class="bx bx-refresh"></i>
                            </button>
                        </div>

                        <!-- Help / Support Footer -->
                        <div class="login-help-footer">
                            <a href="https://m.me/skjnews" target="_blank" class="help-link-modern">
                                <i class="bx bxl-messenger text-primary fs-5"></i>
                                <span>พบปัญหาการเข้าสู่ระบบ? ติดต่อศูนย์เทคโนโลยีสารสนเทศ</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal: ทำไมต้องเข้าสู่ระบบด้วย Google -->
    <div class="modal fade" id="modalWhyGoogle" tabindex="-1" aria-labelledby="modalWhyGoogleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header text-white p-3 p-md-4"
                    style="background: linear-gradient(135deg, var(--primary-rose) 0%, var(--primary-rose-dark) 100%);">
                    <div class="d-flex align-items-center gap-2 gap-md-3">
                        <span
                            class="p-2 bg-white bg-opacity-20 rounded-circle text-white d-flex align-items-center justify-content-center">
                            <i class="bx bx-bulb fs-4"></i>
                        </span>
                        <h5 class="modal-title text-white fw-bold mb-0" id="modalWhyGoogleLabel"
                            style="font-size: 1.15rem;">
                            ทำไมต้องเข้าสู่ระบบด้วย Google (@skj.ac.th)?
                        </h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body p-3 p-md-4 text-dark" style="background: #f8fafc;">
                    <p class="text-dark mb-3 fs-6 fw-normal bg-white p-3 rounded-3 border shadow-sm">
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
                                                    confirmButtonColor: '#f43f5e'
                                                });
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'ไม่พบอีเมล',
                                            text: 'ไม่สามารถดึงข้อมูลอีเมลจาก Google ได้ กรุณาลองใหม่',
                                            confirmButtonColor: '#f43f5e'
                                        });
                                    }
                                })
                                .catch(function () {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'ไม่สามารถเชื่อมต่อกับ Google ได้',
                                        confirmButtonColor: '#f43f5e'
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
                confirmButtonColor: '#f43f5e',
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
                confirmButtonColor: '#f43f5e',
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
                                confirmButtonColor: '#f43f5e'
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
                confirmButtonColor: '#f43f5e',
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
                                    confirmButtonColor: '#f43f5e'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'รีเซ็ตไม่สำเร็จ',
                                    text: res.message || 'ข้อมูลไม่ถูกต้อง',
                                    confirmButtonColor: '#f43f5e'
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
                                confirmButtonColor: '#f43f5e'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>