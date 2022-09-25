var isPopup = false;
document.body.addEventListener('focus',function (event) {
    if(isPopup){
        $('.popup-frame').remove();
        isPopup = false;
    }
},true);
window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    switch (event.keyCode) {
        case 13:

            break;
        case 38: //Move top
            $('.regioncurrent .showcontent').animate({scrollTop: $('.regioncurrent .showcontent').scrollTop() - 100}, '100');
            break;
        case 40: //Move down
            $('.regioncurrent .showcontent').animate({scrollTop: $('.regioncurrent .showcontent').scrollTop() + 100}, '100');
            break;
        case 37: //Move left
            $('.bill-content').removeClass('regioncurrent');
            $('.main-sidebar-bill').addClass('regioncurrent');
            break;
        case 39: //Move right
            $('.bill-content').addClass('regioncurrent');
            $('.main-sidebar-bill').removeClass('regioncurrent');
            break;
        case 27://esc
        case 461: //Back
        case 8: //Back
            // common.showLoading();
            // window.history.back();
            parent.focus()
            break;
        case 602: //Portal
            common.showLoading();
            window.location = '<?php echo $this->request->createLink()?>';
            break;
    }
}

$(document).ready(function () {
    if (localStorage.getItem('roomnumber') == null) {
        window.location = HTTPSERVER;
    } else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'));
        var folioNum = localStorage.getItem('folioNum');
        $.getJSON(HTTPSERVER + 'Bill/getServiceInfo.api?folioNum=' + folioNum, function (result) {
            result = result[0];
            console.log(result);
            var str = '';
            if (result.message == "Success") {
                var listitem = result.data;
                var sum = 0;
                for (var i in listitem) {
                    var arrdate = listitem[i].date.split(' ');
                    str += '<tr>' +
                        '   <td class="bill-date">' + arrdate[0] + '<br><span>' + arrdate[1] + ' ' + arrdate[2] + '</span></td>' +
                        '   <td class="bill-service">' + listitem[i].description + '</td>' +
                        '   <td class="bill-price">' + common.formateNumber(listitem[i].amount) + ' vnđ</td>' +
                        '</tr>'
                    sum += common.stringtoNumber(listitem[i].amount);
                }
                $('#listitems').html(str);
                $('#billtotal').html(common.formateNumber(sum));
            }
        });
        $.getJSON(HTTPSERVER + 'Bill/getServiceInfoDate.api?folioNum=' + folioNum, function (result) {
            console.log(result);
            var str = '';
            for (var i in result) {
                console.log(i);
                var sum = 0;
                for (var j in result[i]) {
                    sum += common.stringtoNumber(result[i][j].amount);
                }
                str += '<tr>' +
                    '   <td class="bill-date sidebar"><span>' + i + '</span></td>' +
                    '   <td class="bill-price sidebar"><span>' + common.formateNumber(sum) + ' vnđ</span></td>' +
                    '</tr>';
            }
            $('#listdate').html(str);
        });
    }
})