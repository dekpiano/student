<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Sarabun:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<style>
    :root {
        --primary-color: #e83e8c;
        --secondary-color: #6c757d;
        --glass-bg: rgba(255, 255, 255, 0.85);
        --glass-border: rgba(255, 255, 255, 0.4);
        --gradient-primary: linear-gradient(135deg, #e83e8c 0%, #c2185b 100%);
        --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --gradient-dark: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        --card-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 8px 15px -8px rgba(0, 0, 0, 0.05);
        --hover-shadow: 0 20px 40px -10px rgba(232, 62, 140, 0.15), 0 10px 20px -10px rgba(0, 0, 0, 0.08);
    }

    body {
        font-family: 'Outfit', 'Sarabun', sans-serif;
    }

    .content-wrapper {
        background-color: #f8fafc;
    }

    .page-title {
        font-size: 1.4rem;
        font-weight: 800;
        background: linear-gradient(to right, #e83e8c, #c2185b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    @media (min-width: 768px) {
        .page-title {
            font-size: 1.85rem;
        }
    }

    /* Sneat Primary Overrides for Pink Theme */
    .btn-primary {
        background-color: #e83e8c !important;
        border-color: #e83e8c !important;
        box-shadow: 0 0.125rem 0.25rem 0 rgba(232, 62, 140, 0.4) !important;
    }
    .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
        background-color: #c2185b !important;
        border-color: #c2185b !important;
        box-shadow: 0 0.125rem 0.25rem 0 rgba(194, 24, 91, 0.4) !important;
    }
    .btn-outline-primary {
        color: #e83e8c !important;
        border-color: #e83e8c !important;
    }
    .btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active {
        background-color: #e83e8c !important;
        border-color: #e83e8c !important;
        color: #fff !important;
    }
    .text-primary {
        color: #e83e8c !important;
    }
    .bg-label-primary {
        background-color: rgba(232, 62, 140, 0.08) !important;
        color: #e83e8c !important;
    }

    /* Banners & Statuses */
    .status-banner {
        border: none;
        border-radius: 16px;
        color: #fff;
        position: relative;
        overflow: hidden;
        z-index: 1;
        box-shadow: var(--card-shadow);
    }
    @media (min-width: 768px) {
        .status-banner {
            border-radius: 20px;
        }
    }
    .status-banner::before {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.15) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, transparent 75%, transparent);
        background-size: 40px 40px;
        opacity: 0.1;
        z-index: -1;
    }
    .status-banner.open { background: var(--gradient-primary); }
    .status-banner.coming-soon { background: var(--gradient-warning); }
    .status-banner.closed { background: var(--gradient-danger); }
    .status-banner.not-scheduled { background: var(--gradient-dark); }

    /* Registered Club Dashboard */
    .registered-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
    }
    @media (min-width: 768px) {
        .registered-card {
            border-radius: 24px;
        }
    }
    .registered-card:hover {
        transform: translateY(-2px);
    }
    .registered-header {
        background: var(--gradient-primary);
        border-radius: 20px 20px 0 0;
        padding: 1.25rem 1.5rem;
    }
    @media (min-width: 768px) {
        .registered-header {
            border-radius: 24px 24px 0 0;
            padding: 1.5rem 2rem;
        }
    }
    .registered-avatar {
        background: #ffffff;
        border: 1px solid rgba(232, 62, 140, 0.15);
        width: 76px;
        height: 76px;
        border-radius: 18px;
        color: #e83e8c;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(232, 62, 140, 0.1);
    }
    .registered-avatar i {
        font-size: 2.5rem !important;
    }
    @media (min-width: 768px) {
        .registered-avatar {
            width: 90px;
            height: 90px;
            border-radius: 22px;
        }
        .registered-avatar i {
            font-size: 3.5rem !important;
        }
    }

    @media (max-width: 767.98px) {
        .border-end-md {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1.5rem;
            margin-bottom: 1rem;
        }
    }

    /* Club Cards */
    .club-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }
    @media (min-width: 768px) {
        .club-card {
            border-radius: 20px;
        }
    }
    .club-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--hover-shadow);
        border-color: #f8bbd0;
    }
    .club-card-header {
        background: #fdfdfd;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem;
        position: relative;
    }
    @media (min-width: 768px) {
        .club-card-header {
            padding: 1.5rem;
        }
    }
    .club-icon-wrapper {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(232, 62, 140, 0.08);
        color: #e83e8c;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        font-size: 1.25rem;
    }
    @media (min-width: 768px) {
        .club-icon-wrapper {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            font-size: 1.5rem;
        }
    }
    .club-card:hover .club-icon-wrapper {
        background: #e83e8c;
        color: #fff;
        transform: scale(1.05) rotate(5deg);
    }
    .club-progress {
        height: 8px;
        background-color: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
    }
    .club-progress-bar {
        background: var(--gradient-primary);
        border-radius: 10px;
    }

    /* Search & Filters */
    .search-input-group {
        border-radius: 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
    }
    @media (min-width: 768px) {
        .search-input-group {
            border-radius: 30px;
        }
    }
    .search-input-group:focus-within {
        border-color: #e83e8c;
        box-shadow: 0 0 0 4px rgba(232, 62, 140, 0.1);
    }

    /* Modals styling */
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }
    @media (min-width: 768px) {
        .modal-content {
            border-radius: 24px;
        }
    }
    .modal-header {
        background: var(--gradient-primary);
        color: white;
        border-bottom: none;
        padding: 1.25rem;
    }
    @media (min-width: 768px) {
        .modal-header {
            padding: 1.5rem;
        }
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(1) brightness(2);
    }
    .modal-card-stat {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .modal-card-stat:hover {
        transform: scale(1.02);
    }

    /* Animations */
    @keyframes pulse-soft {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    .pulse-status {
        animation: pulse-soft 2s infinite;
    }
    .header-badge-text-title {
        font-size: 0.65rem;
    }
    .header-badge-text-value {
        font-size: 0.8rem;
    }
    @media (min-width: 768px) {
        .header-badge-text-title {
            font-size: 0.75rem;
        }
        .header-badge-text-value {
            font-size: 0.95rem;
        }
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        
        <!-- Header Info -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="page-title mb-1 d-flex align-items-center">
                    <i class="bx bx-compass me-2 fs-2 text-primary"></i> กิจกรรมชุมนุม
                </h3>
                <p class="text-muted mb-0">ระบบลงทะเบียนเลือกชุมนุมออนไลน์ โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</p>
            </div>
            
            <div class="row g-3 m-0 justify-content-md-end w-100 flex-grow-1 align-items-center" style="max-width: 100%;">
                <?php if (!empty($current_year) && !empty($current_term)): ?>
                    <div class="col-6 col-md-auto p-0 pe-1 pe-md-0">
                        <div class="bg-white px-3 py-2 px-md-4 py-md-3 rounded-4 shadow-sm border border-light d-flex align-items-center h-100">
                            <span class="badge bg-label-primary p-1.5 p-md-2 rounded-3 me-2">
                                <i class="bx bx-calendar fs-5 fs-md-4"></i>
                            </span>
                            <div>
                                <small class="text-muted d-block header-badge-text-title" style="line-height: 1.2;">ภาคเรียน / ปีการศึกษา</small>
                                <span class="fw-bold text-dark header-badge-text-value"><?= esc($current_term) ?> / <?= esc($current_year) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($student_club_history)): ?>
                    <div class="col-6 col-md-auto p-0 ps-1 ps-md-0 ms-md-2">
                        <div role="button" data-bs-toggle="modal" data-bs-target="#historyModal" class="bg-white px-3 py-2 px-md-4 py-md-3 rounded-4 shadow-sm border border-light d-flex align-items-center text-start w-100 h-100" style="cursor: pointer;">
                            <span class="badge bg-label-secondary p-1.5 p-md-2 rounded-3 me-2" style="background-color: rgba(108, 117, 125, 0.08) !important; color: #6c757d !important;">
                                <i class="bx bx-history fs-5 fs-md-4"></i>
                            </span>
                            <div>
                                <small class="text-muted d-block header-badge-text-title" style="line-height: 1.2;">ดูประวัติชุมนุม</small>
                                <span class="fw-bold text-dark header-badge-text-value">เคยลงไว้ (<?= count($student_club_history) ?>)</span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Registration Status Banner -->
        <?php
        $banner_class = 'not-scheduled';
        $banner_icon = 'bx-calendar-exclamation';
        $banner_title = 'ยังไม่กำหนดช่วงเวลา';
        $banner_message = 'ยังไม่มีการกำหนดช่วงเวลาการลงทะเบียนสำหรับภาคเรียนนี้';
        $countdown_html = '';
        $is_registration_open = false;

        if (!empty($registration_period)) {
            $start_time = strtotime($registration_period['c_onoff_regisstart']);
            $end_time = strtotime($registration_period['c_onoff_regisend']);
            $now = time();

            if ($now < $start_time) {
                $banner_class = 'coming-soon';
                $banner_icon = 'bx-time-five';
                $banner_title = 'ระบบเปิดลงทะเบียนเร็วๆ นี้';
                $banner_message = 'ระบบจะเปิดให้ลงทะเบียนในวันที่ ' . date('d/m/Y H:i', $start_time) . ' น.';
                $countdown_html = '';
            } elseif ($now >= $start_time && $now <= $end_time) {
                $banner_class = 'open';
                $banner_icon = 'bx-calendar-check';
                $banner_title = 'เปิดรับสมัครลงทะเบียนแล้ว!';
                $banner_message = 'สิ้นสุดการลงทะเบียนในวันที่ ' . date('d/m/Y H:i', $end_time) . ' น.';
                $countdown_html = '<div id="countdown-timer" class="fs-5 fw-bold text-white mt-2 pulse-status" data-end-time="' . $registration_period['c_onoff_regisend'] . '"></div>';
                $is_registration_open = true;
            } else {
                $banner_class = 'closed';
                $banner_icon = 'bx-lock-alt';
                $banner_title = 'ปิดรับสมัครลงทะเบียนแล้ว';
                $banner_message = 'หมดเขตการลงทะเบียนเลือกชุมนุมในภาคเรียนนี้แล้ว';
                $countdown_html = '';
            }
        }

        $icon_color = '#e83e8c'; // default pink
        if ($banner_class === 'coming-soon') $icon_color = '#d97706';
        elseif ($banner_class === 'closed') $icon_color = '#dc2626';
        elseif ($banner_class === 'not-scheduled') $icon_color = '#1f2937';
        ?>

        <?php if (empty($student_club)): ?>
            <div class="card status-banner <?= $banner_class ?> mb-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                        <div class="bg-white p-3 rounded-4 align-self-start align-self-sm-center shadow-sm d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="bx <?= $banner_icon ?>" style="font-size: 2.5rem; color: <?= $icon_color ?>;"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1 text-white"><?= $banner_title ?></h4>
                            <p class="mb-0 text-white text-opacity-90 fs-6"><?= $banner_message ?></p>
                            <?= $countdown_html ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Main Workspace -->
        <?php if (!empty($student_club)): ?>
            <!-- Student Already Registered -->
            <div class="card registered-card overflow-hidden mb-4">
                <div class="registered-header text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-badge-check fs-3"></i>
                            <h5 class="mb-0 text-white fw-bold">คุณลงทะเบียนชุมนุมเสร็จเรียบร้อยแล้ว</h5>
                        </div>
                        <div>
                            <?php if ($is_registration_open): ?>
                                <span class="badge bg-success bg-opacity-20 text-white border border-success border-opacity-30 rounded-pill px-3 py-1.5">
                                    <span class="spinner-grow spinner-grow-sm text-white me-1" role="status" style="width:8px; height:8px;"></span> ระบบเปิดอยู่
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger bg-opacity-20 text-white border border-danger border-opacity-30 rounded-pill px-3 py-1.5">
                                    <i class="bx bx-lock-alt me-1"></i> ปิดรับสมัคร
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-3 text-center border-end-md">
                            <div class="registered-avatar mx-auto mb-3">
                                <i class="bx bx-group" style="font-size: 3.5rem;"></i>
                            </div>
                            <span class="badge bg-label-primary px-3 py-2 rounded-pill fw-semibold">
                                <i class="bx bx-check me-1"></i>เข้าร่วมแล้ว
                            </span>
                        </div>
                        <div class="col-md-9 ps-md-4">
                            <span class="text-primary small text-uppercase fw-bold tracking-wider">ชุมนุมของคุณในภาคเรียนนี้</span>
                            <h2 class="fw-extrabold text-dark mt-1 mb-3"><?= esc($student_club['club_name']) ?></h2>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center bg-light p-3 rounded-3">
                                        <i class="bx bx-user-voice text-primary fs-3 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">ครูที่ปรึกษา</small>
                                            <span class="fw-bold text-dark"><?= esc($student_club['advisor_names']) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center bg-light p-3 rounded-3">
                                        <i class="bx bx-calendar-star text-primary fs-3 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">ปีการศึกษา / ภาคเรียนที่ลง</small>
                                            <span class="fw-bold text-dark"><?= esc($student_club['club_year']) ?> / <?= esc($student_club['club_trem']) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-secondary mb-4 fs-6"><?= esc($student_club['club_description']) ?: 'ไม่มีรายละเอียดคำอธิบายสำหรับชุมนุมนี้' ?></p>
                            
                            <div class="d-flex flex-column flex-sm-row gap-2 w-100 align-items-stretch align-items-sm-center">
                                <a href="<?= base_url('club/view/' . $student_club['club_id']) ?>" class="btn btn-primary px-4 py-2.5 rounded-pill shadow-sm text-center">
                                    <i class="bx bx-detail me-1.5"></i>ดูรายละเอียดชุมนุม
                                </a>
                                <button type="button" class="btn btn-outline-primary view-attendance-btn px-4 py-2.5 rounded-pill"
                                    data-student-id="<?= esc(session()->get('UserId')) ?>"
                                    data-club-id="<?= esc($student_club['club_id']) ?>"
                                    data-club-name="<?= esc($student_club['club_name']) ?>">
                                    <i class="bx bx-time-five me-1.5"></i>เช็คเวลาเรียน
                                </button>
                                <button type="button" class="btn btn-outline-secondary view-results-btn px-4 py-2.5 rounded-pill">
                                    <i class="bx bx-award me-1.5"></i>ผลการประเมิน
                                </button>
                                
                                <?php if ($is_registration_open): ?>
                                    <button 
                                        class="btn btn-link text-danger cancel-club-btn p-0 ms-sm-auto mt-2 mt-sm-0 d-flex align-items-center justify-content-center gap-1 fw-bold" 
                                        data-club-id="<?= $student_club['club_id'] ?>" 
                                        data-club-name="<?= esc($student_club['club_name']) ?>">
                                        <i class="bx bx-transfer fs-4"></i> เปลี่ยนชุมนุม
                                    </button>
                                <?php else: ?>
                                    <div class="ms-sm-auto mt-2 mt-sm-0 d-flex align-items-center justify-content-center text-muted bg-light px-3 py-2 rounded-3 border">
                                        <i class="bx bx-info-circle me-1.5 text-warning fs-5"></i>
                                        <small class="fw-semibold">ขณะนี้พ้นกำหนดระยะเวลาการขอเปลี่ยนย้ายชุมนุมแล้ว</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Search bar & Filter -->
            <div class="row mb-4">
                <div class="col-lg-6 mx-auto">
                    <div class="input-group search-input-group p-1">
                        <span class="input-group-text bg-transparent border-0 px-3"><i class="bx bx-search fs-4 text-muted"></i></span>
                        <input type="text" id="club-search" class="form-control border-0 py-2" placeholder="ค้นหาชื่อชุมนุม หรือ ครูที่ปรึกษา...">
                    </div>
                </div>
            </div>

            <!-- Club List -->
            <div class="row" id="clubs-listing-row">
                <?php if (empty($clubs)): ?>
                    <div class="col-12 text-center py-5">
                        <div class="card border-0 shadow-sm p-5 rounded-4">
                            <i class="bx bx-box text-muted mb-3" style="font-size: 4rem;"></i>
                            <h4 class="fw-bold">ไม่พบข้อมูลชุมนุม</h4>
                            <p class="text-secondary mb-0">ยังไม่มีรายชื่อชุมนุมที่จัดตารางเรียนหรือพร้อมเปิดรับสมัครในขณะนี้</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($clubs as $club): ?>
                        <?php 
                        $is_full = $club['member_count'] >= $club['club_max_participants']; 
                        $percentage = ($club['club_max_participants'] > 0) ? ($club['member_count'] / $club['club_max_participants']) * 100 : 0;
                        ?>
                        <div class="col-md-6 col-lg-4 mb-4 club-card-container">
                            <div class="card club-card h-100 border-0 d-flex flex-column">
                                <div class="club-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <?php
                                            $icon = 'bx-cube-alt';
                                            if (strpos($club['club_name'], 'คอม') !== false) $icon = 'bx-laptop';
                                            elseif (strpos($club['club_name'], 'ภาษา') !== false) $icon = 'bx-book';
                                            elseif (strpos($club['club_name'], 'กีฬา') !== false) $icon = 'bx-football';
                                            elseif (strpos($club['club_name'], 'ดนตรี') !== false) $icon = 'bx-music';
                                            elseif (strpos($club['club_name'], 'ศิลปะ') !== false) $icon = 'bx-palette';
                                        ?>
                                        <div class="club-icon-wrapper">
                                            <i class="bx <?= $icon ?> fs-2"></i>
                                        </div>
                                        
                                        <!-- Badges Status -->
                                        <div>
                                            <?php if ($is_full): ?>
                                                <span class="badge bg-label-danger rounded-pill px-2.5 py-1">เต็มแล้ว</span>
                                            <?php elseif (!$is_registration_open): ?>
                                                <span class="badge bg-label-warning rounded-pill px-2.5 py-1">ยังไม่เปิด/ปิดรับ</span>
                                            <?php else: ?>
                                                <span class="badge bg-label-primary rounded-pill px-2.5 py-1">เปิดรับสมัคร</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <h5 class="card-title fw-bold text-dark mb-1 mt-2 club-name-text"><?= esc($club['club_name']) ?></h5>
                                    <span class="badge bg-label-secondary mb-3"><?= esc($club['club_level']) ?></span>
                                </div>
                                
                                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center text-muted mb-2">
                                            <i class="bx bx-user-voice me-2 fs-5 text-primary"></i>
                                            <span class="small club-advisor-text">ครูผู้สอน: <strong><?= esc($club['advisor_names']) ?></strong></span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="small text-muted fw-medium">ที่นั่งว่าง</span>
                                            <span class="small fw-bold text-dark"><?= $club['member_count'] ?> / <?= $club['club_max_participants'] ?> คน</span>
                                        </div>
                                        <div class="progress club-progress mb-4">
                                            <div class="progress-bar club-progress-bar" role="progressbar" style="width: <?= $percentage ?>%;" aria-valuenow="<?= $club['member_count'] ?>" aria-valuemin="0" aria-valuemax="<?= $club['club_max_participants'] ?>"></div>
                                        </div>
                                        
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <a href="<?= base_url('club/view/' . $club['club_id']) ?>" class="btn btn-outline-secondary w-100 rounded-pill btn-sm py-2">
                                                    <i class="bx bx-search-alt me-1"></i>ดูรายละเอียด
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button 
                                                    class="btn btn-primary w-100 rounded-pill btn-sm py-2 join-club-btn" 
                                                    data-club-id="<?= $club['club_id'] ?>" 
                                                    data-club-name="<?= esc($club['club_name']) ?>"
                                                    <?= ($is_full || !$is_registration_open) ? 'disabled' : '' ?>>
                                                    <i class="bx bx-plus-circle me-1"></i><?= $is_full ? 'เต็มแล้ว' : 'สมัครเข้าร่วม' ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center" id="attendanceModalLabel">
                    <i class="bx bx-time-five me-2"></i>สรุปเวลาเรียน
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="modal-loader" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">กำลังโหลด...</span>
                    </div>
                </div>
                <div id="modal-content-area" class="d-none">
                    <div class="row text-center g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="card modal-card-stat bg-success bg-opacity-10 border border-success border-opacity-25 p-3">
                                <h3 class="fw-extrabold text-success mb-1" id="summary-present">0</h3>
                                <p class="text-muted small mb-0 fw-semibold">มาเรียน (ชม.)</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card modal-card-stat bg-danger bg-opacity-10 border border-danger border-opacity-25 p-3">
                                <h3 class="fw-extrabold text-danger mb-1" id="summary-absent">0</h3>
                                <p class="text-muted small mb-0 fw-semibold">ขาดเรียน (ชม.)</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card modal-card-stat bg-warning bg-opacity-10 border border-warning border-opacity-25 p-3">
                                <h3 class="fw-extrabold text-warning mb-1" id="summary-sick">0</h3>
                                <p class="text-muted small mb-0 fw-semibold">ลาป่วย (ชม.)</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card modal-card-stat bg-info bg-opacity-10 border border-info border-opacity-25 p-3">
                                <h3 class="fw-extrabold text-info mb-1" id="summary-personal">0</h3>
                                <p class="text-muted small mb-0 fw-semibold">ลากิจ (ชม.)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-light p-4 rounded-4 text-center mb-4 border">
                        <h5 class="mb-2 fw-bold text-dark">สถิติเวลาเรียนรวม: <span id="summary-percentage" class="text-primary fw-extrabold">0</span>%</h5>
                        <div class="progress club-progress" style="height: 12px;">
                            <div id="summary-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <h5 class="fw-bold mb-3 text-dark d-flex align-items-center">
                        <i class="bx bx-list-ul me-2 text-primary"></i>บันทึกการเช็คชื่อรายครั้ง
                    </h5>
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">วันที่จัดกิจกรรม</th>
                                    <th class="py-3">ชื่อกิจกรรม</th>
                                    <th class="py-3">สถานะ</th>
                                    <th class="py-3">จำนวนชั่วโมง</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-details-body">
                                <!-- JS will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>

<!-- Results Modal -->
<div class="modal fade" id="resultsModal" tabindex="-1" aria-labelledby="resultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center" id="resultsModalLabel">
                    <i class="bx bx-award me-2"></i>ประวัติผลการประเมินกิจกรรมชุมนุม
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="results-modal-loader" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">กำลังโหลด...</span>
                    </div>
                </div>
                <div id="results-modal-content-area" class="d-none">
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">ปีการศึกษา</th>
                                    <th class="py-3">ภาคเรียน</th>
                                    <th class="py-3">ชื่อชุมนุม</th>
                                    <th class="py-3 text-center">ผลประเมิน</th>
                                    <th class="py-3 text-center">ระดับผลการเรียน</th>
                                </tr>
                            </thead>
                            <tbody id="results-details-body">
                                <!-- JS will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>

<!-- History Modal -->
<?php if (!empty($student_club_history)): ?>
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center" id="historyModalLabel">
                    <i class="bx bx-history me-2"></i>ประวัติการเข้าร่วมกิจกรรมชุมนุม
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">ปีการศึกษา / ภาคเรียน</th>
                                <th class="py-3">ชื่อชุมนุม</th>
                                <th class="py-3">ครูที่ปรึกษา</th>
                                <th class="py-3 text-center">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($student_club_history as $hist): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= esc($hist['club_year']) ?> / ภาคเรียนที่ <?= esc($hist['club_trem']) ?></td>
                                    <td class="fw-semibold text-primary"><?= esc($hist['club_name']) ?></td>
                                    <td><?= esc($hist['advisor_names']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('club/view/' . $hist['club_id']) ?>" class="btn btn-primary btn-sm rounded-pill px-3 py-1.5">
                                            <i class="bx bx-show me-1"></i>ดูรายละเอียด
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Countdown Timer
    const timerElement = document.getElementById('countdown-timer');
    if (timerElement) {
        const endTime = new Date(timerElement.dataset.endTime.replace(' ', 'T')).getTime();

        const countdown = setInterval(function() {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance < 0) {
                clearInterval(countdown);
                timerElement.innerHTML = "(หมดเวลาการลงทะเบียนแล้ว)";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            let timerString = "เหลือเวลารับสมัครอีก: ";
            if (days > 0) timerString += days + " วัน ";
            if (hours > 0 || days > 0) timerString += hours + " ชั่วโมง ";
            if (minutes > 0 || hours > 0 || days > 0) timerString += minutes + " นาที ";
            timerString += seconds + " วินาที";

            timerElement.innerHTML = `<i class="bx bx-time-five animate-pulse me-1"></i> (${timerString})`;
        }, 1000);
    }

    // Search Filtering
    const searchInput = document.getElementById('club-search');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase().trim();
            document.querySelectorAll('.club-card-container').forEach(container => {
                const name = container.querySelector('.club-name-text').textContent.toLowerCase();
                const advisor = container.querySelector('.club-advisor-text').textContent.toLowerCase();
                if (name.includes(query) || advisor.includes(query)) {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });
        });
    }

    // Join Club AJAX Action
    const joinButtons = document.querySelectorAll('.join-club-btn');
    joinButtons.forEach(button => {
        button.addEventListener('click', function () {
            const clubId = this.dataset.clubId;
            const clubName = this.dataset.clubName;

            Swal.fire({
                title: 'ยืนยันการสมัครเข้าร่วม',
                text: `คุณต้องการสมัครเข้าร่วมชุมนุม "${clubName}" ใช่หรือไม่?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#e83e8c',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'ตกลง, เข้าร่วมชุมนุม!',
                cancelButtonText: 'ยกเลิก',
                customClass: {
                    popup: 'rounded-4 shadow'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('<?= base_url('club/join') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ club_id: clubId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'สมัครเข้าร่วมสำเร็จ!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonColor: '#e83e8c'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'ไม่สามารถดำเนินการได้',
                                text: data.message,
                                icon: 'error',
                                confirmButtonColor: '#e83e8c'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ในขณะนี้',
                            icon: 'error',
                            confirmButtonColor: '#e83e8c'
                        });
                    });
                }
            });
        });
    });

    // Cancel Club AJAX Action
    const cancelButtons = document.querySelectorAll('.cancel-club-btn');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function () {
            const clubId = this.dataset.clubId;
            const clubName = this.dataset.clubName;

            fetch('<?= base_url('club/remaining-changes') ?>', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                let remainingChanges = data.remaining_changes;
                let confirmationText = `คุณต้องการขอยกเลิกการเข้าร่วมชุมนุม "${clubName}" ใช่หรือไม่?`;
                let icon = 'warning';

                if (remainingChanges > 0) {
                    confirmationText += ` (คุณจะเหลือสิทธิ์เปลี่ยนชุมนุมได้อีก ${remainingChanges} ครั้งในภาคเรียนนี้)`;
                } else {
                    confirmationText = `คุณได้ใช้สิทธิ์ขอเปลี่ยนชุมนุมครบจำนวน 2 ครั้งสูงสุดแล้ว ไม่สามารถดำเนินการเปลี่ยนย้ายชุมนุมได้อีกในเทอมนี้`;
                    icon = 'error';
                }

                Swal.fire({
                    title: remainingChanges > 0 ? 'ยืนยันการยกเลิกชุมนุม' : 'ไม่สามารถดำเนินการได้',
                    text: confirmationText,
                    icon: icon,
                    showCancelButton: remainingChanges > 0,
                    confirmButtonColor: remainingChanges > 0 ? '#ef4444' : '#e83e8c',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: remainingChanges > 0 ? 'ใช่, ยกเลิกและย้ายชุมนุม' : 'ตกลง',
                    cancelButtonText: 'กลับหน้าเดิม'
                }).then((result) => {
                    if (result.isConfirmed && remainingChanges > 0) {
                        fetch('<?= base_url('club/cancel') ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({ club_id: clubId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'ยกเลิกการเข้าร่วมแล้ว!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonColor: '#e83e8c'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'เกิดข้อผิดพลาด',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonColor: '#e83e8c'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาด',
                                text: 'การขอเปลี่ยนย้ายชุมนุมล้มเหลว',
                                icon: 'error',
                                confirmButtonColor: '#e83e8c'
                            });
                        });
                    }
                });
            })
            .catch(error => {
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถติดต่อข้อมูลสิทธิ์การย้ายได้ในขณะนี้',
                    icon: 'error',
                    confirmButtonColor: '#e83e8c'
                });
            });
        });
    });

    // Attendance Modal logic
    const attendanceModal = new bootstrap.Modal(document.getElementById('attendanceModal'));
    const modalLoader = document.getElementById('modal-loader');
    const modalContent = document.getElementById('modal-content-area');
    const modalTitle = document.getElementById('attendanceModalLabel');

    const summaryPresent = document.getElementById('summary-present');
    const summaryAbsent = document.getElementById('summary-absent');
    const summarySick = document.getElementById('summary-sick');
    const summaryPersonal = document.getElementById('summary-personal');
    const summaryPercentage = document.getElementById('summary-percentage');
    const summaryProgressBar = document.getElementById('summary-progress-bar');
    const detailsBody = document.getElementById('attendance-details-body');

    document.querySelectorAll('.view-attendance-btn').forEach(button => {
        button.addEventListener('click', function () {
            const studentId = this.dataset.studentId;
            const clubId = this.dataset.clubId;
            const clubName = this.dataset.clubName;

            modalTitle.innerHTML = `<i class="bx bx-time-five me-2"></i>สรุปเวลาเรียน: ${clubName}`;
            modalLoader.classList.remove('d-none');
            modalContent.classList.add('d-none');
            attendanceModal.show();

            fetch(`<?= base_url('club/attendance-summary/') ?>${studentId}/${clubId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    summaryPresent.textContent = data.summary.present;
                    summaryAbsent.textContent = data.summary.absent;
                    summarySick.textContent = data.summary.sick_leave;
                    summaryPersonal.textContent = data.summary.personal_leave;
                    
                    const percentage = Math.round(data.percentage);
                    summaryPercentage.textContent = percentage;
                    summaryProgressBar.style.width = `${percentage}%`;
                    summaryProgressBar.setAttribute('aria-valuenow', percentage);
                    
                    summaryProgressBar.classList.remove('bg-danger', 'bg-warning', 'bg-success');
                    if(percentage >= 80) {
                        summaryProgressBar.classList.add('bg-success');
                    } else if (percentage >= 50) {
                        summaryProgressBar.classList.add('bg-warning');
                    } else {
                        summaryProgressBar.classList.add('bg-danger');
                    }

                    detailsBody.innerHTML = '';
                    if (data.details.length > 0) {
                        data.details.forEach(item => {
                            const row = `
                                <tr>
                                    <td class="fw-semibold text-dark">${new Date(item.date).toLocaleDateString('th-TH', {year: 'numeric', month: 'long', day: 'numeric'})}</td>
                                    <td>${item.activity_name}</td>
                                    <td><span class="badge ${item.status_class} rounded-pill px-2.5 py-1">${item.status}</span></td>
                                    <td class="fw-bold">${item.hours} ชม.</td>
                                </tr>
                            `;
                            detailsBody.innerHTML += row;
                        });
                    } else {
                        detailsBody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-muted">ไม่พบข้อมูลการเช็คชื่อเข้าร่วมกิจกรรมรายชั่วโมง</td></tr>';
                    }

                    modalLoader.classList.add('d-none');
                    modalContent.classList.remove('d-none');
                })
                .catch(error => {
                    modalContent.innerHTML = '<p class="text-danger text-center py-5">เกิดข้อผิดพลาดในการโหลดข้อมูลสถิติเวลาเรียน</p>';
                    modalLoader.classList.add('d-none');
                    modalContent.classList.remove('d-none');
                });
        });
    });

    // Results Modal logic
    const resultsModal = new bootstrap.Modal(document.getElementById('resultsModal'));
    const resultsModalLoader = document.getElementById('results-modal-loader');
    const resultsModalContent = document.getElementById('results-modal-content-area');
    const resultsBody = document.getElementById('results-details-body');

    const viewResultsBtn = document.querySelector('.view-results-btn');
    if (viewResultsBtn) {
        viewResultsBtn.addEventListener('click', function () {
            resultsModalLoader.classList.remove('d-none');
            resultsModalContent.classList.add('d-none');
            resultsModal.show();

            fetch(`<?= base_url('club/results-summary') ?>`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                resultsBody.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(result => {
                        const status_class = (result.objective_result === 'ผ่าน') ? 'bg-label-success' : 'bg-label-danger';
                        const row = `
                            <tr>
                                <td class="fw-bold text-dark">${result.academic_year}</td>
                                <td>ภาคเรียนที่ ${result.academic_term}</td>
                                <td class="fw-semibold">${result.club_name}</td>
                                <td class="text-center"><span class="badge ${status_class} rounded-pill px-3 py-1.5">${result.objective_result}</span></td>
                                <td class="text-center fw-bold text-primary">${result.result_level || '-'}</td>
                            </tr>
                        `;
                        resultsBody.innerHTML += row;
                    });
                } else {
                    resultsBody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">ไม่พบประวัติข้อมูลผลการประเมินกิจกรรมชุมนุม</td></tr>';
                }

                resultsModalLoader.classList.add('d-none');
                resultsModalContent.classList.remove('d-none');
            })
            .catch(error => {
                resultsModalContent.innerHTML = '<p class="text-danger text-center py-5">เกิดข้อผิดพลาดในการโหลดประวัติประเมินกิจกรรม</p>';
                resultsModalLoader.classList.add('d-none');
                resultsModalContent.classList.remove('d-none');
            });
        });
    }
});
</script>
