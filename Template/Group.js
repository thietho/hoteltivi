var isPopup = false;
document.body.addEventListener('focus',function (event) {
    if(isPopup){
        $('.popup-frame').remove();
        isPopup = false;
    }
},true);
window.addEventListener("keyup", myEventHandler);

function myEventHandler(event){
    //console.log(event);
    if(service.lockui == false){
        if($('.item').length > 6){
            switch (event.keyCode) {
                case 13:
                    if(service.popupshow){
                        if($('.btn-handle').hasClass('btn-ok')){
                            var servicename = $('.serviceselect').attr('servicename');
                            FoodOrder.orderService(servicename);
                        }else {
                            $('#room-service-popup').modal('hide');
                        }
                    }
                    if (TiviVideoPlayer.isplay) {
                        TiviVideoPlayer.closePopup();
                    } else {
                        var pagetype = $('.serviceselect').parent().attr('pagetype');
                        switch (pagetype) {
                            case 'Video':
                                var scr = $('.serviceselect').parent().attr('video')
                                TiviVideoPlayer.openPopup(scr);
                                break;
                            case 'Service':
                                $('#room-service-popup').modal();
                                var servicename = $('.serviceselect').attr('servicename');
                                $('#room-service-popup .modal-body p').html(dataLang.lbl_confirm_call_service+' '+ servicename.toLowerCase() +'?');
                                break;
                            default:
                                // common.showLoading();
                                // window.location = $('.serviceselect').parent().attr('href');
                                var url = $('.serviceselect').parent().attr('href');
                                $('body').append('<iframe class="popup-frame" src="'+url+'"></iframe>');
                                $('.popup-frame')[0].focus();
                                isPopup = true;
                        }
                    }

                    break;
                case 38: //Move top
                    if(service.index - 1 >= 0) {
                        service.index -= 1;
                        service.selectService();
                    }
                    break;
                case 40: //Move down
                    if(service.index < service.max){
                        service.index +=1;
                        service.selectService();
                    }
                    break;
                case 37: //Move left
                    if (service.popupshow == false) {
                        if(service.index - service.rows >= 0){
                            service.index -= service.rows;
                            service.selectService();
                        }
                    }else {
                        $('.btn-ok').addClass('btn-handle');
                        $('.btn-cancel').removeClass('btn-handle');
                    }

                    break;
                case 39: //Move right
                    if (service.popupshow == false) {
                        service.index +=service.rows;
                        if(service.index > service.max){
                            service.index = service.max;
                        }
                        service.selectService();
                    }else {
                        $('.btn-ok').removeClass('btn-handle');
                        $('.btn-cancel').addClass('btn-handle');
                    }
                    break;
                case 27://esc
                case 461: //Back
                case 8: //Back
                    if(service.popupshow){
                        $('#room-service-popup').modal('hide');
                    }else {
                        // common.showLoading();
                        // window.history.back();
                        parent.focus();
                    }
                    break;
                case 602: //Portal
                case 80: //Portal
                    common.showLoading();
                    window.location = '<?php echo $this->request->createLink()?>';
                    break;
            }
        }else {
            switch (event.keyCode) {
                case 13:

                    if(service.popupshow){

                        if($('.btn-handle').hasClass('btn-ok')){
                            var servicename = $('.serviceselect').attr('servicename');
                            FoodOrder.orderService(servicename);
                        }else {
                            $('#room-service-popup').modal('hide');
                        }
                    }
                    if (TiviVideoPlayer.isplay) {
                        TiviVideoPlayer.closePopup();
                    } else {
                        var pagetype = $('.serviceselect').parent().attr('pagetype');
                        switch (pagetype) {
                            case 'Video':
                                var scr = $('.serviceselect').parent().attr('video')
                                TiviVideoPlayer.openPopup(scr);
                                break;
                            case 'Service':
                                $('#room-service-popup').modal();
                                var servicename = $('.serviceselect').attr('servicename');
                                $('#room-service-popup .modal-body p').html(dataLang.lbl_confirm_call_service+' '+ servicename.toLowerCase() +'?');
                                break;
                            default:
                                // common.showLoading();
                                // window.location = $('.serviceselect').parent().attr('href');
                                var url = $('.serviceselect').parent().attr('href');
                                $('body').append('<iframe class="popup-frame" src="'+url+'"></iframe>');
                                $('.popup-frame')[0].focus();
                                isPopup = true;
                        }
                    }

                    break;
                case 38: //Move top
                    service.index -= 3;
                    if(service.index < 0){
                        service.index = 0;
                    }
                    service.selectService();
                    break;
                case 40: //Move down
                    if(service.index >= 0) {
                        service.index += 3;
                        if(service.index > service.max){
                            service.index = service.max;
                        }
                        service.selectService();
                    }
                    break;
                case 37: //Move left
                    if (service.popupshow == false) {
                        if(service.index - 1 >= 0) {
                            service.index -= 1;
                            service.selectService();
                        }
                    }else {
                        $('.btn-ok').addClass('btn-handle');
                        $('.btn-cancel').removeClass('btn-handle');
                    }


                    break;
                case 39: //Move right
                    if (service.popupshow == false) {
                        //$('.slick-next').click();
                        if(service.index < service.max){
                            service.index +=1;
                            service.selectService();
                        }
                    }else {
                        $('.btn-ok').removeClass('btn-handle');
                        $('.btn-cancel').addClass('btn-handle');
                    }

                    break;
                case 27://esc
                case 461: //Back
                case 8: //Back
                    if(service.popupshow){
                        $('#room-service-popup').modal('hide');
                    }else {
                        // common.showLoading();
                        // window.history.back();
                        parent.focus();
                    }

                    break;
                case 602: //Portal
                case 80: //Portal
                    common.showLoading();
                    window.location = '<?php echo $this->request->createLink()?>';
                    break;
            }
        }

    }

}
$('#room-service-popup').on('show.bs.modal', function (e) {
    // do something...
    service.popupshow = true;
    $('.btn-ok').addClass('btn-handle');
    $('.btn-cancel').removeClass('btn-handle');
})
$('#room-service-popup').on('hidden.bs.modal', function (e) {
    // do something...
    service.popupshow = false;
})
service ={
    index:0,
    iteminfram:6,
    offset:0,
    rows:2,
    minindex:0,
    maxindex:6,
    max: $('.item').length -1,
    lockui:false,
    popupshow:false,
    selectService:function () {

        if(this.index > this.maxindex-1){
            this.lockui = true;
            $('.slick-next').click();
            this.offset++;
            this.minindex += this.rows;
            this.maxindex += this.rows;
        }
        if(this.index < this.minindex){
            this.lockui = true;
            $('.slick-prev').click();
            this.offset--;
            this.minindex -= this.rows;
            this.maxindex -= this.rows;
        }
        console.log("index: "+this.index)
        console.log("offset: "+this.offset)
        console.log("minindex: "+this.minindex)
        console.log("maxindex: "+this.maxindex)
        $('.item img').removeClass('serviceselect');
        $('[index='+service.index+'] img').addClass('serviceselect');
    }
}
$(document).ready(function () {
    $('.room-service-carousel').on('afterChange', function(event, slick, currentSlide){
        service.lockui = false;
    });
    $('[index='+service.index+'] img').addClass('serviceselect');
    if(localStorage.getItem('roomnumber') == null){
        window.location = HTTPSERVER;
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
});