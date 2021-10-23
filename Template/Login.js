$(document).ready(function (){
    if($('#frmLogin').length){
        $('#btnLogin').click(function (){
            common.showLoading();
            $('.invalid-feedback').html('');
            $('.invalid-feedback').css('display','none');
            $.post(HTTPSERVER+'Member/Login.api',$('#frmLogin').serialize(),function(result){
                common.endLoading();
                try {
                    result = JSON.parse(result);
                    if (result.statuscode) {
                        $.alert({
                            title: 'Đăng nhập thành công!',
                            content: 'Chúc mừng bạn đã đăng nhập thành công!',
                            onClose: function () {
                                // before the modal is hidden.
                                window.location = "<?php echo $this->request->createLink('member-page');?>";
                            },
                        });
                    } else {
                        $.alert({
                            title: "Đăng nhập không thành công",
                            content: result.data.password,
                        });
                        // for (const key in result.data) {
                        //     // $('.' + key).html(result.data[key]);
                        //     // $('.' + key).css('display', 'block');
                        //
                        // }
                    }
                } catch (error) {

                }
            });
        });
        $('#btnForgotPassword').click(function (){
            window.location = "<?php echo $this->request->createLink('foget-password');?>";
        });
    }
    if($('#frmForgotPassword').length){
        $('#btnResetPassword').click(function (){
            common.showLoading();
            $('.invalid-feedback').html('');
            $('.invalid-feedback').css('display','none');
            $.post(HTTPSERVER+'Member/ResetPassword.api',$('#frmForgotPassword').serialize(),function(result){
                common.endLoading();
                try {
                    result = JSON.parse(result);
                    if (result.statuscode) {
                        $.alert({
                            title: 'Cấp lại mật khẩu thành công!',
                            content: 'Chúc mừng bạn yêu cầu cấp lại mật khẩu thành công thành công! Mật khẩu mới đã gửi vào email đăng ký của bạn!',
                            onClose: function () {
                                // before the modal is hidden.
                                window.location = "<?php echo $this->request->createLink('login');?>";
                            },
                        });
                    } else {
                        for (const key in result.data) {
                            $('.' + key).html(result.data[key]);
                            $('.' + key).css('display', 'block');

                        }
                    }
                } catch (error) {

                }
            });
        });
        $('#btnReturnLogin').click(function (){
            window.location = "<?php echo $this->request->createLink('login');?>";
        });
    }
});