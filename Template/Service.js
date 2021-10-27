window.addEventListener("keyup", myEventHandler);
function myEventHandler(event){
    //console.log(event);
    $('#log').html(event.keyCode);
    switch (event.keyCode) {
        case 13:
            $('[index='+service.index+'] img').addClass('serviceselect')
            break;
        case 38: //Move top

            break;
        case 40: //Move down

            break;
        case 37: //Move left
            $('.slick-prev').click();
            break;
        case 39: //Move right
            $('.slick-next').click();
            break;
    }
}
service ={
    index:0
}
$(document).ready(function () {
    $('.room-service-carousel').on('afterChange', function(event, slick, currentSlide){
        service.index = Number($('[data-slick-index='+currentSlide+'] .col-lg-12')[0].getAttribute('index'));
    });
});