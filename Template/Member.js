$(document).ready(function () {
    if( $('#frmMemberInformation').length){
        $('#frmMemberInformation #avatar').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
        $('#btnUpdateInformation').click(function(){
            common.showLoading();
            $('.invalid-feedback').html('');
            $('.invalid-feedback').css('display','none');
            var form = $('#frmMemberInformation')[0];
            // Create an FormData object
            var data = new FormData(form);
            $.ajax({
                url : HTTPSERVER+'Member/UpdateInformation.api',
                enctype: 'multipart/form-data',
                type : 'POST',
                data : data,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success : function(result) {
                    common.endLoading();
                    result = JSON.parse(result);
                    if (result.statuscode) {
                        console.log(result);

                        $.alert({
                            title: 'Thông báo',
                            content: 'Cập nhật thông tin thành công!',
                        });
                        window.location = "<?php echo $this->request->createLink('member-page')?>";
                    } else {
                        var errors = new Array();
                        for (const key in result.data) {
                            $('.' + key).html(result.data[key]);
                            $('.' + key).css('display', 'block');
                            errors.push(result.data[key])
                        }
                        $.alert({
                            title: 'Cảnh báo',
                            content: errors.join('<br>'),
                        });
                    }

                },
                error: function (e) {
                    common.endLoading();

                }
            });
        });
        $('#frmMemberInformation #firstname').change(function(){
            $('#frmMemberInformation #fullname').val($('#frmMemberInformation #lastname').val()+' '+$('#frmMemberInformation #firstname').val());
        });
        $('#frmMemberInformation #lastname').change(function(){
            $('#frmMemberInformation #fullname').val($('#frmMemberInformation #lastname').val()+' '+$('#frmMemberInformation #firstname').val());
        });
        common.processLocation('frmMemberInformation',"<?php echo $this->member['wardid']?>");
    }
    if( $('#frmChangePassword').length){
        $('#btnChangePassword').click(function(){
            common.showLoading();
            $('.invalid-feedback').html('');
            $('.invalid-feedback').css('display','none');
            var form = $('#frmChangePassword')[0];
            // Create an FormData object
            var data = new FormData(form);
            $.ajax({
                url : HTTPSERVER+'Member/ChangePassword.api',
                enctype: 'multipart/form-data',
                type : 'POST',
                data : data,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success : function(result) {
                    common.endLoading();
                    result = JSON.parse(result);
                    if (result.statuscode) {
                        console.log(result);

                        $.alert({
                            title: 'Thông báo',
                            content: 'Thay đổi mật khẩu thành công!',
                        });
                        window.location = "<?php echo $this->request->createLink('member-page')?>";
                    } else {
                        var errors = new Array();
                        for (const key in result.data) {
                            $('.' + key).html(result.data[key]);
                            $('.' + key).css('display', 'block');
                            errors.push(result.data[key])
                        }
                        $.alert({
                            title: 'Cảnh báo',
                            content: errors.join('<br>'),
                        });
                    }

                },
                error: function (e) {
                    common.endLoading();

                }
            });
        });
    }
});