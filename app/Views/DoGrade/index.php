<div class="container-xxl flex-grow-1 container-p-y align-content-center">


<?php 
$selectedLevels  = explode("|",  $CheckOnoffDoGrade->onoff_Level);  
$SubClass1 = explode(".",session()->get('UserClass'));
$SubClass2 = explode("/",$SubClass1[1]);
$IfCechkLevel = (in_array($SubClass2[0],$selectedLevels))? true :"";

?>

    <?php if($CheckOnoffDoGrade->onoff_status == "true" && $IfCechkLevel) :?>
    
    <div class="text-center mb-6 d-flex justify-content-center">
        <div class="card" style="width: max-content;">
            <div class="card-body">
                <div class="">
                    <!--  btn-group-->
                    <div class="w-100 me-2 align-self-center">
                        <h3>ดูผลการเรียน</h3>
                    </div>
                    <select id="defaultSelect" class="form-select text-center">
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

    <?php 
    
    function compareAcademicYear($a, $b) {
        list($termA, $yearA) = explode('/', $a);
        list($termB, $yearB) = explode('/', $b);
    
        if ($yearA == $yearB) {
            return $termA <=> $termB; // เปรียบเทียบภาคเรียน ถ้าปีเท่ากัน
        }
        return $yearA <=> $yearB; // เปรียบเทียบปีการศึกษา
    }

    // ทดสอบเปรียบเทียบ
        $first = ($uri->getSegment(2)."/".$uri->getSegment(3));
        $second = $CheckOnoffDoGrade->onoff_year;
        if (compareAcademicYear($first, $second) < 0) {
           // echo "$first น้อยกว่า $second";
            $Test = 1;
        } elseif (compareAcademicYear($first, $second) > 0) {
            //echo "$first มากกว่า $second";
            $Test = 0;
        } else {
           // echo "$first เท่ากับ $second";
            $Test = 1;
        }
        ?>

    <?php if($Test) : ?>
    <div class="row justify-content-center">
        <div class="card col-12 col-md-7 p-0">
            <h5 class="card-header bg-primary text-white">ผลการเรียน ภาคเรียนที่
                <?=$uri->getSegment(2)?>/<?=$uri->getSegment(3)?></h5>
            <div class=" table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center bg-dark-subtle">
                            <th class="text-white">รหัสวิชา</th>
                            <th class="text-white">ชื่อวิชา</th>
                            <th class="text-white">ประเภท</th>
                            <th class="text-white">หน่วยกิต</th>
                            <th class="text-white">เกรด</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $SubjectAll = 0;
                    foreach ($Geade as $key => $v_Geade) : ?>
                        <tr>
                            <td class="text-center"><?=$v_Geade->SubjectCode?></td>
                            <td><?=$v_Geade->SubjectName?></td>
                            <?php $SubjectType = explode('/',$v_Geade->SubjectType); ?>
                            <td class="text-center"><?=$SubjectType[1]?></td>
                            <td class="Unit text-center"><?=$v_Geade->SubjectUnit?></td>
                            <td class="Grade text-center"><?=$v_Geade->Grade?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="text-center bg-dark-subtle">
                            <td colspan=3 class="text-white">รวมทั้งหมด <?=count($Geade);?> วิชา</td>
                            <td id="totalUnit" class="text-white"></td>
                            <td id="totalGrade" class="text-white"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php else : ?>
    <div class="text-center">
        <button type="button" class="btn btn-outline-primary">
            ผลการเรียน <?=($uri->getSegment(2)."/".$uri->getSegment(3))?> กำลังอัพเดพข้อมูลอยู่... โปรดรอ
        </button>
    </div>
    <div class="text-center p-4">
        <img src="<?=base_url('uploads/dograd/data-input.svg')?>" alt="กำลังอัพเดพข้อมูล" height="175">
    </div>
    <div class="text-center">
        สามารถดูผลการเรียนย้อนหลังได้แล้ว
    </div>
    <?php endif; ?>



    <?php else:?>
      
    <div class="row justify-content-center">
        <div class="col-md-4 ">
            <div class="alert alert-danger" role="alert">
               กำลังปรับปรุงระบบดูผลการเรียนอยู่ในขณะนี้... โปรดรอ
            </div>
            <img src="<?=base_url('uploads/404/404.png')?>" class="img-fluid" alt="">
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// ฟังก์ชันหาผลรวม
function sumUnit() {
    const Unit = document.querySelectorAll('.Unit'); // เลือกทุก cell ที่มี class "price"
    let total = 0;
    Unit.forEach(Units => {
        total += parseFloat(Units.textContent); // บวกค่าของแต่ละ cell
    });
    document.getElementById('totalUnit').textContent = total + ' หน่วยกิต'; // แสดงผลรวม
}

function sumGrade() {
    const Unit = document.querySelectorAll('.Unit'); // เลือกทุก cell ที่มี class "price"
    let totalUnit = 0;
    Unit.forEach(Units => {
        totalUnit += parseFloat(Units.textContent); // บวกค่าของแต่ละ cell
    });

    const Grade = document.querySelectorAll('.Grade'); // เลือกทุก cell ที่มี class "price"
    let SumGrade = 0;
    Grade.forEach(function callback(value, index) {
        if (value.textContent == "มส" || value.textContent == "" || value.textContent == "ร") {
            var G = 0;
        } else {
            var G = parseFloat(value.textContent);
        }
        SumGrade += parseFloat(Unit[index].textContent) * G /
            totalUnit; // บวกค่าของแต่ละ cell
    });
    var str = SumGrade;
    var shorter = String(str).substr(0, 4);
    document.getElementById('totalGrade').textContent = shorter; // แสดงผลรวม
}

// เรียกใช้ฟังก์ชันเมื่อโหลดหน้าเว็บ
window.onload = function() {
    sumUnit(); // เรียกฟังก์ชันหาผลรวม
    sumGrade(); // เรียกฟังก์ชันอื่นที่คุณต้องการ
};
</script>