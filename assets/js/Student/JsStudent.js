$(document).on('submit','#formStudentLogin', function(e) {
    e.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

    var formData = $(this).serialize();
    
    $.ajax({
        url: 'Login',
        type: 'POST',
        data: formData,
        beforeSend: function() {
            $(this).attr('disabled', 'disabled');
        },
        success: function(response) {
            //console.log(response);
            if(response == 0){
                Swal.fire({
                    title: "แจ้งเตือน?",
                    text: "ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง ? <br> ติดต่อฝ่ายทะเบียน วิชาการ",
                    icon: "error"
                  });
            }else{
                window.location.href = 'Dashboard';
            }
            // $(this).removeAttr('disabled');
            // if(response.success) {
            //     window.location.href = '555';
            // } else {
            //     $('#errorMsg').text(response.message).show();
            // }
        },
        error: function(xhr, status, error) {
            $(this).removeAttr('disabled');
            var response = JSON.parse(xhr.responseText);
            $('#errorMsg').text(response.message).show();
        }
    });
});