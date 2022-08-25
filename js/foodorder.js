FoodOrder = {
    basketOpen:false,
    allOrder:false,
    selectindex:0,
    add:function (foodid,foodname,price,quantity) {
        if(this.allOrder){
            $.post(HTTPSERVER+'FoodOrder/add.api',{
                foodid:foodid,
                foodname:foodname,
                price:price,
                quantity:quantity,
            },function (result) {
                console.log(result);
                $('.quantity').val(1);
                $('#food-order-popup').modal('hide');
                FoodOrder.load();
            });
        }else {
            //toastr["error"](dataLang.alert_food_not_allow_order, dataLang.alert_warning);
            toastr["error"](dataLang.lbl_the_room_is_locked, dataLang.alert_warning);
            $('#food-order-popup').modal('hide');
        }

    },
    update:function (foodid,quantity) {
        $.post(HTTPSERVER+'FoodOrder/updateQuantity.api',{
            foodid:foodid,
            quantity:quantity
        },function (result) {
            console.log(result);
        });
    },
    remove:function (foodid) {
        $.getJSON(HTTPSERVER+'FoodOrder/remove.api?foodid='+foodid,function (result) {
            console.log(result);
        });
    },
    updateOrder:function () {
        common.showLoading();
        $('#listfoodorderpopup .basket').each(function () {
            var foodid = $(this).attr('foodid');
            var quantity = $(this).val();
            if(quantity>0){
                FoodOrder.update(foodid,quantity);
            }else {
                FoodOrder.remove(foodid);
            }
        });
        $('#basket-popup').modal('hide');
        this.load();
    },
    emptyOrder:function () {
        common.showLoading();
        $('#basket-popup').modal('hide');
        $.getJSON(HTTPSERVER+'FoodOrder/clear.api',function (result) {
            console.log(result);
            FoodOrder.load();
            common.endLoading();
        });
    },
    load:function () {
        common.showLoading();
        $.getJSON(HTTPSERVER+'FoodOrder/get.api',function (result) {
            common.endLoading();
            //console.log(result);
            var html = '';
            var htmlpopup = '';
            var sum = 0;
            var count = 0;
            for (var i in result) {
                html += '<tr>' +
                    '                            <td class="sidebar food-no"><span>'+ (Number(i)+1)+'</span></td>' +
                    '                            <td class="sidebar food-name"><span>'+result[i].foodname+'</span></td>' +
                    '                            <td class="sidebar food-qlt"><span>'+result[i].quantity+'</span></td>' +
                    '                            <td class="sidebar food-price"><span>'+common.formateNumber(result[i].price)+'</span></td>' +
                    '                        </tr>';
                htmlpopup += '<tr class="'+ (i==0?'selectrow':'') +'" row="'+i+'">' +
                    '                                        <td class="food-no">'+ (Number(i)+1)+'</td>' +
                    '                                        <td class="food-name">'+result[i].foodname+'</td>' +
                    '                                        <td class="food-qlt">' +
                    '                                            <div class="form-group">' +
                    '                                                <div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-down">-</button></span><input class="form-control basket" foodid="'+result[i].foodid+'" price="'+result[i].price+'" type="text" value="'+result[i].quantity+'" min="1" style="text-align: center;"><span class="input-group-btn"><button type="button" class="btn btn-up">+</button></span></div>' +
                    '                                            </div>' +
                    '                                        </td>' +
                    '                                        <td class="food-price"><span>'+common.formateNumber(result[i].price)+'</span></td>' +
                    '                                    </tr>'
                sum += Number(result[i].quantity)*Number(result[i].price);
                count+= Number(result[i].quantity);
            }
            $('#listfoodorder').html(html);
            $('#listfoodorderpopup').html(htmlpopup);
            $('.total span').html(common.formateNumber(sum));
            $('#countitem').html(common.formateNumber(count));
            $('.cart-number').html(common.formateNumber(count));
            $('.food-price-total').html(common.formateNumber(sum));
        })
    },
    openBasket:function () {
        $('#basket-popup').modal();
        $('#basket-popup .modal-title').removeClass('serviceselect');
    },
    selectMoveUp:function () {
        var countrow = $('#listfoodorderpopup').children().length;
        if(this.selectindex > countrow){
            this.selectindex--;
            $('#listfoodorderpopup').children().removeClass('selectrow');
            $('#basket-popup .modal-title').removeClass('serviceselect');
            $('#basket-popup [index='+(this.selectindex - countrow)+']').addClass('serviceselect');
        }else {
            if(this.selectindex > 0){
                $('#basket-popup .modal-title').removeClass('serviceselect');
                this.selectindex--;
                $('#listfoodorderpopup').children().removeClass('selectrow');
                $($('#listfoodorderpopup').children()[ this.selectindex]).addClass('selectrow');
            }
        }
        console.log(this.selectindex);
    },
    selectMoveDown:function () {
        var countrow = $('#listfoodorderpopup').children().length;
        if(this.selectindex < countrow-1){
            this.selectindex++;
            $('#listfoodorderpopup').children().removeClass('selectrow');
            $($('#listfoodorderpopup').children()[ this.selectindex]).addClass('selectrow');
        }else {
            if(this.selectindex < countrow+3-1){
                this.selectindex++;
                $('#listfoodorderpopup').children().removeClass('selectrow');
                $('#basket-popup .modal-title').removeClass('serviceselect');
                $('#basket-popup [index='+(this.selectindex - countrow)+']').addClass('serviceselect');
            }

        }
        console.log(this.selectindex);
    },
    selectIncre:function () {
        if($('.selectrow .basket').length){
            var qty = Number($('.selectrow .basket').val());
            $('.selectrow .basket').val(qty+1);
            var sum = 0;
            $('#listfoodorderpopup .basket').each(function () {
                var price = $(this).attr('price');
                var quantity = $(this).val();
                sum += Number(price)*Number(quantity)
            });
            $('.food-price-total').html(common.formateNumber(sum))
        }else {
            this.selectMoveDown();
        }
    },
    selectReduce:function () {
        if($('.selectrow .basket').length){
            var qty = Number($('.selectrow .basket').val());
            if(qty>0){
                $('.selectrow .basket').val(qty-1);
                var sum = 0;
                $('#listfoodorderpopup .basket').each(function () {
                    var price = $(this).attr('price');
                    var quantity = $(this).val();
                    sum += Number(price)*Number(quantity)
                });
                $('.food-price-total').html(common.formateNumber(sum))
            }
        }else {
            this.selectMoveUp();
        }
    },
    orderFood:function () {
        common.showLoading();
        $.post(HTTPSERVER+'FoodOrder/saveOrder.api',{
            roomnumber:localStorage.getItem('roomnumber')
        },function (result) {
            console.log(result);
            common.endLoading();
            if(result.statuscode){
                $('#basket-popup').modal('hide');
                FoodOrder.load();
                toastr["success"]("Đặt thức ăn thành công", "Success");
            }else {
                var arr = new Array();
                for (var i in result.errors) {
                    arr.push(result.errors[i])
                }
                toastr["error"](arr.join('<br>'), result.text);
            }
        });
    },
    orderService:function (servicename) {
        if(this.allOrder){
            common.showLoading();
            $.post(HTTPSERVER+'FoodOrder/orderService.api',{
                roomnumber:localStorage.getItem('roomnumber'),
                servicename:servicename
            },function (result) {
                common.endLoading();
                $('#room-service-popup').modal('hide');
                if(result.statuscode){
                    toastr["success"](result.text, "Success");
                }else {
                    var arr = new Array();
                    for (var i in result.errors) {
                        arr.push(result.errors[i])
                    }
                    toastr["error"](arr.join('<br>'), result.text);
                }
            });
        }else {
            toastr["error"](dataLang.alert_food_not_allow_service, dataLang.alert_warning);
            $('#food-order-popup').modal('hide');
        }

    }
}

$(document).ready(function () {
    if($('#btnBasket').length){
        FoodOrder.load();
    }
    $('#basket-popup').on('show.bs.modal', function (e) {
        // do something...
        FoodOrder.basketOpen = true;
        service.popupshow = true;
    })
    $('#basket-popup').on('hidden.bs.modal', function (e) {
        // do something...
        FoodOrder.basketOpen = false;
        service.popupshow = false;
        FoodOrder.selectindex = 0;
    })
    $.getJSON(HTTPSERVER+'RoomItem/getGuestInfo.api?roomnumber='+localStorage.getItem('roomnumber'),function (result) {
        console.log(result);
        var customer = new Object();
        if(result.Data.length >0 ){
            for (var i in result.Data) {
                if(result.Data[i].IsMainGuest){
                    customer = result.Data[i];
                }
            }
            $('.sub-menu-breadcrumb .name').html(customer.Name)
            $('#roomnumber').html(localStorage.getItem('roomnumber'))
            $('.content .name').html(customer.Name)
            FoodOrder.allOrder = true;
        }else {
            //FoodOrder.allOrder = false;
            FoodOrder.allOrder = true;
        }

    })
});
// MainRegion ={
//     indexcurrent:0
// }
// CartRegion ={
//     indexcurrent:0
// }
// CartPopupRegion ={
//     indexcurrent:0
// }
// RegionSelect = {
//     regioncurrent:'main-region',
//     indexcurrent:0,
// };