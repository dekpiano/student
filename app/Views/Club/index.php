<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">กิจกรรม /</span> เลือกชุมนุม</h4>

        <!-- Registration Period Notice -->
        <?php if (empty($registration_period) || time() < strtotime($registration_period['c_onoff_regisstart']) || time() > strtotime($registration_period['c_onoff_regisend'])): ?>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">ยังไม่เปิดให้ลงทะเบียน</h5>
                    <p class="card-text">
                        <?php if (!empty($registration_period)): ?>
                            ระบบจะเปิดให้ลงทะเบียนระหว่างวันที่ <?= date('d/m/Y H:i', strtotime($registration_period['c_onoff_regisstart'])) ?> ถึง <?= date('d/m/Y H:i', strtotime($registration_period['c_onoff_regisend'])) ?>
                        <?php else: ?>
                            ยังไม่มีการกำหนดช่วงเวลาการลงทะเบียนสำหรับภาคเรียนนี้
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php elseif (!empty($student_club)): ?>
            <!-- Student Already in a Club -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">คุณได้เข้าร่วมชุมนุมแล้ว</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">คุณเป็นสมาชิกของชุมนุม:</h6>
                    <h4><?= esc($student_club['club_name']) ?></h4>
                    <p><?= esc($student_club['club_description']) ?></p>
                    <a href="<?= base_url('club/view/' . $student_club['club_id']) ?>" class="btn btn-primary">ดูรายละเอียดชุมนุม</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Club Listing -->
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
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($club['club_name']) ?></h5>
                                    <h6 class="card-subtitle text-muted mb-2">ครูที่ปรึกษา: <?= esc($club['advisor_names']) ?></h6>
                                    <p class="card-text"><?= esc(mb_strimwidth($club['club_description'], 0, 100, '...')) ?></p>
                                    
                                    <?php 
                                        $is_full = $club['member_count'] >= $club['club_max_participants'];
                                    ?>

                                    <p class="card-text">
                                        <small class="text-muted">
                                            จำนวนสมาชิก: 
                                            <span class="fw-bold <?= $is_full ? 'text-danger' : 'text-success' ?>">
                                                <?= $club['member_count'] ?> / <?= $club['club_max_participants'] ?>
                                            </span>
                                        </small>
                                    </p>
                                    
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
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
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
});
</script>
