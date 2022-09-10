window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    switch (event.keyCode) {
        case 13:
            Tivi.toggleFullScreen();
            console.log('Ok')
            break;
        case 38: //Move top
            //$('.slick-prev').click();
            Tivi.moveTop();
            console.log('Top')
            break;
        case 40: //Move down
            //$('.slick-next').click();
            Tivi.moveDouwn();
            break;
        case 37: //Move left
            document.getElementById("showvideo").exitFullscreen();
            break;
        case 39: //Move right

            break;
        case 461: //Back
        case 8: //Back
            if (!document.mozFullScreen && !document.webkitFullScreen && !document.fullscreen) {
                common.showLoading();
                window.history.back();
            }else {
                Tivi.toggleFullScreen();
            }
            break;
        case 602: //Portal
            common.showLoading();
            window.location = '<?php echo $this->request->createLink()?>';
            break;
    }
}

$(document).ready(function () {
    //playVideo();
    // $('.sidebar-carousel').on('afterChange', function (event, slick, currentSlide) {
    //     playVideo();
    //     // console.log(currentSlide);
    //     // console.log($('[data-slick-index='+currentSlide+']').attr('video'));
    //     // $('#showvideo').attr('src',$('[data-slick-index='+currentSlide+']').attr('video'));
    //     // var vid = document.getElementById("showvideo");
    //     // vid.onerror = function() {
    //     //     alert("Error! Something went wrong");
    //     // };
    // });
    //$('#showbanner').load(HTTPSERVER+"Sitemap/showBanner.api?id=110");
    if (localStorage.getItem('roomnumber') == null) {
        window.location = HTTPSERVER;
    } else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }


    Tivi.selectCurent();
});
var timer;
Tivi = {
    current: 0,
    max: $('.sidebar-carousel .item').length,
    itemdisplay: 3,
    itemheigth: 170,
    selectCurent: function () {
        $('.sidebar-carousel .item').removeClass('slick-current');
        $($('.sidebar-carousel .item')[this.current]).addClass('slick-current');
        this.playVideo();
    },
    moveTop: function () {
        if (Tivi.current > 0) {
            this.current--;
            this.selectCurent();
            if (this.current >= this.itemdisplay - 1) {
                var numberstep = this.current - (this.itemdisplay - 1);
                var top = -(this.itemheigth * numberstep)
                $('.sidebar-carousel').animate({top: top + 'px'});
            }

        }
    },
    moveDouwn: function () {
        if (Tivi.current < Tivi.max - 1) {
            this.current++;
            this.selectCurent();
            if (this.current > this.itemdisplay - 1) {
                var numberstep = this.current - (this.itemdisplay - 1);
                var top = -(this.itemheigth * numberstep)
                $('.sidebar-carousel').animate({top: top + 'px'});
            }
        }
    },
    playVideo: function () {
        var sitemapid = $('.video-list .slick-current').attr('sitemapid');
        $('#showvideo').show();
        $('#showvideo').attr('src', $('[sitemapid=' + sitemapid + ']').attr('video'));
        $('#showbanner').hide();
        clearInterval(timer);
        var vid = document.getElementById("showvideo");
        vid.onerror = function () {
            $('#showbanner').load(HTTPSERVER + "Sitemap/showBanner.api?id=" + sitemapid, function () {
                $('#showbanner').show();
                var myCarousel = document.querySelector('.myCarousel')
                var carousel = new bootstrap.Carousel(myCarousel);
                timer = setInterval(function () {
                    carousel.next();
                }, 10000)
            });
            $('#showvideo').hide();
        };
    },
    videoElement: document.getElementById("showvideo"),
    toggleFullScreen: function () {
        if (!document.mozFullScreen && !document.webkitFullScreen && !document.fullscreen) {
            if (this.videoElement.mozRequestFullScreen) {
                this.videoElement.mozRequestFullScreen();
            } else {
                this.videoElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else {
                document.webkitCancelFullScreen();
            }
        }
    }
}