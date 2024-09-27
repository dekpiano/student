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
                <div class="col-lg-6 col-md-12 col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="bg-label-primary rounded-3 text-center mb-4 pt-6">
                                <img class="img-fluid" src="<?=base_url('uploads/dashborad/dograd.svg')?>"
                                    alt="Card girl image" style="width: 52%;">
                            </div>
                            
                            <div class="col-12 text-center">
                                <a href="javascript:void(0);" class="btn btn-primary w-100 d-grid">ดูผลการเรียน</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="<?=base_url()?>assets/img/icons/unicons/wallet-info.png" alt="wallet info"
                                        class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded text-muted"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="javascript:void(0);">View
                                            More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-1">Sales</p>
                            <h4 class="card-title mb-3">$4,679</h4>
                            <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i>
                                +28.42%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- / Content -->