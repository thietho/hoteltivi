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
    mainmenu.getWeather()
    setInterval(function(){
        mainmenu.getWeather();
    }, 30000);
});
window.addEventListener("keyup", myEventHandler);
mainmenu = {
    current: -1,
    max: 10,
    opensetting: false,
    settinginxdex: 0,
    selectCurent:function () {
        if(this.current == -1){
            $('.home-static').addClass('curent');
        }else {
            $('.home-static').removeClass('curent');
            $('[data-slick-index='+this.current+']').addClass('menucurent')
        }
    },
    exit:function () {
        $('.home-static').removeClass('curent');
        $('.list-item-sub').removeClass('menucurent')
    },
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
    },
    getWeather:function () {
        var temp = 27;
        var weatherIcon = '02d';
        var imgPath = HTTPSERVER + "img/weather/";
        $.ajax({
            url: 'https://api.openweathermap.org/data/2.5/weather?id=1566083&appid=88ddbfabefabb13c091fcad8623732e9&units=metric',
            async: false,
            dataType: 'json',
            success: function (json) {
                if (json) {
                    temp = Math.round(json.main.temp);
                    weatherIcon = json.weather[0].icon;
                }
            }
        });
        document.getElementById("weather-icon").src = imgPath + weatherIcon + ".png";
        console.log(imgPath + weatherIcon + ".png");
        document.getElementById("weather-current").innerHTML = temp + "<sup>o</sup>C";
        document.getElementById("shorttime").innerHTML = common.currentTimeShow();
        document.getElementById("fulltime").innerHTML = common.currentDateShow();
    }
}
lang = {
    current: 0,
    selectCurent:function (){
        $('#langRegion td').removeClass('langcurrent');
        $($('#langRegion').children()[this.current]).addClass('langcurrent');
    },
    next:function () {
        if(this.current < $('#langRegion td').length-1){
            this.current++;
            this.selectCurent();
        }

    },
    back:function () {
        if(this.current > 0){
            this.current--;
            this.selectCurent();
        }

    },
    exit:function () {
        $('#langRegion td').removeClass('langcurrent');
    }
}
var sitemaps = JSON.parse('<?php echo $sitemaps?>');
console.log(sitemaps);
var counttop = 0;
var timer = setInterval(function () {
    counttop = 0;
}, 3000)
var currentRegion = 'menu';
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
                        "id" : $('.menucurent').attr('appid'),

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
            currentRegion = 'lang';
            lang.selectCurent();
            mainmenu.exit();
            if (mainmenu.opensetting == false) {
                if (counttop > 10) {
                    //mainmenu.opensettingAction();
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
            currentRegion = 'menu';
            lang.exit();
            mainmenu.selectCurent();

            break;
        case 37: //Move left
            switch (currentRegion){
                case "menu":
                    if (mainmenu.current >= 0) {
                        $('.home-static').removeClass('curent');
                        mainmenu.current--;
                        $('.list-item-sub').removeClass('slick-current');
                        $('.list-item-sub').removeClass('menucurent');
                        $('[data-slick-index=' + mainmenu.current + ']').addClass('slick-current');
                        $('[data-slick-index=' + mainmenu.current + ']').addClass('menucurent');

                        console.log(mainmenu.current);
                        $('.list-item').slick('slickGoTo', mainmenu.current);
                        if (mainmenu.current < 0) {
                            $('.list-item-sub').removeClass('slick-current');
                            $('.home-static').addClass('curent');
                        }
                    }else {
                        $('.home-static').addClass('curent');
                    }
                    break;
                case "lang":
                    lang.back();
                    break;
            }

            break;
        case 39: //Move right
            switch (currentRegion) {
                case "menu":
                    if (mainmenu.current < mainmenu.max) {
                        $('.home-static').removeClass('curent');
                        mainmenu.current++;
                        $('.list-item-sub').removeClass('slick-current');
                        $('.list-item-sub').removeClass('menucurent');
                        $('[data-slick-index=' + mainmenu.current + ']').addClass('slick-current');
                        $('[data-slick-index=' + mainmenu.current + ']').addClass('menucurent');
                        console.log(mainmenu.current);
                        $('.list-item').slick('slickGoTo', mainmenu.current);
                    }
                    break;
                case "lang":
                    lang.next();
                    break;
            }

            break;
        case 1001:

            break;
    }
}