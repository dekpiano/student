<!DOCTYPE html>
<html lang="th" class="light-style customizer-hide" dir="ltr">

<head>
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
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.97);
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
            padding: clamp(28px, 6vw, 42px) clamp(20px, 4vw, 32px);
            text-align: center;
            color: #ffffff;
            position: relative;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .brand-logo {
            width: clamp(75px, 16vw, 95px);
            height: clamp(75px, 16vw, 95px);
            object-fit: contain;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.3));
            margin-bottom: 12px;
        }

        .guide-body {
            padding: clamp(24px, 5vw, 40px) clamp(18px, 4vw, 36px);
        }

        /* Step Card Styling */
        .step-card {
            background: #ffffff;
            border-radius: 22px;
            border: 1.5px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
            padding: clamp(20px, 4vw, 30px);
            margin-bottom: 28px;
            position: relative;
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-light);
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

        .step-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .step-list li {
            position: relative;
            padding-left: 36px;
            margin-bottom: 16px;
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
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #f1f5f9;
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--primary-light);
        }

        .info-box {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-left: 4px solid #3b82f6;
            border-radius: 14px;
            padding: 16px clamp(14px, 3vw, 20px);
            margin: 16px 0;
        }

        .tip-box {
            background: linear-gradient(135deg, #fefce8 0%, #fef08a 100%);
            border-left: 4px solid #eab308;
            border-radius: 14px;
            padding: 16px clamp(14px, 3vw, 20px);
            margin: 16px 0;
            color: #713f12;
        }

        /* FAQ Accordion Styling */
        .accordion-item {
            border: 1.5px solid #e2e8f0;
            border-radius: 16px !important;
            overflow: hidden;
            margin-bottom: 12px;
        }

        .accordion-button {
            font-weight: 700;
            color: #1e293b;
            background: #f8fafc;
            padding: 16px 20px;
            font-size: 1rem;
        }

        .accordion-button:not(.collapsed) {
            color: var(--primary-dark);
            background: #fce7f3;
            box-shadow: none;
        }

        .accordion-body {
            background: #ffffff;
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Action Buttons */
        .btn-action-primary {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            border: none;
            border-radius: 16px;
            padding: 14px 24px;
            font-size: 1.05rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
            padding: 14px 24px;
            font-size: 1.05rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
                <h3 class="fw-bold mb-1 text-white">คู่มือการใช้งานระบบนักเรียน & การใช้อีเมลโรงเรียน</h3>
                <p class="mb-0 text-white-50 fs-6">สำหรับนักเรียนทุกคนที่เพิ่งเริ่มต้นใช้งาน หรือยังใช้อีเมลโรงเรียน (@skj.ac.th) ไม่เป็น</p>
            </div>

            <!-- Body -->
            <div class="guide-body">

                <!-- Welcome Text -->
                <div class="alert alert-light border-0 shadow-sm p-3 mb-4 rounded-4 text-center">
                    <span class="fs-5">👋</span> <strong>สวัสดีนักเรียนทุกคนครับ!</strong><br>
                    คู่มือนี้จัดทำขึ้นเพื่อช่วยให้นักเรียนทุกคนที่ <strong>ยังไม่มีอีเมลโรงเรียน</strong> หรือ <strong>ยังใช้อีเมลโรงเรียนเข้าสู่ระบบไม่เป็น</strong> สามารถทำตามได้ง่าย ๆ เพียง 2 ขั้นตอนสั้น ๆ ด้านล่างนี้ครับ!
                </div>

                <!-- STEP 1 -->
                <div class="step-card">
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
                            เปิดหน้าแรกของ <strong>ระบบนักเรียน</strong> แล้วกดปุ่มสีฟ้า <span class="badge bg-info text-dark">"ยืนยันตัวตนขอรับอีเมลครั้งแรก"</span>
                        </li>
                        <li>
                            <span class="step-number">2</span>
                            กรอกข้อมูลส่วนตัว 2 อย่าง:
                            <div class="mt-2 p-2 bg-light rounded-3 border small">
                                • 🆔 <strong>เลขประจำตัวนักเรียน</strong> (เช่น <code>12345</code>)<br>
                                • 🪪 <strong>เลขประจำตัวประชาชน 13 หลัก</strong> ของน้อง ๆ
                            </div>
                        </li>
                        <li>
                            <span class="step-number">3</span>
                            กดปุ่ม <span class="badge bg-danger">"ตรวจสอบและรับอีเมลโรงเรียน"</span>
                        </li>
                        <li>
                            <span class="step-number">4</span>
                            <strong>จดหรือบันทึกข้อมูลสำคัญที่ได้ขึ้นมา:</strong>
                            <div class="mt-2 p-3 bg-white border border-info rounded-3">
                                ✉️ <strong>อีเมลโรงเรียนของคุณ:</strong> <code class="text-danger fw-bold fs-6">skj12345@skj.ac.th</code><br>
                                🔑 <strong>รหัสผ่านเริ่มต้น:</strong> <code class="text-dark fw-bold">Skj@123456</code>
                            </div>
                        </li>
                        <li>
                            <span class="step-number">5</span>
                            <strong>เปิดใช้งานครั้งแรกที่ Gmail:</strong>
                            <br>กดปุ่ม <span class="badge bg-white text-dark border"><i class="bx bxl-google text-primary"></i> เข้าสู่ระบบ Gmail (@skj.ac.th)</span> เพื่อนำอีเมลและรหัสผ่านเริ่มต้นไปล็อกอิน 
                            <div class="tip-box mt-2 mb-0">
                                <strong>⚠️ สำคัญมาก:</strong> เมื่อล็อกอินเข้า Gmail ครั้งแรก ระบบ Google จะบังคับให้ <strong>"ตั้งรหัสผ่านใหม่ส่วนตัว"</strong> ทันที ให้ตั้งรหัสผ่านที่จำได้ง่ายแล้วจำไว้ให้ดีนะครับ!
                            </div>
                        </li>
                    </ol>

                    <div class="mt-3 text-end">
                        <a href="<?= base_url('verify-email') ?>" class="btn-action-secondary">
                            <i class="bx bx-shield-quarter"></i> ไปหน้ายืนยันตัวตนรับอีเมล &rarr;
                        </a>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="step-card">
                    <span class="step-badge step-badge-2">
                        <i class="bx bxl-google fs-5"></i> ขั้นตอนที่ 2: เข้าสู่ระบบนักเรียนด้วย Google (สำหรับใช้งานประจำวัน)
                    </span>

                    <div class="info-box" style="background: #fdf2f8; border-color: var(--primary-pink); color: #831843;">
                        <div class="fw-bold mb-1"><i class="bx bx-rocket me-1"></i> เมื่อมีอีเมล @skj.ac.th แล้ว ต่อไปนี้ก็ล็อกอินง่าย ๆ แค่คลิกเดียว!</div>
                    </div>

                    <ol class="step-list">
                        <li>
                            <span class="step-number">1</span>
                            เปิดหน้าแรกของ <strong>ระบบงานนักเรียน</strong>
                        </li>
                        <li>
                            <span class="step-number">2</span>
                            กดที่ปุ่มสีชมพูขนาดใหญ่ <span class="badge bg-danger p-2"><i class="bx bxl-google me-1"></i> เข้าสู่ระบบด้วย Google (@skj.ac.th)</span>
                        </li>
                        <li>
                            <span class="step-number">3</span>
                            จะมีหน้าต่าง Google เด้งขึ้นมา ให้น้อง **กดเลือกบัญชีอีเมลโรงเรียน** (<code>@skj.ac.th</code>) ของน้อง
                        </li>
                        <li>
                            <span class="step-number">4</span>
                            🎉 <strong>ยินดีด้วย!</strong> ระบบจะพาน้องเข้าสู่หน้าจอหลักของระบบนักเรียนทันที สามารถดูเกรดและสมัครชุมนุมได้เลยครับ
                        </li>
                    </ol>

                    <div class="mt-3 text-end">
                        <a href="<?= base_url() ?>" class="btn-action-primary">
                            <i class="bx bx-log-in-circle"></i> ไปที่หน้าเข้าสู่ระบบนักเรียน &rarr;
                        </a>
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
                                    หากน้องจำรหัสผ่านไม่ได้ ไม่ต้องตกใจครับ! น้องสามารถไปที่หน้าแรก แล้วกดปุ่ม <strong>"ลืมรหัสผ่าน / รีเซ็ตรหัสผ่าน?"</strong> หรือ <a href="<?= base_url('verify-email') ?>" class="text-primary fw-bold">เข้าสู่หน้ายืนยันตัวตน</a> เพื่อกดสุ่มรีเซ็ตรหัสผ่านใหม่ได้เองตลอด 24 ชั่วโมงครับ
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
</body>

</html>
