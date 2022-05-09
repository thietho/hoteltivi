$(document).ready(function() {
    // Booking.calcule();
    $('.roomqty').change(function() {
        Booking.calcule();
    });
    $('.roomlistitem').click(function() {
        $('#roomdetail').modal();
    });
    var url = HTTPSERVER+'RoomBooking/checkRoom.api';
    if(request.roomtype != undefined){
        $('.roomtype-'+request.roomtype).addClass('roomtype-active');
    }
    $('.roomitem').each(function() {
        var roomid = $(this).attr('roomid');
        var data = {
            roomid: roomid,
            checkin: common.dateToMySQL(common.parseToDate($('#txtFromDate').val(), 'DMY','-')),
            checkout: common.dateToMySQL(common.parseToDate($('#txtToDate').val(), 'DMY','-'))
        };
        var eleroomremain = $(this).find('.roomremain')
        var eleroomprice = $(this).find('.roomprice')
        var eleroomqty = $(this).find('.roomqty')
        $.post(url, data, function(result) {
            try {
                result = JSON.parse(result);
                console.log(result);
                eleroomremain.html(result.roomremain + " phòng");
                eleroomprice.html(common.formateNumber(result.price));
                eleroomprice.attr('price', result.price);
                var str = '<option value="0">0</option>';
                for (var i = 1; i <= result.roomremain; i++) {
                    str += '<option value="' + i + '">' + i + '</option>';
                }
                eleroomqty.html(str);
            } catch (error) {

            }
        });
    });
    $('#btnBookRoomNow').click(function() {
        var data = [];
        $('.roomitem').each(function() {
            var qty = Number($(this).find('.roomqty').val());
            var roomid = $(this).find('.roomqty').attr('roomid');
            var price = ($(this).find('.roomprice').attr('price'));
            if (qty > 0) {
                var obj = {
                    roomid: roomid,
                    qty: qty,
                    price: price
                };
                data.push(obj);
            }
        });
        var url = HTTPSERVER+'RoomBooking/bookRoom.api';
        if(data.length){
            common.showLoading();
            $.post(url, JSON.stringify(data), function(result) {
                common.endLoading();
                try{
                    result = JSON.parse(result)
                    if(result.statuscode){
                        window.location = "<?php echo $this->request->createLink('bookingroom');?>";
                    }
                }catch (e) {

                }
            });
        }else {
            $.alert({
                title: 'Cảnh báo!',
                content: 'Bạn chưa chọn <?php echo $this->labels['lbl_quantity']?> phòng',
            });
        }
    });
});
$(document).ready(function() {
    $(".fancybox").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none'
    });
});
var Booking = {
    calcule: function() {
        var str = '';
        var sumRoom = 0;
        var sumAmount = 0;
        $('.roomitem').each(function() {
            var qty = Number($(this).find('.roomqty').val());
            price = ($(this).find('.roomprice').attr('price'));
            if (qty > 0) {
                str += '<div class="bookingroom-row"><div class="bookingroom-qty">' + qty + ' phòng</div>';
                str += '<div class="text-right bookingroom-subtotal">' + common.formateNumber(qty * price) + ' VNĐ</div></div>';
                sumRoom += qty;
                sumAmount += qty * price;
            }
        });
        str += '<div class="roomprice text-right">Tổng cộng: ' + common.formateNumber(sumAmount) + ' VNĐ</div>';
        $('#listRoomBooking').html(str);
    }
}