window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    if (service.lockui == false) {
        switch (event.keyCode) {
            case 13:
                if (service.popupshow == false) {
                    var foodid = $('[index=' + service.index + ']').attr('foodid');
                    var foodname = $('[index=' + service.index + ']').attr('foodname');
                    var price = $('[index=' + service.index + ']').attr('price');
                    $('#foodid').val(foodid);
                    $('#foodname').val(foodname);
                    $('#price').val(price);
                    $('#food-order-popup').modal();
                    $('#food-order-popup .modal-title').html(foodname);
                    $('#food-order-popup .food-price span').html(common.formateNumber(price));
                }else {
                    var foodid = $('#foodid').val();
                    var foodname = $('#foodname').val();
                    var price = $('#price').val();
                    var quantity = $('.quantity').val();
                    FoodOrder.add(foodid,foodname,price,quantity);
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
                if (service.popupshow == false) {
                    if (service.index - service.rows >= 0) {
                        service.index -= service.rows;
                        service.selectService();
                    }
                }
                if(FoodOrder.basketOpen){
                    FoodOrder.selectReduce();
                }
                break;
            case 39: //Move right
                if (service.popupshow == false) {
                    service.index += service.rows;
                    if (service.index > service.max) {
                        service.index = service.max;
                    }
                    service.selectService();
                }
                if(FoodOrder.basketOpen){
                    FoodOrder.selectIncre();
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
            case 66:
            case 403:
                FoodOrder.openBasket();
                break;
            case 8://return
                if(FoodOrder.basketOpen == true) {
                    FoodOrder.updateOrder();
                }
                break;
            case 69://e
                if(FoodOrder.basketOpen == true){
                    FoodOrder.emptyOrder();
                }
            case 79://o
                if(FoodOrder.basketOpen == true){
                    FoodOrder.orderFood();
                }
                break;
            case 461: //Back
                window.history.back();
                break;
            case 602: //Portal
                window.location = '<?php echo $this->request->createLink()?>';
                break;
        }
    }

}

$('#food-order-popup').on('show.bs.modal', function (e) {
    // do something...
    service.popupshow = true;
})
$('#food-order-popup').on('hidden.bs.modal', function (e) {
    // do something...
    service.popupshow = false;
})
$('.btn-ok').click(function () {
    alert('Ok click')
});
service = {
    index: 0,
    iteminfram: 4,
    offset: 0,
    rows: 2,
    minindex: 0,
    maxindex: 4,
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
        $('[index=' + service.index + '] img').addClass('serviceselect');
    }
}

$(document).ready(function () {
    $('.food-menu-carousel').on('afterChange', function (event, slick, currentSlide) {
        service.lockui = false;
    });
    $('[index=' + service.index + '] img').addClass('serviceselect');
    if(localStorage.getItem('roomnumber') == null){
        window.location = HTTPSERVER;
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
});