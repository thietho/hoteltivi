$(document).ready(function () {
    hcap.property.setProperty({
        "key" : "boot_sequence_option",
        "value" : "1",
        "onSuccess" : function() {
            //alert("Ahihi");
        },
        "onFailure" : function(f) {
            console.log("onFailure : errorMessage = " + f.errorMessage);
        }
    });

    hcap.property.getProperty({
        "key":"room_number",
        "onSuccess" : function(s) {
            var_room_info = s.value;
            localStorage.setItem('roomnumber',var_room_info);
            $('#roomnumber').html(localStorage.getItem('roomnumber'))
        },
        "onFailure" : function(f) {

        }
    });
    $('.list-item-sub').removeClass('slick-current');
    // if(localStorage.getItem('roomid') == null){
    //     mainmenu.opensettingAction();
    // }else {
    //     $('#roomnumber').html(localStorage.getItem('roomnumber'))
    // }
    //channel.stopChannel();
    channel.playMediaSilent();

});
window.addEventListener("keyup", myEventHandler);
mainmenu = {
    current: -1,
    max: 9,
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
                if($('.menucurent').attr('appid')!=undefined){
                    console.log($('.menucurent').attr('appid'))
                    hcap.preloadedApplication.launchPreloadedApplication({
                        "id" : "144115188075859002", //Youtube

                        "onSuccess" : function() {
                        },
                        "onFailure" : function(f) {
                            console.log("onFailure : errorMessage = " + f.errorMessage);
                        }
                    });
                }else {
                    var sitemapid = sitemaps[mainmenu.current + 1].sitemapid
                    var url = HTTPSERVER + sitemapid + ".html";
                    window.location = url;
                }

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
                // if (counttop > 10) {
                //     mainmenu.opensettingAction();
                // }
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