$(document).ready(function () {
    $('.list-item-sub').removeClass('slick-current');
});
window.addEventListener("keyup", myEventHandler);
mainmenu = {
    current:-1,
    max:11
}
var sitemaps = JSON.parse('<?php echo $sitemaps?>');
console.log(sitemaps);
function myEventHandler(event){
    //console.log(event);
    $('#log').html(event.keyCode);
    switch (event.keyCode) {
        case 13:
            console.log(mainmenu.current);
            console.log(sitemaps[mainmenu.current + 1].sitemapid);
            var sitemapid = sitemaps[mainmenu.current + 1].sitemapid
            var url = HTTPSERVER+sitemapid+".html";
            window.location = url;
            break;
        case 37: //Move left
            if(mainmenu.current >= 0) {
                mainmenu.current--;
                $('.list-item-sub').removeClass('slick-current');
                $('.list-item-sub').removeClass('menucurent');
                $('[data-slick-index=' + mainmenu.current + ']').addClass('slick-current');
                $('[data-slick-index=' + mainmenu.current + ']').addClass('menucurent');

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
                $('.list-item-sub').removeClass('menucurent');
                $('[data-slick-index=' + mainmenu.current + ']').addClass('slick-current');
                $('[data-slick-index=' + mainmenu.current + ']').addClass('menucurent');
                console.log(mainmenu.current);
                $('.list-item').slick('slickGoTo',mainmenu.current);
            }

            break;
    }
}