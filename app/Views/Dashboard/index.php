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
        <div class="col-md-6 col-md-4 col-lg-4 order-lg-4 order-3">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-4">
                        <div class="card-body pb-0">
                            <img src="<?=base_url('uploads/dashborad/dograd.png')?>" height="150"
                                class="rounded-start scaleX-n1-rtl" alt="upgrade account">
                        </div>
                    </div>
                    <div class="col-8 text-center">
                        <div class="card-body">
                            <h5 class="card-title mb-1">ดูผลการเรียน</h5>
                            <p class="card-subtitle mb-3">ได้ตั้งแต่ </p>

                            <h5 class="card-title text-info mb-0"> วันที่ 10 ตุลาคม</h5>
                            <p class="mb-3">เป็นต้นไป</p>

                            <a href="<?=base_url('DoGrade/'.session()->get('CheckYearNow'));?>" class="btn btn-sm btn-info">ดูผลการเรียน</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- / Content -->