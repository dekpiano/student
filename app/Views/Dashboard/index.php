<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl-8 mb-6 order-0">
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
                        <div class="card-body pb-0 px-0 px-md-6">
                            <img src="<?=base_url()?>assets/img/illustrations/man-with-laptop.png" height="175"
                                class="scaleX-n1-rtl" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="bg-label-primary rounded-3 text-center mb-4 pt-6">
                                <img class="img-fluid" src="<?=base_url('uploads/dashborad/dograd.svg')?>"
                                    alt="Card girl image" style="width: 52%;">
                            </div>
                            
                            <div class="col-12 text-center">
                                <a href="<?=base_url('DoGrade/'.session()->get('CheckYearNow'));?>" class="btn btn-primary w-100 d-grid">ดูผลการเรียน</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- / Content -->