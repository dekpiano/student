<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'ยืนยันตัวตนรับอีเมลโรงเรียน' ?> | โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Boxicons & Bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css?v=3') ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
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
            font-family: 'Sarabun', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 25px 15px;
            color: #f8fafc;
            position: relative;
            overflow-x: hidden;
        }

        /* Fixed Background Animation Container */
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

        /* Glowing Orbs */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            opacity: 0.5;
            animation: orbFloat 12s ease-in-out infinite alternate;
        }

        .bg-orb-1 {
            width: 480px;
            height: 480px;
            background: rgba(232, 62, 140, 0.65);
            top: -120px;
            left: -120px;
        }

        .bg-orb-2 {
            width: 520px;
            height: 520px;
            background: rgba(244, 114, 182, 0.5);
            bottom: -150px;
            right: -150px;
            animation-delay: -6s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(45px, 35px) scale(1.1); }
        }

        /* Floating Background Icons */
        .svg-float-bg {
            position: absolute;
            z-index: 1;
            pointer-events: none;
            opacity: 0.15;
            filter: drop-shadow(0 0 15px rgba(232, 62, 140, 0.6));
            animation: svgFloat 8s ease-in-out infinite alternate;
        }

        .svg-cap { top: 10%; left: 8%; width: 130px; animation-duration: 7s; }
        .svg-book { bottom: 10%; left: 10%; width: 110px; animation-duration: 9s; animation-delay: -2s; }
        .svg-cloud { top: 12%; right: 8%; width: 140px; animation-duration: 8.5s; animation-delay: -4s; }
        .svg-badge { bottom: 12%; right: 10%; width: 120px; animation-duration: 10s; animation-delay: -1s; }

        @keyframes svgFloat {
            0% { transform: translateY(0px) rotate(0deg); }
            100% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Glassmorphic Main Card */
        .verify-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 28px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
            color: #0f172a;
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        /* Card Header */
        .verify-header {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            padding: 35px 25px 30px;
            text-align: center;
            color: #ffffff;
            position: relative;
        }

        .logo-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 12px;
        }

        .logo-img {
            width: 85px;
            height: 85px;
            object-fit: contain;
            filter: drop-shadow(0 6px 15px rgba(0,0,0,0.3));
        }

        .badge-step {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            margin-top: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Form Styling */
        .form-body {
            padding: 30px 28px;
        }

        .custom-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            font-size: 0.92rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 1.25rem;
            z-index: 4;
            transition: color 0.2s;
        }

        .input-group-custom .form-control {
            padding-left: 48px;
            padding-right: 48px;
            height: 52px;
            border-radius: 16px;
            border: 1.5px solid #cbd5e1;
            font-size: 1rem;
            background: #f8fafc;
            color: #0f172a;
            transition: all 0.25s ease;
        }

        .input-group-custom .form-control:focus {
            background: #ffffff;
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 4px rgba(232, 62, 140, 0.15);
        }

        .input-group-custom .form-control:focus + .input-icon,
        .input-group-custom:focus-within .input-icon {
            color: var(--primary-pink);
        }

        .btn-toggle-eye {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 1.25rem;
            padding: 8px;
            cursor: pointer;
            z-index: 4;
            transition: color 0.2s;
        }

        .btn-toggle-eye:hover {
            color: #334155;
        }

        .btn-submit-verify {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            height: 54px;
            border-radius: 16px;
            font-size: 1.05rem;
            font-weight: 700;
            width: 100%;
            box-shadow: 0 8px 24px rgba(232, 62, 140, 0.4);
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(232, 62, 140, 0.5);
            color: white;
        }

        .btn-submit-verify:active {
            transform: translateY(0);
        }

        /* Result Section */
        .result-box {
            display: none;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            padding: 24px 20px;
            margin-top: 24px;
            text-align: center;
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .email-display-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px;
            margin: 14px 0;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
        }

        .email-address {
            font-family: 'Outfit', monospace, sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-dark);
            word-break: break-all;
        }

        .btn-copy-custom {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
            padding: 7px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-copy-custom:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }

        .btn-google-login {
            background-color: #ffffff;
            color: #3c4043;
            border: 1px solid #dadce0;
            border-radius: 14px;
            padding: 13px 20px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .btn-google-login:hover {
            background-color: #f8f9fa;
            border-color: #d2e3fc;
            color: #202124;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .back-home-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 20px;
            position: relative;
            z-index: 2;
            transition: color 0.2s;
            padding: 8px 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
        }

        .back-home-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.15);
        }

        @media (max-width: 768px) {
            .svg-float-bg { display: none; }
        }
    </style>
</head>
<body>

    <!-- Fixed Animation Container -->
    <div class="bg-animation-container">
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>

        <!-- Floating SVG Icons -->
        <svg class="svg-float-bg svg-cap" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
        <svg class="svg-float-bg svg-book" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
        </svg>
        <svg class="svg-float-bg svg-cloud" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/>
        </svg>
        <svg class="svg-float-bg svg-badge" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path d="m9 12 2 2 4-4"/>
        </svg>
    </div>

    <div class="d-flex flex-column align-items-center w-100">
        <div class="verify-card">
            <!-- Header -->
            <div class="verify-header">
                <div class="logo-wrapper">
                    <img src="<?= base_url('uploads/LogoSchool/LogoSKJ_4.png') ?>" alt="SKJ Logo" class="logo-img">
                </div>
                <h4 class="fw-bold mb-1 text-white">ระบบยืนยันตัวตนรับอีเมลโรงเรียน</h4>
                <p class="mb-0 text-white-50 small">โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</p>
                <div class="badge-step">
                    <i class="bx bx-shield-quarter"></i> ยืนยันสิทธิ์รับบัญชี Google Workspace (@skj.ac.th)
                </div>
            </div>

            <!-- Form -->
            <div class="form-body">
                <form id="verifyForm">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="student_code" class="custom-label">
                            <i class="bx bx-id-card text-primary"></i> เลขประจำตัวนักเรียน
                        </label>
                        <div class="input-group-custom">
                            <i class="bx bx-id-card input-icon"></i>
                            <input type="text" class="form-control" id="student_code" name="student_code" placeholder="กรอกเลขประจำตัวนักเรียน (เช่น 12345)" required autocomplete="off">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="id_card" class="custom-label">
                            <i class="bx bx-credit-card-front text-primary"></i> เลขประจำตัวประชาชน (13 หลัก)
                        </label>
                        <div class="input-group-custom">
                            <i class="bx bx-lock-alt input-icon"></i>
                            <input type="password" class="form-control" id="id_card" name="id_card" maxlength="13" placeholder="ระบุเลขบัตรประชาชน 13 หลัก" required autocomplete="off">
                            <button type="button" class="btn-toggle-eye" id="togglePassword" title="แสดง/ซ่อนรหัส">
                                <i class="bx bx-show" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-submit-verify" id="btnSubmit">
                        <i class="bx bx-search-alt fs-5"></i> ตรวจสอบและรับอีเมลโรงเรียน
                    </button>
                </form>

                <!-- Result Box -->
                <div class="result-box" id="resultBox">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle p-2 mb-2" style="width: 46px; height: 46px;">
                        <i class="bx bx-check fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-success mb-1" id="resStatusText">ยืนยันตัวตนสำเร็จ!</h5>
                    <p class="text-muted small mb-3">ข้อมูลบัญชีอีเมลสำหรับใช้งาน Google Workspace</p>

                    <div class="text-start bg-white p-3 rounded-3 mb-3 border">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">ชื่อ-นามสกุล:</span>
                            <strong id="resName" class="text-dark">-</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">รหัสนักเรียน:</span>
                            <strong id="resCode" class="text-dark">-</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">ระดับชั้น:</span>
                            <strong id="resClass" class="text-dark">-</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">จำนวนครั้งที่รีเซ็ตรหัสผ่าน:</span>
                            <span class="badge bg-secondary" id="resResetCount">0 ครั้ง</span>
                        </div>
                    </div>

                    <div class="email-display-card">
                        <div class="text-muted small mb-1">อีเมลโรงเรียนของคุณ:</div>
                        <div class="email-address mb-2" id="resEmail">skjxxxxx@skj.ac.th</div>
                        <button class="btn btn-copy-custom me-2" type="button" id="btnCopyEmail">
                            <i class="bx bx-copy"></i> คัดลอกอีเมล
                        </button>
                    </div>

                    <div class="email-display-card bg-light border-warning" id="passwordCard">
                        <div class="text-muted small mb-1">รหัสผ่านเริ่มต้นสำหรับเข้าใช้งาน:</div>
                        <div class="email-address text-dark mb-2" id="resPassword">xxxxxx</div>
                        <button class="btn btn-copy-custom" type="button" id="btnCopyPassword">
                            <i class="bx bx-key"></i> คัดลอกรหัสผ่าน
                        </button>
                    </div>

                    <div id="googleStatusBadge" class="mb-3"></div>

                    <div class="alert alert-info text-start small mb-3" id="alertNotice" role="alert">
                        <i class="bx bx-info-circle me-1"></i>
                        <strong>คำแนะนำการเปิดใช้งานครั้งแรก:</strong><br>
                        นำอีเมลและรหัสผ่านไปล็อกอินใน <strong>Gmail</strong> เมื่อเข้าสู่ระบบครั้งแรก ระบบ Google จะบังคับให้ <strong>ตั้งรหัสผ่านใหม่ส่วนตัว</strong> ทันทีเพื่อความปลอดภัย
                    </div>

                    <a href="https://accounts.google.com/ServiceLogin?continue=https://mail.google.com" target="_blank" class="btn btn-google-login">
                        <svg width="18" height="18" viewBox="0 0 18 18">
                            <path fill="#4285F4" d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l-.01.12 2.67 2.07.18.02c1.7-1.57 2.68-3.88 2.68-6.63z"/>
                            <path fill="#34A853" d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.41-1.57-5.13-3.72l-.11.01-2.78 2.15-.04.1C2.46 15.99 5.48 18 9 18z"/>
                            <path fill="#FBBC05" d="M3.87 10.8c-.2-.59-.31-1.22-.31-1.8s.11-1.21.31-1.8l-.01-.13-2.79-2.17-.09.04C.35 6.13 0 7.52 0 9s.35 2.87.98 4.09l2.89-2.29z"/>
                            <path fill="#EA4335" d="M9 3.58c1.32 0 2.5.45 3.44 1.35l2.58-2.58C13.46.89 11.43 0 9 0 5.48 0 2.46 2.01.98 4.91l2.89 2.29c.72-2.15 2.75-3.62 5.13-3.62z"/>
                        </svg>
                        เข้าสู่ระบบ Gmail (@skj.ac.th)
                    </a>
                </div>
            </div>
        </div>

        <a href="<?= base_url() ?>" class="back-home-btn">
            <i class="bx bx-left-arrow-alt fs-5"></i> กลับสู่หน้าหลักระบบนักเรียน
        </a>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const idCardInput = document.getElementById('id_card');
            const icon = document.getElementById('toggleIcon');
            if (idCardInput.type === 'password') {
                idCardInput.type = 'text';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            } else {
                idCardInput.type = 'password';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            }
        });

        document.getElementById('verifyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btnSubmit = document.getElementById('btnSubmit');
            const originalBtnHtml = btnSubmit.innerHTML;
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> กำลังตรวจสอบ...';

            const formData = new FormData(this);

            fetch('<?= base_url('verify-email/check') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(res => {
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = originalBtnHtml;

                if (res.status === 1) {
                    document.getElementById('resName').textContent = res.data.student_name;
                    document.getElementById('resCode').textContent = res.data.student_code;
                    document.getElementById('resClass').textContent = res.data.student_class;
                    document.getElementById('resEmail').textContent = res.data.email;
                    document.getElementById('resResetCount').textContent = (res.data.reset_count || 0) + ' ครั้ง';

                    const passCard = document.getElementById('passwordCard');
                    const alertNotice = document.getElementById('alertNotice');

                    if (res.data.is_new && res.data.email_password) {
                        document.getElementById('resStatusText').textContent = 'สร้างและออกอีเมลโรงเรียนสำเร็จ!';
                        document.getElementById('resPassword').textContent = res.data.email_password;
                        passCard.style.display = 'block';
                        alertNotice.className = 'alert alert-info text-start small mb-3';
                        alertNotice.innerHTML = '<i class="bx bx-info-circle me-1"></i><strong>คำแนะนำการเปิดใช้งานครั้งแรก:</strong><br>นำอีเมลและรหัสผ่านไปล็อกอินใน <strong>Gmail</strong> เมื่อเข้าสู่ระบบครั้งแรก ระบบ Google จะบังคับให้ <strong>ตั้งรหัสผ่านใหม่ส่วนตัว</strong> ทันที';
                    } else {
                        document.getElementById('resStatusText').textContent = 'คุณเคยทำการยืนยันรับอีเมลโรงเรียนแล้ว!';
                        passCard.style.display = 'none';
                        alertNotice.className = 'alert alert-warning text-start small mb-3 border-warning';
                        alertNotice.innerHTML = '<i class="bx bx-check-circle me-1"></i><strong>ยืนยันรับอีเมลสำเร็จแล้ว:</strong><br>ใช้อีเมลนี้เข้าสู่ระบบผ่าน Google Account ที่หน้าแรกได้ทันที (หากจำรหัสผ่านไม่ได้ สามารถใช้ปุ่ม <strong>"รีเซ็ตรหัสผ่าน"</strong> ที่หน้าหลักได้)';
                    }

                    const badgeContainer = document.getElementById('googleStatusBadge');
                    if (res.data.google_status) {
                        if (res.data.google_status.success) {
                            badgeContainer.innerHTML = '<span class="badge bg-success px-3 py-2 fs-6"><i class="bx bxl-google me-1"></i> เชื่อมต่อ Google Workspace แล้ว</span>';
                        } else {
                            badgeContainer.innerHTML = '<span class="badge bg-warning text-dark px-3 py-2 fs-6" title="' + (res.data.google_status.message || '') + '"><i class="bx bx-info-circle me-1"></i> ระบบออกอีเมลในฐานข้อมูลแล้ว</span>';
                        }
                    } else {
                        badgeContainer.innerHTML = '';
                    }

                    document.getElementById('resultBox').style.display = 'block';
                    document.getElementById('resultBox').scrollIntoView({ behavior: 'smooth' });

                    Swal.fire({
                        icon: res.data.is_new ? 'success' : 'info',
                        title: res.data.is_new ? 'สร้างอีเมลเรียบร้อย!' : 'คุณเคยยืนยันอีเมลแล้ว',
                        text: res.data.is_new ? ('อีเมลของคุณคือ ' + res.data.email) : 'สามารถใช้อีเมลนี้ล็อกอินด้วย Google ที่หน้าแรกได้ทันที',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#e83e8c'
                    });
                } else {
                    document.getElementById('resultBox').style.display = 'none';
                    Swal.fire({
                        icon: 'error',
                        title: 'ตรวจสอบไม่สำเร็จ',
                        text: res.message || 'ข้อมูลไม่ถูกต้อง',
                        confirmButtonText: 'ลองอีกครั้ง',
                        confirmButtonColor: '#e83e8c'
                    });
                }
            })
            .catch(err => {
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = originalBtnHtml;
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ กรุณาลองใหม่อีกครั้ง',
                    confirmButtonColor: '#e83e8c'
                });
            });
        });

        document.getElementById('btnCopyEmail').addEventListener('click', function() {
            const emailText = document.getElementById('resEmail').textContent;
            navigator.clipboard.writeText(emailText).then(() => {
                const btn = this;
                const origText = btn.innerHTML;
                btn.innerHTML = '<i class="bx bx-check"></i> คัดลอกแล้ว!';
                btn.classList.replace('btn-copy-custom', 'btn-success');
                setTimeout(() => {
                    btn.innerHTML = origText;
                    btn.classList.replace('btn-success', 'btn-copy-custom');
                }, 2000);
            });
        });

        document.getElementById('btnCopyPassword').addEventListener('click', function() {
            const passText = document.getElementById('resPassword').textContent;
            navigator.clipboard.writeText(passText).then(() => {
                const btn = this;
                const origText = btn.innerHTML;
                btn.innerHTML = '<i class="bx bx-check"></i> คัดลอกรหัสแล้ว!';
                btn.classList.replace('btn-copy-custom', 'btn-success');
                setTimeout(() => {
                    btn.innerHTML = origText;
                    btn.classList.replace('btn-success', 'btn-copy-custom');
                }, 2000);
            });
        });
    </script>
</body>
</html>
