# Google Workspace Service Account Key Configuration

เพื่อเปิดใช้งานการสร้างบัญชีผู้ใช้ใน **Google Workspace (@skj.ac.th)** แบบอัตโนมัติ ให้ทำตามขั้นตอนดังนี้:

1. สร้าง **Service Account** บน Google Cloud Console:
   - ไปที่ [Google Cloud Console](https://console.cloud.google.com/) -> APIs & Services -> Credentials
   - สร้าง Service Account และดาวน์โหลดไฟล์ JSON Key
2. เปิดใช้งาน **Domain-Wide Delegation** ใน Google Workspace Admin ([admin.google.com](https://admin.google.com)):
   - ไปที่ Security -> Access and data control -> API controls -> Manage Domain Wide Delegation
   - เพิ่ม Client ID ของ Service Account
   - ระบุ Scope: `https://www.googleapis.com/auth/admin.directory.user`
3. วางไฟล์ JSON Key ที่ดาวน์โหลดมาไว้ที่นี่:
   `writable/keys/google_service_account.json`
4. ระบุอีเมลแอดมินโรงเรียนที่มีสิทธิ์ในไฟล์ `.env` หรือ `Config/App.php`:
   `GOOGLE_ADMIN_EMAIL=admin@skj.ac.th`
