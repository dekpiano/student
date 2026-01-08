$(document).on('submit','#formStudentLogin', function(e) {
    e.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

    var formData = $(this).serialize();
    
    $.ajax({
        url: 'Login',
        type: 'POST',
        data: formData,
        beforeSend: function() {
            $('#SubLogin').find('.spinner-border').show();
            $('#SubLogin').attr('disabled', 'disabled');
        },
        success: function(response) {
            if(response.status == 0){
                Swal.fire({
                    title: "แจ้งเตือน?",
                    html: response.message + " <br> ติดต่อฝ่ายทะเบียน วิชาการ",
                    icon: "error"
                  });
                  $('#SubLogin').find('.spinner-border').hide();
                  $('#SubLogin').attr('disabled', false);
            }else{
                window.location.href = response.redirect;
            }
        },
        error: function(xhr, status, error) {
            $('#SubLogin').find('.spinner-border').hide();
            $('#SubLogin').attr('disabled', false);
            Swal.fire({
                title: "เกิดข้อผิดพลาด!",
                text: "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ กรุณาลองใหม่ภายหลัง",
                icon: "error"
            });
        }
    });
});

$(document).on('change','#defaultSelect', function() {
    window.location.href = "../../DoGrade/"+$(this).val();
});
