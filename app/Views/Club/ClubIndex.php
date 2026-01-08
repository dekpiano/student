<style>
    .club-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .club-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .club-icon i {
        font-size: 3.5rem;
        color: #696cff;
    }
    .progress {
        height: 8px;
    }
    .registration-banner {
        background: linear-gradient(135deg, rgba(105, 108, 255, 0.1) 0%, rgba(105, 108, 255, 0) 100%);
        border-left: 5px solid #696cff;
    }
    .registration-banner.closed {
        background: linear-gradient(135deg, rgba(255, 62, 29, 0.1) 0%, rgba(255, 62, 29, 0) 100%);
        border-left-color: #ff3e1d;
    }
    .registration-banner.open {
        background: linear-gradient(135deg, rgba(113, 221, 55, 0.1) 0%, rgba(113, 221, 55, 0) 100%);
        border-left-color: #71dd37;
    }
</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">กิจกรรม /</span> เลือกชุมนุม
                <?php if (!empty($registration_period)): ?>
                    <span class="text-muted fw-light">
                        (เทอม <?= esc($registration_period['c_onoff_term']) ?> / ปีการศึกษา <?= esc($registration_period['c_onoff_year']) ?>)
                    </span>
                <?php endif; ?>
            </h4>
        </div>

        <!-- New Registration Status Alert -->
        <?php
        if (empty($registration_period)) {
            $banner_class = 'not-scheduled';
            $banner_icon = 'bx-calendar-exclamation';
            $banner_title = 'ยังไม่กำหนดช่วงเวลา กรุณารอ...';
            $banner_message = 'ยังไม่มีการกำหนดช่วงเวลาการลงทะเบียนสำหรับภาคเรียนนี้';
            $countdown_html = '';
        } else {
            $start_time = strtotime($registration_period['c_onoff_regisstart']);
            $end_time = strtotime($registration_period['c_onoff_regisend']);
            $now = time();

            if ($now < $start_time) {
                $banner_class = 'coming-soon';
                $banner_icon = 'bx-time-five';
                $banner_title = 'เร็วๆ นี้';
                $banner_message = 'ระบบจะเปิดให้ลงทะเบียนในวันที่ ' . date('d/m/Y H:i', $start_time) . ' น.';
                $countdown_html = '';
            } elseif ($now >= $start_time && $now <= $end_time) {
                $banner_class = 'open';
                $banner_icon = 'bx-check-circle';
                $banner_title = 'เปิดรับสมัครแล้ว!';
                $banner_message = 'ปิดรับสมัครในวันที่ ' . date('d/m/Y H:i', $end_time) . ' น.';
                $countdown_html = '<div id="countdown-timer" class="fs-5 fw-bold text-primary mt-1" data-end-time="' . $registration_period['c_onoff_regisend'] . '"></div>';
            } else {
                $banner_class = 'closed';
                $banner_icon = 'bx-x-circle';
                $banner_title = 'ปิดรับสมัครแล้ว';
                $banner_message = 'หมดเขตการลงทะเบียนสำหรับภาคเรียนนี้แล้ว';
                $countdown_html = '';
            }
        }
        ?>
        <?php if (empty($student_club)): ?>
        <div class="card shadow-sm border-0 mb-4 registration-banner <?= $banner_class ?>">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="me-4 text-primary">
                        <i class="bx <?= $banner_icon ?> " style="font-size: 3.5rem;"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1"><?= $banner_title ?></h4>
                        <p class="mb-0 fs-6"><?= $banner_message ?></p>
                        <?= $countdown_html ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>


        <!-- Main Content -->
        <?php if (!empty($student_club)): ?>
            <!-- Student Already in a Club -->
            <div class="card shadow-md border-0 overflow-hidden mb-4">
                <div class="card-header bg-primary text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-check-double fs-2 me-3"></i>
                            <h4 class="mb-0 text-white fw-bold">คุณลงทะเบียนล่วงหน้าสำเร็จแล้ว</h4>
                        </div>
                        <div class="registration-status-badge d-none d-md-block">
                            <?php if ($banner_class === 'open'): ?>
                                <span class="badge bg-white text-success px-3 py-2">
                                    <i class="bx bxs-circle bx-flashing me-1"></i> ระบบเปิดรับสมัครอยู่
                                </span>
                            <?php else: ?>
                                <span class="badge bg-white text-danger px-3 py-2">
                                    <i class="bx bx-lock-alt me-1"></i> ระบบปิดรับสมัครแล้ว
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-3 text-center">
                            <div class="club-avatar-circle mx-auto mb-3 shadow-sm d-flex align-items-center justify-content-center bg-label-primary rounded-circle" style="width: 120px; height: 120px;">
                                <i class="bx bx-group" style="font-size: 4rem; color: var(--primary-color);"></i>
                            </div>
                            <span class="badge bg-label-success px-3 py-2 rounded-pill">สถานะ: ยืนยันแล้ว</span>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-muted small text-uppercase mb-1 fw-semibold">ข้อมูลชุมนุม</h5>
                            <h2 class="fw-bold mb-3" style="color: var(--primary-color);"><?= esc($student_club['club_name']) ?></h2>
                            
                            <div class="row row-cols-1 row-cols-sm-2 g-3 mb-4">
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-square bg-light me-2 rounded p-2">
                                            <i class="bx bx-user-circle text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">ครูที่ปรึกษา</p>
                                            <p class="mb-0 fw-semibold"><?= esc($student_club['advisor_names']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-square bg-light me-2 rounded p-2">
                                            <i class="bx bx-calendar text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">ปีการศึกษา / ภาคเรียน</p>
                                            <p class="mb-0 fw-semibold"><?= esc($registration_period['c_onoff_year'] ?? $student_club['club_year']) ?> / <?= esc($registration_period['c_onoff_term'] ?? $student_club['club_trem']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-secondary mb-4"><?= esc($student_club['club_description']) ?: 'ไม่มีคำอธิบายสำหรับชุมนุมนี้' ?></p>
                            
                            <div class="d-flex flex-wrap gap-2">
                                <a href="<?= base_url('club/view/' . $student_club['club_id']) ?>" class="btn btn-primary px-4">
                                    <i class="bx bx-show-alt me-1"></i> รายละเอียด
                                </a>
                                <button type="button" class="btn btn-outline-primary view-attendance-btn"
                                    data-student-id="<?= esc(session()->get('UserId')) ?>"
                                    data-club-id="<?= esc($student_club['club_id']) ?>"
                                    data-club-name="<?= esc($student_club['club_name']) ?>">
                                    <i class="bx bx-time-five me-1"></i> เช็คชื่อ
                                </button>
                                <button type="button" class="btn btn-outline-secondary view-results-btn">
                                    <i class="bx bx-award me-1"></i> ผลประเมิน
                                </button>
                                
                                <?php if (!empty($registration_period) && time() >= strtotime($registration_period['c_onoff_regisstart']) && time() <= strtotime($registration_period['c_onoff_regisend'])): ?>
                                    <button 
                                        class="btn btn-link text-danger cancel-club-btn p-0 ms-md-auto" 
                                        data-club-id="<?= $student_club['club_id'] ?>" 
                                        data-club-name="<?= esc($student_club['club_name']) ?>">
                                        <i class="bx bx-transfer-alt me-1"></i> ต้องการเปลี่ยนชุมนุม?
                                    </button>
                                <?php else: ?>
                                    <div class="ms-md-auto d-flex align-items-center text-warning bg-label-warning px-2 py-1 rounded">
                                        <i class="bx bx-info-circle me-1"></i>
                                        <small>คุณได้เลือกชุมนุมนี้แล้ว ในปีการศึกษานี้ไม่อนุญาตให้เปลี่ยนอีกแล้ว</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (!empty($registration_period) && time() >= strtotime($registration_period['c_onoff_regisstart']) && time() <= strtotime($registration_period['c_onoff_regisend'])): ?>
            <!-- Club Listing (Only show if NOT in a club and period is OPEN) -->
            <div class="row">
                <?php if (empty($clubs)): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">ไม่มีชุมนุมที่เปิดรับสมัคร</h5>
                                <p class="card-text">ยังไม่มีชุมนุมที่เปิดรับสมัครในภาคเรียนนี้</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($clubs as $club): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card club-card h-100 border-0 shadow-sm">
                                <div class="card-body text-center d-flex flex-column">
                                    <?php
                                        $icon = 'bx-cube-alt'; // Default icon
                                        if (strpos($club['club_name'], 'คอม') !== false) $icon = 'bx-laptop';
                                        if (strpos($club['club_name'], 'ภาษา') !== false) $icon = 'bx-book';
                                        if (strpos($club['club_name'], 'กีฬา') !== false) $icon = 'bx-football';
                                        if (strpos($club['club_name'], 'ดนตรี') !== false) $icon = 'bx-music';
                                        if (strpos($club['club_name'], 'ศิลปะ') !== false) $icon = 'bx-palette';
                                    ?>
                                    <!-- <div class="club-icon mb-3">
                                        <i class="bx <?= $icon ?> bx-lg"></i>
                                    </div> -->
                                    
                                    <h5 class="card-title fw-bold">ชุมนุม <?= esc($club['club_name']) ?></h5>
                                    
                                                                         <p class="card-subtitle text-muted mb-3">
                                                                            <i class="bx bx-user-circle me-1"></i>
                                                                            ครูที่ปรึกษา : <?= esc($club['advisor_names']) ?>
                                                                        </p>
                                                                        <p class="card-subtitle text-muted mb-3">
                                                                            <i class="bx bx-group me-1"></i>
                                                                            ระดับชั้นที่เปิดรับ : <?= esc($club['club_level']) ?>
                                                                        </p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <small>สมาชิก</small>
                                            <small><?= $club['member_count'] ?> / <?= $club['club_max_participants'] ?></small>
                                        </div>
                                        <div class="progress mb-3" style="height: 8px;">
                                            <?php $percentage = ($club['club_max_participants'] > 0) ? ($club['member_count'] / $club['club_max_participants']) * 100 : 0; ?>
                                            <div class="progress-bar" role="progressbar" style="width: <?= $percentage ?>%;" aria-valuenow="<?= $club['member_count'] ?>" aria-valuemin="0" aria-valuemax="<?= $club['club_max_participants'] ?>"></div>
                                        </div>
                                        
                                        <?php $is_full = $club['member_count'] >= $club['club_max_participants']; ?>
                                        <a href="<?= base_url('club/view/' . $club['club_id']) ?>" class="btn btn-outline-secondary btn-sm">รายละเอียด</a>
                                        <button 
                                            class="btn btn-primary btn-sm join-club-btn" 
                                            data-club-id="<?= $club['club_id'] ?>" 
                                            data-club-name="<?= esc($club['club_name']) ?>"
                                            <?= $is_full ? 'disabled' : '' ?>>
                                            <?= $is_full ? 'เต็มแล้ว' : 'เข้าร่วม' ?>
                                        </button>
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
                timerElement.innerHTML = "(หมดเวลาแล้ว)";
                // Optionally, reload the page to show the 'closed' state
                // window.location.reload(); 
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            let timerString = "เหลือเวลาอีก: ";
            if (days > 0) timerString += days + " วัน ";
            if (hours > 0 || days > 0) timerString += hours + " ชั่วโมง ";
            if (minutes > 0 || hours > 0 || days > 0) timerString += minutes + " นาที ";
            timerString += seconds + " วินาที";

            timerElement.innerHTML = `(${timerString})`;
        }, 1000);
    }

    const joinButtons = document.querySelectorAll('.join-club-btn');
    joinButtons.forEach(button => {
        button.addEventListener('click', function () {
            const clubId = this.dataset.clubId;
            const clubName = this.dataset.clubName;

            Swal.fire({
                title: 'ยืนยันการเข้าร่วม',
                text: `คุณต้องการเข้าร่วมชุมนุม "${clubName}" ใช่หรือไม่?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, เข้าร่วมเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX request to join the club
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
                                title: 'สำเร็จ!',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'ผิดพลาด!',
                                text: data.message,
                                icon: 'error'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'ผิดพลาด!',
                            text: 'เกิดข้อผิดพลาดในการส่งข้อมูล',
                            icon: 'error'
                        });
                    });
                }
            });
        });
    });

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
                let confirmationText = `คุณต้องการยกเลิกการเข้าร่วมชุมนุม "${clubName}" ใช่หรือไม่?`;
                let icon = 'warning';

                if (remainingChanges > 0) {
                    confirmationText += ` คุณเหลือสิทธิ์เปลี่ยนชุมนุมอีก ${remainingChanges} ครั้งในภาคเรียนนี้`;
                } else {
                    confirmationText = `คุณได้ใช้สิทธิ์เปลี่ยนชุมนุมครบ 2 ครั้งแล้วในภาคเรียนนี้ คุณไม่สามารถเปลี่ยนชุมนุมได้อีก`;
                    icon = 'error';
                }

                Swal.fire({
                    title: 'ยืนยันการยกเลิก',
                    text: confirmationText,
                    icon: icon,
                    showCancelButton: remainingChanges > 0, // Only show cancel button if changes are allowed
                    confirmButtonColor: remainingChanges > 0 ? '#d33' : '#3085d6',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: remainingChanges > 0 ? 'ใช่, ยกเลิกเลย!' : 'รับทราบ',
                    cancelButtonText: 'ไม่, เก็บไว้ก่อน'
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
                                    title: 'สำเร็จ!',
                                    text: data.message + (data.remaining_changes !== undefined ? ` คุณเหลือสิทธิ์เปลี่ยนชุมนุมอีก ${data.remaining_changes} ครั้งในภาคเรียนนี้` : ''),
                                    icon: 'success'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'ผิดพลาด!',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'ผิดพลาด!',
                                text: 'เกิดข้อผิดพลาดในการส่งข้อมูล',
                                icon: 'error'
                            });
                        });
                    } else if (result.isConfirmed && remainingChanges <= 0) {
                        // If user clicks "OK" on the error message, just close it.
                        // No action needed as they can't change clubs.
                    }
                });
            })
            .catch(error => {
                Swal.fire({
                    title: 'ผิดพลาด!',
                    text: 'เกิดข้อผิดพลาดในการตรวจสอบสิทธิ์การเปลี่ยนชุมนุม',
                    icon: 'error'
                });
            });
        });
    });

    // Attendance Modal Logic
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

            modalTitle.textContent = `สรุปเวลาเรียน: ${clubName}`;
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
                    // Populate summary
                    summaryPresent.textContent = data.summary.present;
                    summaryAbsent.textContent = data.summary.absent;
                    summarySick.textContent = data.summary.sick_leave;
                    summaryPersonal.textContent = data.summary.personal_leave;
                    
                    const percentage = Math.round(data.percentage);
                    summaryPercentage.textContent = percentage;
                    summaryProgressBar.style.width = `${percentage}%`;
                    summaryProgressBar.setAttribute('aria-valuenow', percentage);
                    
                    if(percentage >= 80) {
                        summaryProgressBar.classList.remove('bg-danger', 'bg-warning');
                        summaryProgressBar.classList.add('bg-success');
                    } else if (percentage >= 50) {
                        summaryProgressBar.classList.remove('bg-danger', 'bg-success');
                        summaryProgressBar.classList.add('bg-warning');
                    } else {
                        summaryProgressBar.classList.remove('bg-success', 'bg-warning');
                        summaryProgressBar.classList.add('bg-danger');
                    }


                    // Populate details table
                    detailsBody.innerHTML = '';
                    if (data.details.length > 0) {
                        data.details.forEach(item => {
                            const row = `
                                <tr>
                                    <td>${new Date(item.date).toLocaleDateString('th-TH')}</td>
                                    <td>${item.activity_name}</td>
                                    <td><span class="badge ${item.status_class}">${item.status}</span></td>
                                    <td>${item.hours}</td>
                                </tr>
                            `;
                            detailsBody.innerHTML += row;
                        });
                    } else {
                        detailsBody.innerHTML = '<tr><td colspan="4" class="text-center">ไม่พบข้อมูลรายละเอียด</td></tr>';
                    }

                    modalLoader.classList.add('d-none');
                    modalContent.classList.remove('d-none');
                })
                .catch(error => {
                    modalContent.innerHTML = '<p class="text-danger">เกิดข้อผิดพลาดในการโหลดข้อมูล</p>';
                    modalLoader.classList.add('d-none');
                    modalContent.classList.remove('d-none');
                });
        });
    });

    // Results Modal Logic
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
                        const status_class = (result.objective_result === 'ผ่าน') ? 'bg-success' : 'bg-danger';
                        const row = `
                            <tr>
                                <td>${result.academic_year}</td>
                                <td>${result.academic_term}</td>
                                <td>${result.club_name}</td>
                                <td><span class="badge ${status_class}">${result.objective_result}</span></td>
                                <td>${result.result_level}</td>
                            </tr>
                        `;
                        resultsBody.innerHTML += row;
                    });
                } else {
                    resultsBody.innerHTML = '<tr><td colspan="5" class="text-center">ไม่พบข้อมูลผลกิจกรรมชุมนุม</td></tr>';
                }

                resultsModalLoader.classList.add('d-none');
                resultsModalContent.classList.remove('d-none');
            })
            .catch(error => {
                resultsModalContent.innerHTML = '<p class="text-danger">เกิดข้อผิดพลาดในการโหลดข้อมูล</p>';
                resultsModalLoader.classList.add('d-none');
                resultsModalContent.classList.remove('d-none');
            });
        });
    }
});
</script>

<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModalLabel">สรุปเวลาเรียน: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-loader" class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div id="modal-content-area" class="d-none">
                    <div class="row text-center mb-3">
                        <div class="col">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title text-white" id="summary-present">0</h5>
                                    <p class="card-text">มา (ชม.)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5 class="card-title text-white" id="summary-absent">0</h5>
                                    <p class="card-text">ขาด (ชม.)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-warning text-dark">
                                <div class="card-body">
                                    <h5 class="card-title" id="summary-sick">0</h5>
                                    <p class="card-text">ลาป่วย (ชม.)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title text-white" id="summary-personal">0</h5>
                                    <p class="card-text">ลากิจ (ชม.)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <h5>เวลาเรียนทั้งหมด: <span id="summary-percentage" class="fw-bold">0</span>%</h5>
                        <div class="progress">
                            <div id="summary-progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <h5 class="mt-4">รายละเอียด</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>วันที่</th>
                                    <th>กิจกรรม</th>
                                    <th>สถานะ</th>
                                    <th>ชั่วโมง</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-details-body">
                                <!-- JS will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<!-- Results Modal -->
<div class="modal fade" id="resultsModal" tabindex="-1" aria-labelledby="resultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultsModalLabel">ประวัติผลกิจกรรมชุมนุม</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="results-modal-loader" class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div id="results-modal-content-area" class="d-none">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ปีการศึกษา</th>
                                    <th>ภาคเรียน</th>
                                    <th>ชุมนุม</th>
                                    <th>ผลการประเมิน</th>
                                    <th>ระดับ</th>
                                </tr>
                            </thead>
                            <tbody id="results-details-body">
                                <!-- JS will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
