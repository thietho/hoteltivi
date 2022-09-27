var isPopup = false;
document.body.addEventListener('focus',function (event) {
    if(isPopup){
        $('.popup-frame').remove();
        isPopup = false;
    }
},true);
window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    if (service.lockui == false) {
        switch (event.keyCode) {
            case 13:
                if(FoodOrder.basketOpen){
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
                }else {
                    if(service.index >= 0){
                        // var sitemapid = $('#main-region [index=' + service.index + ']').attr('sitemapid');
                        // console.log(sitemapid);
                        // var url = HTTPSERVER + sitemapid + ".html";
                        var url = $('#main-region [index=' + service.index + '] a').attr('href');
                        //window.location = url;
                        $('body').prepend('<iframe class="popup-frame" width="100%" height="100%" src="'+url+'"></iframe>');
                        $('.popup-frame')[0].focus();
                        isPopup = true;
                    }else {
                        FoodOrder.openBasket();
                    }
                }
                break;
            case 38: //Move top
                if (service.popupshow == false) {
                    if (service.index - 1 >= 0) {
                        service.index -= 1;
                        service.selectService();
                    }
                } else {
                    if (FoodOrder.basketOpen == true) {
                        FoodOrder.selectMoveUp();
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
                }

                break;
            case 37: //Move left

                if(FoodOrder.basketOpen){
                    FoodOrder.selectReduce();
                }else {
                    if (service.popupshow == false) {
                        if (service.index - service.rows >= 0) {
                            service.index -= service.rows;
                            service.selectService();
                        }else {
                            $('.item img').removeClass('serviceselect');
                            $('#btnBasket').addClass('serviceselect');
                            service.index = -2;
                        }
                    }
                }
                break;
            case 39: //Move right

                if(FoodOrder.basketOpen){
                    FoodOrder.selectIncre();
                }else {
                    if(service.index == -2){
                        $('#btnBasket').removeClass('serviceselect');
                    }
                    if (service.popupshow == false) {
                        service.index += service.rows;
                        if (service.index > service.max) {
                            service.index = service.max;
                        }
                        service.selectService();
                    }
                }
                break;
            case 107://+
                if(FoodOrder.basketOpen == true){
                    FoodOrder.selectIncre();
                }
                break;
            case 109://-
                if(FoodOrder.basketOpen == true){
                    FoodOrder.selectReduce();
                }
                break;
            case 66:
            case 457: //Info
                FoodOrder.openBasket();
                break;
            case 69://E
                if (FoodOrder.basketOpen == true) {
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
                if(FoodOrder.basketOpen == false){
                    // common.showLoading();
                    // window.history.back();
                    parent.focus();
                }else {
                    FoodOrder.updateOrder();
                }
                break;
            case 602: //Portal
            case 80: //Portal
                common.showLoading();
                window.location = '<?php echo $this->request->createLink()?>';
                break;
        }
    }

}

$('#room-service-popup').on('show.bs.modal', function (e) {
    // do something...
    service.popupshow = true;
})
$('#room-service-popup').on('hidden.bs.modal', function (e) {
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
        $('#main-region [index=' + service.index + '] img').addClass('serviceselect');
    }
}
$(document).ready(function () {
    $('.food-order-carousel').on('afterChange', function (event, slick, currentSlide) {
        service.lockui = false;
    });
    $('#main-region [index=' + service.index + '] img').addClass('serviceselect');
    if (localStorage.getItem('roomnumber') == null) {
        window.location = HTTPSERVER;
    } else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
});