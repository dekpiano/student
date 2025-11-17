# ภาพรวมระบบนักเรียน (Student Project)

## สรุป

โปรเจกต์นี้คือระบบสำหรับนักเรียน สร้างขึ้นโดยใช้เฟรมเวิร์ก CodeIgniter 4 เพื่อให้นักเรียนสามารถล็อกอินเข้ามาดูข้อมูลผลการเรียนของตนเองได้

## รายละเอียดทางเทคนิค

### 1. สถาปัตยกรรมและเทคโนโลยีหลัก
- **Framework:** CodeIgniter 4
- **Architecture:** Model-View-Controller (MVC)
- **Database:** เชื่อมต่อฐานข้อมูล MySQL 2 ชุด:
    - `skjacth_academic`: เป็นฐานข้อมูลหลักสำหรับข้อมูลด้านการเรียน
    - `skjacth_personnel`: เป็นฐานข้อมูลสำหรับบุคลากร (มีการใช้งานน้อย)

### 2. โครงสร้างไฟล์ที่สำคัญ
- `app/Config/Routes.php`: กำหนดเส้นทาง URL ของแอปพลิเคชัน
- `app/Config/Database.php`: ตั้งค่าการเชื่อมต่อฐานข้อมูล
- `app/Controllers/`: โฟลเดอร์หลักสำหรับจัดการ Logic ของระบบ
    - `ControlLogin.php`: จัดการการเข้าระบบและออกจากระบบ
    - `ControlDashboard.php`: หน้าหลักหลังจากล็อกอิน
    - `ControlDoGrade.php`: จัดการการแสดงผลการเรียน
- `app/Models/`: โฟลเดอร์สำหรับจัดการข้อมูล
    - `ModelsLogin.php`: ตรวจสอบข้อมูลการล็อกอินกับฐานข้อมูล
- `app/Views/`: โฟลเดอร์สำหรับแสดงผล
    - `Layout/`: chứa các file template หลัก (Header, Footer, Navbar)

### 3. การยืนยันตัวตน (Authentication)
- การล็อกอินทำงานผ่าน AJAX request ที่ถูกจัดการโดย `ControlLogin.php`
- Controller ที่ต้องการการยืนยันตัวตนจะมีการตรวจสอบ `session` ใน `__construct()` หากไม่มี session จะถูก redirect ไปยังหน้าล็อกอิน

### 4. การเข้าถึงข้อมูล (Data Access)
- มีการใช้ Model ของ CodeIgniter สำหรับการยืนยันตัวตน (`ModelsLogin`)
- มีการใช้คำสั่ง SQL query โดยตรงภายใน Controller (เช่นใน `ControlDoGrade.php`) เพื่อดึงข้อมูลที่ซับซ้อน

## !! ช่องโหว่ด้านความปลอดภัยที่สำคัญ !!

จากการตรวจสอบ `app/Models/ModelsLogin.php` พบว่าระบบมีการใช้ **`StudentIDNumber` (เลขประจำตัวประชาชนของนักเรียน) เป็นรหัสผ่านโดยตรง** โดยไม่มีการเข้ารหัส (Hashing) ใดๆ ซึ่งถือเป็นความเสี่ยงด้านความปลอดภัยที่ร้ายแรงมาก **ควรได้รับการแก้ไขโดยด่วน**
