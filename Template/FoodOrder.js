window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    if (service.lockui == false) {
        switch (event.keyCode) {
            case 13:
                var sitemapid = $('[index=' + service.index + ']').attr('sitemapid');
                console.log(sitemapid);
                var url = HTTPSERVER + sitemapid + ".html";
                window.location = url;
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
                if (service.popupshow == false) {
                    if (service.index - service.rows >= 0) {
                        service.index -= service.rows;
                        service.selectService();
                    }
                }
                break;
            case 39: //Move right
                //$('.slick-next').click();
                if (service.popupshow == false) {
                    service.index += service.rows;
                    if (service.index > service.max) {
                        service.index = service.max;
                    }
                    service.selectService();
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
                FoodOrder.openBasket();
                break;
            case 8://return
                if (FoodOrder.basketOpen == true) {
                    FoodOrder.updateOrder();
                }
                break;
            case 69://E
                if (FoodOrder.basketOpen == true) {
                    FoodOrder.emptyOrder();
                }

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
        $('[index=' + service.index + '] img').addClass('serviceselect');
    }
}
$(document).ready(function () {
    $('.food-order-carousel').on('afterChange', function (event, slick, currentSlide) {
        service.lockui = false;
    });
    $('[index=' + service.index + '] img').addClass('serviceselect');
    if (localStorage.getItem('roomid') == null) {
        window.location = HTTPSERVER;
    } else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
});