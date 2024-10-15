<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="<?=base_url()?>assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>ระบบงานนักเรียน | สกจ.9</title>

    <meta name="description" content="" />

   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="<?=base_url()?>uploads/LogoSchool/LogoSKJ_4.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <!-- <link rel="stylesheet" href="<?=base_url()?>assets/vendor/fonts/boxicons.css" /> -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/theme-pink.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="<?=base_url()?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url()?>assets/js/config.js"></script>
</head>

<body style="font-family:Sarabun">
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2 justify-content-center">
                                <img src="<?=base_url('uploads/LogoSchool/LogoSKJ_4.png')?>" alt="" class="w-25">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">ยินดีต้อนรับสู่ระบบงานนักเรียน 👋</h4>
                        <p class="mb-6">Please sign-in to your account and start the adventure</p>
                        <form id="formStudentLogin" class="mb-6">
                            <div class="mb-6">
                                <label for="email" class="form-label">รหัสประจำตัวนักเรียน (5 หลัก)</label>
                                <input type="tel" class="form-control" id="Username" name="Username"
                                    placeholder="XXXXX" autofocus />
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">รหัสผ่าน (เลขบัตรประชาชน 13 หลัก)</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="Password" class="form-control" name="Password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <button class="btn btn-primary w-100" id="SubLogin" type="submit">
                                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"
                                        style="display: none;"></span> เข้าสู่ระบบ
                                    </button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>มีปัญหาในการใช้งาน</span>
                            <a href="auth-register-basic.html">
                                <span>ครูฝ่ายงานเทคโนโลยีสารสนเทศ</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>




    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/menu.js"></script>

    <!-- endbuild -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?=base_url()?>assets/js/main.js"></script>
    <script src="<?=base_url()?>assets/js/Student/JsStudent.js?v=2"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>