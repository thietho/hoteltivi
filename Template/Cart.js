$(document).ready(function () {
    cart.cal();
    $('.cartquantity').change(function () {
        cart.cal();
        var productid = $(this).attr('productid');
        var quantity = $(this).val();
        cart.updateQuantity(productid,quantity);
    });
    $('#btnConfirmOrder').click(function () {
        cart.comfirmOrder($('#frmConfirmOrder').serialize(),function (result) {
            if(result.statuscode){
                $.alert({
                    title: 'Đặt hàng thành công!',
                    content: 'Chúc mừng bạn đã đặt hàng thành công',
                });
                window.location = result.link;
            }else {
                var arr = new Array();
                for (const i in result.errors) {
                    arr.push(result.errors[i]);
                }
                $.alert({
                    title: 'Lỗi!',
                    content: arr.join('<br>'),
                });
            }
        });
    });
    if($('#frmConfirmOrder').length){
        common.processLocation('frmConfirmOrder',"<?php echo isset($this->member['wardid'])?$this->member['wardid']:'';?>");
    }
});