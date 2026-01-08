<style>
    :root {
        --primary-color: #e83e8c;
        --secondary-color: #6c757d;
        --success-color: #28a745;
        --info-color: #17a2b8;
    }

    .club-header-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, #c2185b 100%);
        border-radius: 1.5rem;
        padding: 3rem 2rem;
        color: white;
        margin-bottom: -4rem;
        position: relative;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(232, 62, 140, 0.3);
    }

    .club-content-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 1.5rem;
        padding: 5rem 2rem 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
    }

    .detail-card {
        border-radius: 1rem;
        border: none;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .bg-light-primary { background-color: rgba(232, 62, 140, 0.1); color: var(--primary-color); }
    .bg-light-success { background-color: rgba(40, 167, 69, 0.1); color: var(--success-color); }
    .bg-light-info { background-color: rgba(23, 162, 184, 0.1); color: var(--info-color); }

    .member-item {
        padding: 0.75rem 1rem;
        border-radius: 0.8rem;
        margin-bottom: 0.5rem;
        border: 1px solid #eee;
        transition: all 0.2s;
    }
    .member-item:hover {
        background: #fff;
        border-color: var(--primary-color);
        padding-left: 1.25rem;
    }

    .objective-item {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 1rem;
    }
    .objective-item:before {
        content: '\ec44'; /* Boxicon bx-check */
        font-family: 'boxicons';
        position: absolute;
        left: 0;
        top: 0;
        color: var(--primary-color);
        font-size: 1.2rem;
        font-weight: bold;
    }

    .activity-timeline-item {
        position: relative;
        padding-left: 2rem;
        border-left: 2px solid #eee;
        padding-bottom: 1.5rem;
    }
    .activity-timeline-item:last-child {
        border-left: none;
    }
    .activity-timeline-item:after {
        content: '';
        position: absolute;
        left: -9px;
        top: 0;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 3px solid white;
        box-shadow: 0 0 0 4px rgba(232, 62, 140, 0.1);
    }

    .badge-premium {
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>" class="text-muted text-decoration-none">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('club') ?>" class="text-muted text-decoration-none">เลือกชุมนุม</a></li>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">รายละเอียดชุมนุม</li>
            </ol>
        </nav>

        <?php if (!empty($club)): ?>
            <!-- Hero Header -->
            <div class="club-header-hero text-center text-md-start">
                <div class="row align-items-center">
                    <div class="col-md-9 mb-3 mb-md-0">
                        <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 shadow-sm">
                            <i class="bx bx-calendar me-1"></i> ปีการศึกษา <?= esc($club['club_year']) ?> / ภาคเรียนที่ <?= esc($club['club_trem']) ?>
                        </span>
                        <h1 class="display-5 fw-bold text-white mb-2"><?= esc($club['club_name']) ?></h1>
                        <p class="fs-5 opacity-75 mb-0 d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bx bx-map me-2"></i> โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์
                        </p>
                    </div>
                    <div class="col-md-3 text-center text-md-end">
                        <div class="d-inline-block bg-white text-primary p-3 rounded-4 shadow-lg">
                            <div class="h3 fw-bold mb-0"><?= $club['member_count'] ?> / <?= $club['club_max_participants'] ?></div>
                            <small class="text-muted fw-bold">สมาชิกปัจจุบัน</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Body -->
            <div class="club-content-card">
                <div class="row g-4 mb-5">
                    <!-- Advisor -->
                    <div class="col-md-4">
                        <div class="card detail-card h-100 p-3">
                            <div class="icon-box bg-light-primary">
                                <i class="bx bx-user-voice"></i>
                            </div>
                            <h6 class="text-muted mb-1">ครูที่ปรึกษา</h6>
                            <h4 class="fw-bold mb-0"><?= esc($club['advisor_names']) ?></h4>
                        </div>
                    </div>
                    <!-- Level -->
                    <div class="col-md-4">
                        <div class="card detail-card h-100 p-3">
                            <div class="icon-box bg-light-info">
                                <i class="bx bx-graduation"></i>
                            </div>
                            <h6 class="text-muted mb-1">กลุ่มระดับชั้น</h6>
                            <h4 class="fw-bold mb-0"><?= esc($club['club_level'] ?? 'ทุกระดับชั้น') ?></h4>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="col-md-4">
                        <div class="card detail-card h-100 p-3">
                            <div class="icon-box bg-light-success">
                                <i class="bx bx-check-shield"></i>
                            </div>
                            <h6 class="text-muted mb-1">สถานะโครงการ</h6>
                            <h4 class="fw-bold mb-0"><?= $club['member_count'] < $club['club_max_participants'] ? 'เปิดรับสมัคร' : 'สมาชิกเต็มแล้ว' ?></h4>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Left Column: Info & Objectives -->
                    <div class="col-lg-7">
                        <div class="mb-5">
                            <h4 class="fw-bold mb-4 d-flex align-items-center">
                                <span class="badge bg-primary me-2" style="width: 10px; height: 30px; padding: 0;"></span>
                                ข้อมูลชุมนุม
                            </h4>
                            <p class="text-secondary fs-5 lh-base">
                                <?= nl2br(esc($club['club_description'])) ?>
                            </p>
                        </div>

                        <div class="mb-5">
                            <h4 class="fw-bold mb-4 d-flex align-items-center">
                                <span class="badge bg-primary me-2" style="width: 10px; height: 30px; padding: 0;"></span>
                                วัตถุประสงค์
                            </h4>
                            <div class="bg-light p-4 rounded-4 border border-white">
                                <?php if (!empty($objectives)): ?>
                                    <?php foreach ($objectives as $objective): ?>
                                        <div class="objective-item fs-6">
                                            <?= esc($objective['objective_name']) ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-3 text-muted">
                                        <i class="bx bx-info-circle fs-3 mb-2"></i>
                                        <p class="mb-0">ยังไม่มีการกำหนดวัตถุประสงค์</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <h4 class="fw-bold mb-4 d-flex align-items-center">
                                <span class="badge bg-primary me-2" style="width: 10px; height: 30px; padding: 0;"></span>
                                แผนกิจกรรม
                            </h4>
                            <div class="p-4 border rounded-4 bg-white shadow-sm">
                                <?php if (!empty($activities)): ?>
                                    <?php foreach ($activities as $activity): ?>
                                        <div class="activity-timeline-item">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="fw-bold mb-0 text-primary fs-5"><?= esc($activity['act_name']) ?></h6>
                                                <span class="badge bg-label-secondary small"><?= date('d M Y', strtotime($activity['act_date'])) ?></span>
                                            </div>
                                            <div class="text-muted small">
                                                <i class="bx bx-map-pin me-1"></i> <?= esc($activity['act_location']) ?> | 
                                                <i class="bx bx-time me-1"></i> <?= date('H:i', strtotime($activity['act_start_time'])) ?> - <?= date('H:i', strtotime($activity['act_end_time'])) ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-4 text-muted">
                                        <img src="<?= base_url('assets/img/illustrations/empty-box.svg') ?>" height="80" class="mb-2" alt="Empty">
                                        <p class="mb-0">ยังไม่มีการกำหนดกิจกรรม</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Members -->
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">รายชื่อสมาชิก (<?= count($members) ?> คน)</h5>
                                <i class="bx bx-group text-primary fs-4"></i>
                            </div>
                            <div class="card-body p-3" style="max-height: 600px; overflow-y: auto;">
                                <?php if (!empty($members)): ?>
                                    <?php foreach ($members as $member): ?>
                                        <div class="member-item d-flex align-items-center justify-content-between bg-white shadow-sm-hover transition">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial rounded-circle bg-label-primary me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-weight: bold;">
                                                    <?= mb_substr($member['StudentFirstName'], 0, 1) ?>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark small-mobile-font"><?= esc($member['StudentPrefix'] . $member['StudentFirstName'] . ' ' . $member['StudentLastName']) ?></div>
                                                    <div class="text-muted" style="font-size: 0.75rem;">รหัส: <?= esc($member['StudentCode']) ?> | ชั้น: <?= esc($member['StudentClass']) ?></div>
                                                </div>
                                            </div>
                                            <?php if ($member['member_role'] === 'Leader'): ?>
                                                <span class="badge bg-primary badge-pill" style="font-size: 0.65rem;">หัวหน้า</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-5 text-muted opacity-50">
                                        <i class="bx bx-user-x fs-1 mb-2"></i>
                                        <p>ยังไม่มีสมาชิก</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center py-5">
                    <i class="bx bx-error-circle display-1 text-danger mb-4"></i>
                    <h2 class="fw-bold">ไม่พบข้อมูลชุมนุม</h2>
                    <p class="text-muted fs-5 mb-4">ไม่พบข้อมูลสำหรับชุมนุมที่คุณต้องการดู หรือชุมนุมอาจถูกปิดไปแล้ว</p>
                    <a href="<?= base_url('club') ?>" class="btn btn-primary btn-lg px-5 rounded-pill">
                        <i class="bx bx-arrow-back me-2"></i>กลับไปหน้ารายการ
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-5 mb-4 text-center">
            <a href="<?= base_url('club') ?>" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">
                <i class="bx bx-chevron-left me-1"></i> กลับไปหน้ารายการ
            </a>
        </div>
    </div>
</div>

<script>
    // Smooth hover effect for mobile to simulate desktop luxury
    document.querySelectorAll('.detail-card, .member-item').forEach(el => {
        el.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        el.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    });
</script>
