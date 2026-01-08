<style>
    :root {
        --primary-color: #e83e8c;
        --primary-gradient: linear-gradient(135deg, #e83e8c 0%, #b8266d 100%);
    }

    .grade-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: 0 0 2rem 2rem;
        padding-bottom: 4rem !important;
        margin-bottom: -3rem;
    }

    .selector-card {
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        z-index: 10;
    }

    .summary-stats {
        background: white;
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-top: 1rem;
    }

    .stat-item {
        text-align: center;
        flex: 1;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-color);
        display: block;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .subject-card {
        border: none;
        border-radius: 1rem;
        margin-bottom: 1rem;
        transition: transform 0.2s;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .subject-card:hover {
        transform: scale(1.02);
    }

    .grade-badge {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-weight: 800;
        font-size: 1.25rem;
    }

    .grade-A { background: #e8fadf; color: #71dd37; }
    .grade-B { background: #e7e7ff; color: #696cff; }
    .grade-C { background: #fff2e2; color: #ffab00; }
    .grade-D { background: #ffe5e5; color: #ff3e1d; }
    .grade-F { background: #ff3e1d; color: white; }

    /* Desktop Table Styling */
    .custom-table {
        border-radius: 1rem;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    .custom-table thead th {
        background: #f8f9fa;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        border-bottom: 2px solid #eee;
    }

    .sticky-summary {
        position: sticky;
        top: 20px;
        z-index: 100;
    }

    @media (max-width: 768px) {
        .grade-header {
            padding-top: 2rem !important;
        }
    }
</style>

<?php 
$selectedLevels  = explode("|",  $CheckOnoffDoGrade->onoff_Level);  
$SubClass1 = explode(".",session()->get('UserClass'));
$SubClass2 = explode("/",$SubClass1[1]);
$IfCechkLevel = (in_array($SubClass2[0],$selectedLevels))? true :"";
?>

<div class="content-wrapper">
    <!-- Header with Background -->
    <div class="grade-header p-5 text-center">
        <h2 class="text-white fw-bold mb-1">ผลการเรียนรายวิชา</h2>
        <p class="text-white opacity-75 mb-0">ชั้น <?= session()->get('UserClass') ?> | ภาคเรียนที่ <?= $uri->getSegment(2) ?>/<?= $uri->getSegment(3) ?></p>
    </div>

    <div class="container-xxl flex-grow-1 container-p-y pt-0">
        
        <?php if($CheckOnoffDoGrade->onoff_status == "true" && $IfCechkLevel) :?>
            
            <!-- Selector Section -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card selector-card p-2 mt-n3 mb-4">
                        <div class="card-body py-3">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label class="form-label mb-0 fw-bold">เลือกเทอม:</label>
                                </div>
                                <div class="col-8">
                                    <select id="defaultSelect" class="form-select border-0 bg-light fw-bold text-center">
                                        <?php foreach ($CheckYearGradeUser as $key => $value):?>
                                        <option
                                            <?= ($uri->getSegment(2)."/".$uri->getSegment(3)) == $value->RegisterYear ?"selected":""?>
                                            value="<?=$value->RegisterYear;?>"><?=$value->RegisterYear;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            function compareAcademicYear($a, $b) {
                list($termA, $yearA) = explode('/', $a);
                list($termB, $yearB) = explode('/', $b);
                if ($yearA == $yearB) {
                    return $termA <=> $termB;
                }
                return $yearA <=> $yearB;
            }
            $first = ($uri->getSegment(2)."/".$uri->getSegment(3));
            $second = $CheckOnoffDoGrade->onoff_year;
            $Test = (compareAcademicYear($first, $second) <= 0) ? 1 : 0;
            ?>

            <?php if($Test) : ?>
                <!-- Summary Stats -->
                <div class="row justify-content-center mb-5">
                    <div class="col-12 col-md-8">
                        <div class="summary-stats d-flex shadow-sm">
                            <div class="stat-item border-end">
                                <span class="stat-value" id="totalGradeDisplay">-</span>
                                <span class="stat-label">เกรดเฉลี่ย (GPA)</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value" id="totalUnitDisplay">-</span>
                                <span class="stat-label">หน่วยกิตรวม</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subject List -->
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        
                        <!-- Mobile View: Cards -->
                        <div class="d-md-none">
                            <?php foreach ($Geade as $v_Geade) : 
                                $grade = $v_Geade->Grade;
                                $badgeClass = 'grade-B'; // Default
                                if (is_numeric($grade)) {
                                    if ($grade >= 4) $badgeClass = 'grade-A';
                                    elseif ($grade >= 3) $badgeClass = 'grade-B';
                                    elseif ($grade >= 2) $badgeClass = 'grade-C';
                                    elseif ($grade >= 1) $badgeClass = 'grade-D';
                                    else $badgeClass = 'grade-F';
                                }
                            ?>
                                <div class="card subject-card">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="text-muted small mb-1"><?= $v_Geade->SubjectCode ?></div>
                                                <h6 class="fw-bold mb-1"><?= $v_Geade->SubjectName ?></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-label-secondary me-2"><?= explode('/', $v_Geade->SubjectType)[1] ?></span>
                                                    <span class="text-muted small"><?= $v_Geade->SubjectUnit ?> หน่วยกิต</span>
                                                </div>
                                            </div>
                                            <div class="ms-3">
                                                <div class="grade-badge <?= $badgeClass ?> Grade"><?= ($grade !== null && $grade !== '') ? $grade : '-' ?></div>
                                                <span class="Unit d-none"><?= $v_Geade->SubjectUnit ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Desktop View: Table -->
                        <div class="d-none d-md-block">
                            <div class="card custom-table border-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-4">รหัสวิชา</th>
                                                <th>ชื่อวิชา</th>
                                                <th class="text-center">หน่วยกิต</th>
                                                <th class="text-center">ประเภท</th>
                                                <th class="text-center pe-4">เกรด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($Geade as $v_Geade) : ?>
                                                <tr>
                                                    <td class="ps-4 text-muted"><?= $v_Geade->SubjectCode ?></td>
                                                    <td class="fw-bold"><?= $v_Geade->SubjectName ?></td>
                                                    <td class="text-center Unit fw-bold"><?= $v_Geade->SubjectUnit ?></td>
                                                    <td class="text-center"><span class="badge bg-label-info"><?= explode('/', $v_Geade->SubjectType)[1] ?></span></td>
                                                    <td class="text-center pe-4 fw-black text-primary h5 mb-0 Grade"><?= $v_Geade->Grade ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php else : ?>
                <div class="text-center py-5">
                    <div class="mb-4">
                        <img src="<?=base_url('uploads/dograd/data-input.svg')?>" alt="Updating" height="200">
                    </div>
                    <h4 class="fw-bold">กำลังอัปเดตข้อมูล...</h4>
                    <p class="text-muted">ผลการเรียนปี <?= $uri->getSegment(2)."/".$uri->getSegment(3) ?> กำลังอยู่ระหว่างดำเนินการ</p>
                    <a href="<?= base_url('Dashboard') ?>" class="btn btn-outline-primary rounded-pill px-4">กลับหน้าหลัก</a>
                </div>
            <?php endif; ?>

        <?php else:?>
            <div class="text-center py-5">
                <div class="mb-4">
                    <img src="<?=base_url('uploads/404/404.png')?>" class="img-fluid" style="max-width: 300px;">
                </div>
                <h4 class="text-danger fw-bold">ระบบยังไม่เปิดให้เข้าชม</h4>
                <p class="text-muted">กรุณาติดตามประกาศจากฝ่ายวิชาการ</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
function calculateStats() {
    const unitCells = document.querySelectorAll('.Unit');
    const gradeCells = document.querySelectorAll('.Grade');
    
    let totalUnits = 0;
    let weightedPoints = 0;
    let validUnitsForGPA = 0;

    unitCells.forEach((cell, index) => {
        const units = parseFloat(cell.textContent) || 0;
        const gradeText = gradeCells[index].textContent.trim();
        
        totalUnits += units;

        // GPA Calculation: Check if grade is numeric
        if (!isNaN(parseFloat(gradeText))) {
            const gradePoints = parseFloat(gradeText);
            weightedPoints += (units * gradePoints);
            validUnitsForGPA += units;
        }
    });

    const gpa = validUnitsForGPA > 0 ? (weightedPoints / validUnitsForGPA).toFixed(2) : '-';
    
    document.getElementById('totalUnitDisplay').textContent = totalUnits.toFixed(1);
    document.getElementById('totalGradeDisplay').textContent = gpa;
}

window.addEventListener('load', calculateStats);
</script>
