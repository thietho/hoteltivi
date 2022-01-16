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

            break;
        case 39: //Move right

            break;
        case 461: //Back
            window.history.back();
            break;
        case 602: //Portal
            window.location = '<?php echo $this->request->createLink()?>';
            break;
    }
}
$(document).ready(function () {
    if(localStorage.getItem('roomnumber') == null){
        window.location = HTTPSERVER;
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'));

        $.getJSON(HTTPSERVER+'Bill/getServiceInfo.api?roomnumber='+localStorage.getItem('roomnumber'),function (result) {
            console.log(result);
            var str = '';
            if(result.Status == "success"){
                var listitem = result.Data;
                var sum = 0;
                for (var i in listitem) {
                    str += '<tr>' +
                        '   <td class="bill-date">'+listitem[i].Date+'<br><span>'+listitem[i].Time+'</span></td>' +
                        '   <td class="bill-service">'+listitem[i].Name+'</td>' +
                        '   <td class="bill-price">'+listitem[i].Total+' vnđ</td>' +
                        '</tr>'
                    sum += common.stringtoNumber(listitem[i].Total);
                }
                $('#listitems').html(str);
                $('#billtotal').html(common.formateNumber(sum));
            }
        });
        $.getJSON(HTTPSERVER+'Bill/getServiceInfoDate.api?roomnumber='+localStorage.getItem('roomnumber'),function (result) {
            console.log(result);
            var str = '';
            for (var i in result) {
                console.log(i);
                var sum = 0;
                for (const j in result[i]) {
                    sum+= common.stringtoNumber(result[i][j].Total);
                }
                str += '<tr>' +
                    '   <td class="bill-date sidebar"><span>'+i+'</span></td>' +
                    '   <td class="bill-price sidebar"><span>'+ common.formateNumber(sum)+' vnđ</span></td>' +
                    '</tr>';
            }
            $('#listdate').html(str);
        });
    }
})