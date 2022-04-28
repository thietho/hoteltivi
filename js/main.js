$('.list-item').slick({
    arrows: false,
    dots: false,
    infinite: false,
    slidesToShow: 6,
    slidesToScroll: 1,
    loop: false
});

$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    focusOnSelect: true
});

$('a[data-slide]').click(function (e) {
    e.preventDefault();
    var slideno = $(this).data('slide');
    $('.slider-nav').slick('slickGoTo', slideno - 1);
});

$(document).ready(function () {
    // slick carousel
    $('.sidebar-carousel').slick({
        arrows: true,
        vertical: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        verticalSwiping: true,
        prevArrow: "<img class='a-left control-c prev slick-prev' src='./img/up-icon.png'>",
        nextArrow: "<img class='a-right control-c next slick-next' src='./img/down-icon.png'>"
    });
});


$(document).ready(function () {
    // slick carousel
    $('.room-service-carousel').slick({
        arrows: true,
        rows: 2,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
        verticalSwiping: true,
        prevArrow: "<img class='a-left control-c prev slick-prev' src='./img/left-icon.png'>",
        nextArrow: "<img class='a-right control-c next slick-next' src='./img/right-icon.png'>"
    });
    $('#videopopup #btnSkip').click(function () {
        TiviVideoPlayer.closePopup();
    });

    TiviHistoryUrl.load();
    TiviHistoryUrl.add(window.location.href);
    console.log(TiviHistoryUrl.data);
});

$(document).ready(function () {
    // slick carousel
    $('.tour-travel-carousel').slick({
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        verticalSwiping: true,
        prevArrow: "<img class='a-left control-c prev slick-prev' src='./img/left-icon.png'>",
        nextArrow: "<img class='a-right control-c next slick-next' src='./img/right-icon.png'>"
    });
});

$(document).ready(function () {
    // slick carousel
    $('.list-channel-carousel').slick({
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        rows: 3,
        verticalSwiping: true,
        infinite: false,
        prevArrow: "<img class='a-left control-c prev slick-prev' src='./img/left-icon.png'>",
        nextArrow: "<img class='a-right control-c next slick-next' src='./img/right-icon.png'>"
    });
});

$(document).ready(function () {
    // slick carousel
    $('.food-order-carousel').slick({
        arrows: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        rows: 2,
        infinite: false,
        verticalSwiping: true,
        prevArrow: "<img class='a-left control-c prev slick-prev' src='./img/left-icon.png'>",
        nextArrow: "<img class='a-right control-c next slick-next' src='./img/right-icon.png'>"
    });
    $('.food-menu-carousel').slick({
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        rows: 2,
        infinite: false,
        verticalSwiping: true,
        prevArrow: "<img class='a-left control-c prev slick-prev' src='./img/left-icon.png'>",
        nextArrow: "<img class='a-right control-c next slick-next' src='./img/right-icon.png'>"
    });
});


(function ($) {
    $.fn.bootstrapNumber = function (options) {
        var settings = $.extend({
            upClass: 'up',
            downClass: 'down',
            upText: '+',
            downText: '-',
            center: true
        }, options);

        return this.each(function (e) {
            var self = $(this);
            var clone = self.clone(true, true);

            var min = self.attr('min');
            var max = self.attr('max');
            var step = parseInt(self.attr('step')) || 1;

            function setText(n) {
                if (isNaN(n) || (min && n < min) || (max && n > max)) {
                    return false;
                }

                clone.focus().val(n);
                clone.trigger('change');
                return true;
            }

            var group = $("<div class='input-group'></div>");
            var down = $("<button type='button'>" + settings.downText + "</button>").attr('class', 'btn btn-' + settings.downClass).click(function () {
                setText(parseInt(clone.val() || clone.attr('value')) - step);
            });
            var up = $("<button type='button'>" + settings.upText + "</button>").attr('class', 'btn btn-' + settings.upClass).click(function () {
                setText(parseInt(clone.val() || clone.attr('value')) + step);
            });
            $("<span class='input-group-btn'></span>").append(down).appendTo(group);
            clone.appendTo(group);
            if (clone && settings.center) {
                clone.css('text-align', 'center');
            }
            $("<span class='input-group-btn'></span>").append(up).appendTo(group);

            // remove spins from original
            clone.prop('type', 'text').keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }

                var c = String.fromCharCode(e.which);
                var n = parseInt(clone.val() + c);

                if ((min && n < min) || (max && n > max)) {
                    e.preventDefault();
                }
            });

            self.replaceWith(group);
        });
    };
}(jQuery));
// Remember set you events before call bootstrapSwitch or they will fire after bootstrapSwitch's events
$("[name='checkbox2']").change(function () {
    if (!confirm('Do you wanna cancel me!')) {
        this.checked = true;
    }
});

$('#after').bootstrapNumber();
$('.basket').bootstrapNumber();

TiviVideoPlayer = {
    vid:null,
    isplay:false,
    openPopup:function (url){
        $('#videopopup').show();
        console.log(url)
        $('#videoplayer').attr('src',url);
        //document.getElementById('videoplayer').play();
        this.vid = document.getElementById('videoplayer')
        this.vid.play();
        this.isplay=true;
        setTimeout(function () {
            $('#btnSkip').show()
        },5000)
    },
    closePopup:function () {
        if($('#btnSkip').is(":visible")){
            this.vid.pause();
            this.vid.currentTime = 0;
            $('#videopopup').hide();
            this.isplay = false;
        }
    }
}

TiviHistoryUrl = {
    data:null,
    load:function (){
        if(sessionStorage.getItem('history')!=null){
            this.data = JSON.parse(sessionStorage.getItem('history'));
        }else {
            this.data = new Array();
        }

    },
    add:function (url) {
        if(url != this.data[this.data.length - 1]){
            this.data.push(url);
            sessionStorage.setItem('history',JSON.stringify(this.data));
        }
    },
    clear:function () {
        sessionStorage.removeItem('history');
        this.data = new Array();
    },
    goBack:function () {
        
    }
}