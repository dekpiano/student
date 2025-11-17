<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
            <div class="card">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">ยินดีต้อนรับ <?=session()->get('Fullname')?>! 🎉
                            </h5>
                            <p class="mb-6">
                                ระบบงานสำหรับนักเรียน สกจ.9
                            </p>

                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 ">
                            <img src="<?=base_url('uploads/dashborad/welcome.svg')?>" height="175"
                                class="scaleX-n1-rtl" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- View Grades Card -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md me-3">
                                <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-book bx-sm"></i></span>
                            </div>
                            <h5 class="card-title mb-0">ดูผลการเรียน</h5>
                        </div>
                    </div>
                    <p class="mb-4">ตรวจสอบผลการเรียนของคุณในแต่ละภาคเรียนและปีการศึกษา</p>
                    <a href="<?= base_url('DoGrade/index/1/'.session()->get('CheckYearNow')) ?>" class="btn btn-primary">
                        <i class="bx bx-show me-1"></i> ดูผลการเรียน
                    </a>
                </div>
            </div>
        </div>

        <!-- Club Activities Card -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md me-3">
                                <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-group bx-sm"></i></span>
                            </div>
                            <h5 class="card-title mb-0">กิจกรรมชุมนุม</h5>
                        </div>
                    </div>
                    <p class="mb-4">เข้าร่วมและตรวจสอบกิจกรรมชุมนุมของคุณ</p>
                    <a href="<?= base_url('club') ?>" class="btn btn-success">
                        <i class="bx bx-run me-1"></i> เข้าสู่หน้าชุมนุม
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- / Content -->