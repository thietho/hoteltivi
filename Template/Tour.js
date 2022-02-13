window.addEventListener("keyup", myEventHandler);
function myEventHandler(event){
    //console.log(event);
    $('#log').html(event.keyCode);
    switch (event.keyCode) {
        case 13:

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
        case 461: //Back
            common.showLoading();
            window.history.back();
            break;
        case 602: //Portal
            common.showLoading();
            window.location = '<?php echo $this->request->createLink()?>';
            break;
    }
    if(localStorage.getItem('roomnumber') == null){
        window.location = HTTPSERVER;
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
}