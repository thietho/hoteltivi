$(document).ready(function() {
    if($('#btnConfirmBooking').length){
        $('#btnConfirmBooking').click(function() {
            common.showLoading();
            var url = HTTPSERVER+'TicketBooking/confirmBooking.api';
            $.post(url, $('#frmCustomerBooking').serialize(), function(result) {
                try {
                    result = JSON.parse(result);
                    if (result.statuscode) {
                        console.log(result);
                        window.location = result.link;
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
                        common.endLoading();
                    }
                } catch (error) {
                    common.endLoading();
                }
            });
        });
        common.processLocation('frmCustomerBooking',"<?php echo isset($this->member['wardid'])?$this->member['wardid']:'';?>");
    }
})

