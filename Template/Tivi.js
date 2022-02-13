window.addEventListener("keyup", myEventHandler);
function myEventHandler(event){
    //console.log(event);
    $('#log').html(event.keyCode);
    switch (event.keyCode) {
        case 13:

            break;
        case 38: //Move top
            $('.slick-prev').click();
            break;
        case 40: //Move down
            $('.slick-next').click();
            break;
        case 37: //Move left

            break;
        case 39: //Move right

            break;
        case 461: //Back
        case 8: //Back
            common.showLoading();
            window.history.back();
            break;
        case 602: //Portal
            common.showLoading();
            window.location = '<?php echo $this->request->createLink()?>';
            break;
    }
}
$(document).ready(function () {
    $('.sidebar-carousel').on('afterChange', function(event, slick, currentSlide){
        console.log(currentSlide);
        console.log($('[data-slick-index='+currentSlide+']').attr('video'));
        $('#showvideo').attr('src',$('[data-slick-index='+currentSlide+']').attr('video'));
    });
    if(localStorage.getItem('roomnumber') == null){
        window.location = HTTPSERVER;
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
});