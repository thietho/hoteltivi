window.addEventListener("keyup", myEventHandler);
function myEventHandler(event){
    //console.log(event);
    if(service.lockui == false){
        switch (event.keyCode) {
            case 13:
                if(service.popupshow == false){
                    $('#room-service-popup').modal();
                    var servicename = $('.serviceselect').attr('servicename');
                    $('#room-service-popup .modal-body p').html(dataLang.lbl_confirm_call_service+' '+ servicename.toLowerCase() +'?');
                }else {
                    var servicename = $('.serviceselect').attr('servicename');
                    FoodOrder.orderService(servicename);
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
                if(service.index - service.rows >= 0){
                    service.index -= service.rows;
                    service.selectService();
                }

                break;
            case 39: //Move right
                //$('.slick-next').click();
                service.index +=service.rows;
                if(service.index > service.max){
                    service.index = service.max;
                }
                service.selectService();
                break;
            case 461: //Back
            case 8: //Back
                if(service.popupshow){
                    $('#room-service-popup').modal('hide');
                }else {
                    common.showLoading();
                    window.history.back();
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
$('#room-service-popup').on('show.bs.modal', function (e) {
    // do something...
    service.popupshow = true;
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