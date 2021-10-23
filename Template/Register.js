$(document).ready(function(){
    if( $('#frmRegister').length){
        $('#btnRegister').click(function(){
            common.showLoading();
            $('.invalid-feedback').html('');
            $('.invalid-feedback').css('display','none');
            $.post(HTTPSERVER+'Member/Register.api',$('#frmRegister').serialize(),function(result){
                common.endLoading();
                try {
                    result = JSON.parse(result);
                    if (result.statuscode) {
                        console.log(result);
                        //window.location = result.link;
                        $.confirm({
                            title: 'Thông báo',
                            content: 'Simple confirm!',
                            buttons: {
                                goToActivePage: {
                                    text: 'Đi đến trang kích hoạt',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                        window.location = "<?php echo $this->request->createLink('activeaccount');?>";
                                    }
                                },
                                goToHomePage: {
                                    text: 'Trang chủ',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                        window.location = "<?php echo $this->request->createLink('');?>";
                                    }
                                }
                            }
                        });
                    } else {
                        var errors = new Array();
                        for (const key in result.data) {
                            // $('.' + key).html(result.data[key]);
                            // $('.' + key).css('display', 'block');
                            errors.push(result.data[key])
                        }
                        $.alert({
                            title: 'Cảnh báo',
                            content: errors.join('<br>'),
                        });
                    }
                } catch (error) {

                }
            });
        });
        $('#frmRegister #firstname').change(function(){
            $('#frmRegister #fullname').val($('#frmRegister #lastname').val()+' '+$('#frmRegister #firstname').val());
        });
        $('#frmRegister #lastname').change(function(){
            $('#frmRegister #fullname').val($('#frmRegister #lastname').val()+' '+$('#frmRegister #firstname').val());
        });
        common.processLocation('frmRegister');
    }
    if( $('#frmActive').length){
        $('#btnActive').click(function(){
            common.showLoading();
            $('.invalid-feedback').html('');
            $('.invalid-feedback').css('display','none');
            $.post(HTTPSERVER+'Member/Active.api',$('#frmActive').serialize(),function(result){
                common.endLoading();
                try {
                    result = JSON.parse(result);
                    if (result.statuscode) {
                        $.alert({
                            title: 'Kích hoạt thành công!',
                            content: 'Chúc mừng bạn đã kích hoạt tài khoản thành công! Vui lòng đăng nhập vào hệ thống',
                            onClose: function () {
                                // before the modal is hidden.
                                window.location = "<?php echo $this->request->createLink('login');?>";
                            },
                        });
                    } else {
                        var errors = new Array();
                        for (const key in result.data) {
                            // $('.' + key).html(result.data[key]);
                            // $('.' + key).css('display', 'block');
                            errors.push(result.data[key])
                        }
                        $.alert({
                            title: 'Cảnh báo',
                            content: errors.join('<br>'),
                        });

                    }
                } catch (error) {

                }
            });
        });
    }
});
