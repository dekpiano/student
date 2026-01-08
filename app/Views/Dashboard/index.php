<style>
    .welcome-card {
        background: linear-gradient(135deg, #e83e8c 0%, #b8266d 100%);
        border: none;
        overflow: hidden;
    }
    .welcome-img {
        position: absolute;
        right: 0;
        bottom: 0;
        height: 100%;
        opacity: 0.2;
    }
    .action-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .card-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        margin-bottom: 1rem;
    }
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Summary Section -->
    <div class="row mb-6">
        <div class="col-12">
            <div class="card welcome-card text-white shadow-lg overflow-hidden position-relative">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-7 position-relative z-index-2">
                            <span class="badge bg-white text-primary mb-3 shadow-sm px-3 py-2">ข้อมูลส่วนตัวนักเรียน</span>
                            <h2 class="h3 fw-bold mb-1 text-white">สวัสดี, <?= session()->get('Fullname') ?> 👋</h2>
                            <p class="mb-4 opacity-75">รหัสนักเรียน: <strong><?= session()->get('UserCode') ?></strong> | ชั้น <?= session()->get('UserClass') ?></p>
                            
                            <?php 
                                $status = session()->get('UserStatus');
                                $statusClass = ($status === '1/ปกติ') ? 'bg-success' : 'bg-warning';
                                $statusIcon = ($status === '1/ปกติ') ? 'bx-check-circle' : 'bx-info-circle';
                            ?>
                            <div class="d-inline-flex align-items-center status-badge bg-white text-<?= ($status === '1/ปกติ') ? 'success' : 'warning' ?>">
                                <i class="bx <?= $statusIcon ?> me-1"></i>
                                สถานะ: <?= $status ?>
                            </div>
                        </div>
                        <div class="col-md-5 d-none d-md-block text-end">
                            <img src="<?= base_url('uploads/dashborad/welcome.svg') ?>" height="150" alt="Welcome" />
                        </div>
                    </div>
                </div>
                <!-- Background decoration for mobile -->
                <img src="<?= base_url('uploads/dashborad/welcome.svg') ?>" class="welcome-img d-md-none" alt="" />
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="row g-4">
        <!-- View Grades Card -->
        <div class="col-12 col-md-6">
            <div class="card action-card h-100">
                <div class="card-body p-4 p-md-5 d-flex flex-column h-100">
                    <div class="card-icon bg-label-primary">
                        <i class="bx bx-book-content bx-md"></i>
                    </div>
                    <h4 class="fw-bold mb-2">ดูผลการเรียน</h4>
                    <p class="text-muted mb-4 flex-grow-1">ตรวจสอบเกรดเฉลี่ย คะแนนเก็บ และผลการเรียนย้อนหลังรายภาคเรียน</p>
                    <a href="<?= base_url('DoGrade/' . session()->get('CheckYearNow')); ?>" class="btn btn-primary btn-lg w-100 shadow-sm">
                        <i class="bx bx-file me-2"></i>เข้าสู่หน้าผลการเรียน
                    </a>
                </div>
            </div>
        </div>

        <!-- Club Activities Card -->
        <div class="col-12 col-md-6">
            <?php $isNormal = (session()->get('UserStatus') === '1/ปกติ'); ?>
            <div class="card action-card h-100 <?= !$isNormal ? 'opacity-75' : '' ?>">
                <div class="card-body p-4 p-md-5 d-flex flex-column h-100">
                    <div class="card-icon bg-label-success">
                        <i class="bx bx-group bx-md"></i>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <h4 class="fw-bold mb-0">กิจกรรมชุมนุม</h4>
                        <?php if (!$isNormal): ?>
                            <span class="badge bg-label-danger ms-2"><i class="bx bx-lock-alt"></i></span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($isNormal): ?>
                        <p class="text-muted mb-4 flex-grow-1">ค้นหาชุมนุมที่สนใจ ลงทะเบียน และติดตามกิจกรรมรายสัปดาห์</p>
                        <a href="<?= base_url('club') ?>" class="btn btn-success btn-lg w-100 shadow-sm">
                            <i class="bx bx-run me-2"></i>เข้าสู่หน้าชุมนุม
                        </a>
                    <?php else: ?>
                        <p class="text-danger fw-600 mb-4 flex-grow-1">ไม่อนุญาตให้เข้าใช้งาน เนื่องจากสถานะนักเรียนไม่ได้เป็น "ปกติ"</p>
                        <button class="btn btn-secondary btn-lg w-100" disabled>
                            <i class="bx bx-lock-alt me-2"></i>ไม่สามารถเข้าใช้ได้
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Tip -->
    <div class="mt-6 text-center">
        <p class="text-muted small">
            <i class="bx bx-help-circle me-1"></i> หากพบข้อมูลไม่ถูกต้อง กรุณาติดต่อฝ่ายงานทะเบียนและวิชาการ
        </p>
    </div>
</div>
<!-- / Content -->