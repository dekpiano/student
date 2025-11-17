<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">กิจกรรม / <a href="<?= base_url('club') ?>">เลือกชุมนุม</a> /</span> รายละเอียด
        </h4>

        <?php if (!empty($club)): ?>
            <!-- Club Details Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0"><?= esc($club['club_name']) ?></h4>
                    <small class="text-muted">ปีการศึกษา <?= esc($club['club_year']) ?> / ภาคเรียนที่ <?= esc($club['club_trem']) ?></small>
                </div>
                <div class="card-body">
                    <p><strong>ครูที่ปรึกษา:</strong> <?= esc($club['advisor_names']) ?></p>
                    <p><strong>คำอธิบาย:</strong> <?= esc($club['club_description']) ?></p>
                    <p><strong>ระดับชั้น:</strong> <?= esc($club['club_level'] ?? 'ทุกระดับชั้น') ?></p>
                    <p>
                        <strong>จำนวนสมาชิก:</strong> 
                        <span class="fw-bold <?= ($club['member_count'] >= $club['club_max_participants']) ? 'text-danger' : 'text-success' ?>">
                            <?= $club['member_count'] ?> / <?= $club['club_max_participants'] ?>
                        </span>
                    </p>
                </div>
            </div>

            <div class="row">
                <!-- Objectives -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">วัตถุประสงค์</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($objectives)): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($objectives as $objective): ?>
                                        <li class="list-group-item"><?= esc($objective['objective_name']) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>ยังไม่มีการกำหนดวัตถุประสงค์</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Members -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">สมาชิก</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($members)): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($members as $member): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= esc($member['StudentPrefix'] . $member['StudentFirstName'] . ' ' . $member['StudentLastName']) ?>
                                            <?php if ($member['member_role'] === 'Leader'): ?>
                                                <span class="badge bg-primary">หัวหน้า</span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>ยังไม่มีสมาชิก</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activities -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">กิจกรรม</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ชื่อกิจกรรม</th>
                                    <th>วันที่</th>
                                    <th>สถานที่</th>
                                    <th>เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($activities)): ?>
                                    <?php foreach ($activities as $activity): ?>
                                        <tr>
                                            <td><?= esc($activity['act_name']) ?></td>
                                            <td><?= date('d/m/Y', strtotime($activity['act_date'])) ?></td>
                                            <td><?= esc($activity['act_location']) ?></td>
                                            <td><?= date('H:i', strtotime($activity['act_start_time'])) ?> - <?= date('H:i', strtotime($activity['act_end_time'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">ยังไม่มีกิจกรรม</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">ไม่พบข้อมูลชุมนุม</h5>
                    <p class="card-text">ไม่พบข้อมูลสำหรับชุมนุมที่คุณต้องการดู</p>
                    <a href="<?= base_url('club') ?>" class="btn btn-primary">กลับไปหน้ารายการ</a>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="<?= base_url('club') ?>" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> กลับไปหน้ารายการ
            </a>
        </div>
    </div>
</div>
