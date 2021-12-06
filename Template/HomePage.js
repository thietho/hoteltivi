$(document).ready(function () {
    $('.list-item-sub').removeClass('slick-current');
    if(localStorage.getItem('roomid') == null){
        mainmenu.opensettingAction();
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
});
window.addEventListener("keyup", myEventHandler);
mainmenu = {
    current: -1,
    max: 11,
    opensetting: false,
    settinginxdex: 0,
    opensettingAction:function () {
        console.log('open room setting');
        counttop = 0;
        mainmenu.opensetting = true;
        common.openModal('Room setting', '', 'Close', 'Cancel', null, function () {
            common.closeModal();
        });
        $.get(HTTPSERVER + 'RoomItem/getList.api', function (html) {
            $('#modalPopup .modal-body').html(html);
            mainmenu.settinginxdex = 0;
            $('.settingroom[index=' + mainmenu.settinginxdex + ']').addClass('selected');
        });
        $('#modalPopup').on('hidden.bs.modal', function (e) {
            mainmenu.opensetting = false;
        })
    }
}
var sitemaps = JSON.parse('<?php echo $sitemaps?>');
console.log(sitemaps);
var counttop = 0;
var timer = setInterval(function () {
    counttop = 0;
}, 3000)

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    switch (event.keyCode) {
        case 13:
            if(!mainmenu.opensetting){
                console.log(mainmenu.current);
                console.log(sitemaps[mainmenu.current + 1].sitemapid);
                var sitemapid = sitemaps[mainmenu.current + 1].sitemapid
                var url = HTTPSERVER + sitemapid + ".html";
                window.location = url;
            }else {
                localStorage.setItem('roomid',$('.settingroom.selected').attr('roomitemid'));
                localStorage.setItem('roomnumber',$('.settingroom.selected').attr('roomnumber'));
                window.location.reload();
            }

            break;
        case 38: //Move top
            counttop++;
            console.log(counttop);
            if (mainmenu.opensetting == false) {
                if (counttop > 10) {
                    mainmenu.opensettingAction();
                }
            } else {
                if (mainmenu.settinginxdex > 0) {
                    mainmenu.settinginxdex--;
                    $('.settingroom').removeClass('selected');
                    $('.settingroom[index=' + mainmenu.settinginxdex + ']').addClass('selected');
                }
            }

            break;
        case 40: //Move douwn
            if (mainmenu.opensetting) {
                if (mainmenu.settinginxdex < $('.settingroom').length - 1) {
                    mainmenu.settinginxdex++;
                    $('.settingroom').removeClass('selected');
                    $('.settingroom[index=' + mainmenu.settinginxdex + ']').addClass('selected');
                }

            }
            break;
        case 37: //Move left
            if (mainmenu.current >= 0) {
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
            if (mainmenu.current < mainmenu.max) {
                mainmenu.current++;
                $('.list-item-sub').removeClass('slick-current');
                $('.list-item-sub').removeClass('menucurent');
                $('[data-slick-index=' + mainmenu.current + ']').addClass('slick-current');
                $('[data-slick-index=' + mainmenu.current + ']').addClass('menucurent');
                console.log(mainmenu.current);
                $('.list-item').slick('slickGoTo', mainmenu.current);
            }
            break;
        case 1001:

            break;
    }
}