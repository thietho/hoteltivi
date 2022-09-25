window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    if (service.lockui == false) {
        switch (event.keyCode) {
            case 13:
                if (service.popupshow == false) {
                    if(service.index >= 0){
                        var foodid = $('#main-region [index=' + service.index + ']').attr('foodid');
                        var foodname = $('#main-region [index=' + service.index + ']').attr('foodname');
                        var price = $('#main-region [index=' + service.index + ']').attr('price');
                        $('#foodid').val(foodid);
                        $('#foodname').val(foodname);
                        $('#price').val(price);
                        $('#food-order-popup').modal();
                        $('#food-order-popup .modal-title').html(foodname);
                        $('#food-order-popup .food-price span').html(common.formateNumber(price));
                    }else {
                        FoodOrder.openBasket();
                    }
                }else {
                    if(FoodOrder.basketOpen == false){
                        if($('.btn-handle').hasClass('btn-ok')){
                            var foodid = $('#foodid').val();
                            var foodname = $('#foodname').val();
                            var price = $('#price').val();
                            var quantity = $('.quantity').val();
                            FoodOrder.add(foodid,foodname,price,quantity);
                        }else {
                            $('#food-order-popup').modal('hide')
                        }

                    }else {
                        var action = $('#basket-popup .serviceselect').attr('action')!=undefined?$('#basket-popup .serviceselect').attr('action'):'';
                        switch (action) {
                            case 'back':
                                FoodOrder.updateOrder();
                                break;
                            case 'emptybasket':
                                FoodOrder.emptyOrder();
                                break;
                            case 'ordernow':
                                FoodOrder.orderFood();
                                break;
                        }
                    }
                }
                break;
            case 38: //Move top
                if (service.popupshow == false) {
                    if (service.index - 1 >= 0) {
                        service.index -= 1;
                        service.selectService();
                    }
                }else {
                    if(FoodOrder.basketOpen == true){
                        FoodOrder.selectMoveUp();
                    }
                    if(service.popupshow){
                        var quantity = Number($('.quantity').val());
                        $('.quantity').val(quantity+1);
                    }
                }

                break;
            case 40: //Move down
                if (service.popupshow == false) {
                    if (service.index < service.max) {
                        service.index += 1;
                        service.selectService();
                    }
                } else {
                    if (FoodOrder.basketOpen == true) {
                        FoodOrder.selectMoveDown();
                    }
                    if(service.popupshow){
                        var quantity = Number($('.quantity').val());
                        if(quantity > 1){
                            $('.quantity').val(quantity-1);
                        }
                    }
                }
                break;
            case 37: //Move left
                if(FoodOrder.basketOpen){
                    FoodOrder.selectReduce();
                }else {
                    if (service.popupshow == false) {
                        if (service.index - service.rows >= 0) {
                            service.index -= service.rows;
                            $('.item img').addClass('serviceselect');
                            $('#btnBasket').removeClass('serviceselect');
                            service.selectService();
                        }else {
                            $('.item img').removeClass('serviceselect');
                            $('#btnBasket').addClass('serviceselect');
                            service.index = -2;
                        }
                    }else {
                        $('.btn-ok').addClass('btn-handle');
                        $('.btn-cancel').removeClass('btn-handle');
                    }
                }
                break;
            case 39: //Move right
                if (service.popupshow == false) {
                    if(service.index == -2){
                        $('#btnBasket').removeClass('serviceselect');
                    }
                    service.index += service.rows;
                    if (service.index > service.max) {
                        service.index = service.max;
                    }
                    service.selectService();

                }else {
                    $('.btn-ok').removeClass('btn-handle');
                    $('.btn-cancel').addClass('btn-handle');
                }
                if(FoodOrder.basketOpen){
                    FoodOrder.selectIncre();
                }else {
                    if(service.index == -2){
                        $('#btnBasket').removeClass('serviceselect');
                    }
                }
                break;

            case 107://+
                if(FoodOrder.basketOpen == false){
                    var quantity = Number($('.quantity').val());
                    $('.quantity').val(quantity+1);
                }else {
                    FoodOrder.selectIncre();
                }
                break;
            case 109://-
                if(FoodOrder.basketOpen == false){
                    var quantity = Number($('.quantity').val());
                    if(quantity > 1){
                        $('.quantity').val(quantity-1);
                    }
                }else {
                    FoodOrder.selectReduce();
                }
                break;
            case 66://b
            case 457: //Info
                FoodOrder.openBasket();
                break;
            case 69://e
                if(FoodOrder.basketOpen == true){
                    FoodOrder.emptyOrder();
                }
                break;
            case 79://o
                if(FoodOrder.basketOpen == true){
                    FoodOrder.orderFood();
                }
                break;
            case 27://esc
            case 461: //Back
            case 8: //Back
                common.showLoading();
                if(FoodOrder.basketOpen == false){
                    //window.history.back();
                    parent.focus();
                }else {
                    FoodOrder.updateOrder();
                }

                break;
            case 602: //Portal
                common.showLoading();
                window.location = '<?php echo $this->request->createLink()?>';
                break;
            case 9: //Tab
            case 1001: //Exit

                break;
        }
    }

}

$('#food-order-popup').on('show.bs.modal', function (e) {
    // do something...
    service.popupshow = true;
    $('.btn-ok').addClass('btn-handle');
    $('.btn-cancel').removeClass('btn-handle');
})
$('#food-order-popup').on('hidden.bs.modal', function (e) {
    // do something...
    service.popupshow = false;
})
$('.btn-ok').click(function () {
    var foodid = $('#foodid').val();
    var foodname = $('#foodname').val();
    var price = $('#price').val();
    var quantity = $('.quantity').val();
    FoodOrder.add(foodid,foodname,price,quantity);
});
service = {
    index: 0,
    iteminfram: 6,
    offset: 0,
    rows: 2,
    minindex: 0,
    maxindex: 6,
    max: $('.item').length - 1,
    lockui: false,
    popupshow: false,
    selectService: function () {

        if (this.index > this.maxindex - 1) {
            this.lockui = true;
            $('.slick-next').click();
            this.offset++;
            this.minindex += this.rows;
            this.maxindex += this.rows;
        }
        if (this.index < this.minindex) {
            this.lockui = true;
            $('.slick-prev').click();
            this.offset--;
            this.minindex -= this.rows;
            this.maxindex -= this.rows;
        }
        console.log("index: " + this.index)
        console.log("offset: " + this.offset)
        console.log("minindex: " + this.minindex)
        console.log("maxindex: " + this.maxindex)
        $('.item img').removeClass('serviceselect');
        $('#main-region [index=' + service.index + '] img').addClass('serviceselect');
    }
}

$(document).ready(function () {
    $('.food-menu-carousel').on('afterChange', function (event, slick, currentSlide) {
        service.lockui = false;
    });
    $('#main-region [index=' + service.index + '] img').addClass('serviceselect');
    if(localStorage.getItem('roomnumber') == null){
        window.location = HTTPSERVER;
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
});