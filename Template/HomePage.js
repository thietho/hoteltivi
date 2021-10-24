$(document).ready(function () {
    $('.list-item-sub').removeClass('slick-current');
});
window.addEventListener("keyup", myEventHandler);
mainmenu = {
    current:-1,
    max:11
}
function myEventHandler(event){
    //console.log(event);
    $('#log').html(event.keyCode);
    switch (event.keyCode) {
        case 37: //Move left

            if(mainmenu.current >= 0) {
                mainmenu.current--;
                $('.list-item-sub').removeClass('slick-current');
                $('[data-slick-index=' + mainmenu.current + ']').addClass('slick-current');
                console.log(mainmenu.current);
                $('.list-item').slick('slickGoTo', mainmenu.current);
                if (mainmenu.current < 0) {
                    $('.list-item-sub').removeClass('slick-current');
                }
            }

            break;
        case 39: //Move right
            if(mainmenu.current < mainmenu.max){
                mainmenu.current++;
                $('.list-item-sub').removeClass('slick-current');
                $('[data-slick-index='+mainmenu.current+']').addClass('slick-current');
                console.log(mainmenu.current);
                $('.list-item').slick('slickGoTo',mainmenu.current);
            }

            break;
    }
}