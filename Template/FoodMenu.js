window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    if (service.lockui == false) {
        switch (event.keyCode) {
            case 13:
                var foodid = $('[index=' + service.index + ']').attr('foodid');
                var foodname = $('[index=' + service.index + ']').attr('foodname');
                var price = $('[index=' + service.index + ']').attr('price');
                $('#food-order-popup').modal();
                $('#food-order-popup .modal-title').html(foodname);
                $('#food-order-popup .food-price span').html(price);
                break;
            case 38: //Move top
                if (service.popupshow == false) {
                    if (service.index - 1 >= 0) {
                        service.index -= 1;
                        service.selectService();
                    }
                }

                break;
            case 40: //Move down
                if (service.popupshow == false) {
                    if (service.index < service.max) {
                        service.index += 1;
                        service.selectService();
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
                if (service.popupshow == false) {
                    service.index += service.rows;
                    if (service.index > service.max) {
                        service.index = service.max;
                    }
                    service.selectService();
                }
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
});