<!doctype html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="<?=base_url()?>assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>เข้าสู่ระบบ | ระบบงานนักเรียน สกจ.</title>

    <meta name="description" content="ระบบงานนักเรียน โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>uploads/LogoSchool/LogoSKJ_4.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    
    <style>
        :root {
            --primary-color: #e83e8c;
            --primary-gradient: linear-gradient(135deg, #e83e8c 0%, #b8266d 100%);
        }

        body {
            font-family: 'Sarabun', sans-serif;
            background: #f8f9fa;
        }

        .auth-wrapper {
            background-color: #fdfdfd;
            background-image: radial-gradient(#e83e8c 0.5px, #fdfdfd 0.5px);
            background-size: 20px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(232, 62, 140, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease;
        }

        .auth-inner {
            padding: 2.5rem !important;
        }

        .brand-logo {
            width: 80px;
            height: auto;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
        }

        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 0.8rem;
            padding: 0.75rem 1rem;
            border: 1.5px solid #eee;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(232, 62, 140, 0.1);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 0.8rem;
            padding: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px rgba(232, 62, 140, 0.3);
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(232, 62, 140, 0.4);
        }

        .student-illustration {
            background: var(--primary-gradient);
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .input-group-text {
            border-radius: 0 0.8rem 0.8rem 0;
            border: 1.5px solid #eee;
            border-left: none;
            background: white;
        }

        .password-toggle input {
            border-radius: 0.8rem 0 0 0.8rem;
            border-right: none;
        }

        .help-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .help-link:hover {
            color: #b8266d;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .auth-inner {
                padding: 2.5rem 1.5rem !important;
            }
        }

        /* Floating Label Customization */
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary-color);
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        }
        .form-floating > .form-control {
            border: 1px solid #eee;
            border-radius: 0.8rem;
        }
        .form-floating > .form-control:focus {
            border-color: var(--primary-color);
        }
    </style>
</head>

<body>
    <div class="auth-wrapper container-p-y p-4">
        <div class="auth-card card">
            <div class="student-illustration d-none d-md-block">
                <img src="<?=base_url()?>uploads/LogoSchool/LogoSKJ_4.png" alt="SKJ Logo" class="brand-logo bg-white rounded-circle p-2">
                <h4 class="text-white fw-bold mb-0">ระบบงานนักเรียน สกจ.</h4>
                <p class="small opacity-75 mb-0 text-white">โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</p>
            </div>
            
            <div class="card-body auth-inner">
                <div class="text-center d-md-none mb-5">
                    <img src="<?=base_url()?>uploads/LogoSchool/LogoSKJ_4.png" alt="SKJ Logo" class="brand-logo mb-3">
                    <h4 class="fw-bold mb-1">เข้าสู่ระบบนักเรียน</h4>
                    <p class="text-muted small">Smart Student Management System</p>
                </div>

                <div class="d-none d-md-block mb-5">
                    <h5 class="fw-bold mb-1">ยินดีต้อนรับกลับมา!</h5>
                    <p class="text-muted small">กรุณาระบุข้อมูลเพื่อเข้าสู่ระบบ</p>
                </div>

                <form id="formStudentLogin" class="mb-4">
                    <div class="form-floating mb-4">
                        <input type="tel" class="form-control" id="Username" name="Username" placeholder="รหัสนักเรียน 5 หลัก" maxlength="5" autofocus />
                        <label for="Username"><i class="bx bx-user me-2"></i>รหัสนักเรียน 5 หลัก</label>
                    </div>
                    
                    <div class="form-floating mb-4 position-relative password-toggle">
                        <input type="password" id="Password" class="form-control" name="Password" placeholder="เลขบัตรประชาชน 13 หลัก" />
                        <label for="Password"><i class="bx bx-lock-alt me-2"></i>เลขบัตรประชาชน 13 หลัก</label>
                        <span class="position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer" style="z-index: 5;">
                            <i class="bx bx-hide fs-4 text-muted"></i>
                        </span>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-primary w-100 btn-lg shadow-sm" id="SubLogin" type="submit">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" style="display: none;"></span>
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>

                <div class="text-center">
                    <p class="mb-0 small text-muted">ต้องการความช่วยเหลือ?</p>
                    <a href="https://m.me/skjnews" target="_blank" class="help-link small">
                        ศูนย์ช่วยเหลือฝ่ายเทคโนโลยีสารสนเทศ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main JS -->
    <script src="<?=base_url()?>assets/js/main.js"></script>
    <script src="<?=base_url()?>assets/js/Student/JsStudent.js?v=<?=time()?>"></script>

    <script>
        $(document).ready(function() {
            $('.password-toggle .cursor-pointer').click(function() {
                const input = $('#Password');
                const icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });
        });
    </script>
</body>
</html>