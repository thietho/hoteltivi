FoodOrder = {
    basketOpen:false,
    selectindex:0,
    add:function (foodid,foodname,price,quantity) {
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

        });
    },
    load:function () {
        common.showLoading();
        $.getJSON(HTTPSERVER+'FoodOrder/get.api',function (result) {
            common.endLoading();
            console.log(result);
            var html = '';
            var htmlpopup = '';
            var sum = 0;
            var count = 0;
            for (const i in result) {
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
                    '                                                <div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-down">-</button></span><input class="form-control basket" foodid="'+result[i].foodid+'" type="text" value="'+result[i].quantity+'" min="1" style="text-align: center;"><span class="input-group-btn"><button type="button" class="btn btn-up">+</button></span></div>' +
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
    },
    selectMoveUp:function () {
        if(this.selectindex > 0){
            this.selectindex--;
            $('#listfoodorderpopup').children().removeClass('selectrow');
            $($('#listfoodorderpopup').children()[ this.selectindex]).addClass('selectrow');
        }
    },
    selectMoveDown:function () {
        if(this.selectindex < $('#listfoodorderpopup').children().length-1){
            this.selectindex++;
            $('#listfoodorderpopup').children().removeClass('selectrow');
            $($('#listfoodorderpopup').children()[ this.selectindex]).addClass('selectrow');
        }
    },
    selectIncre:function () {
        var qty = Number($('.selectrow .basket').val());
        $('.selectrow .basket').val(qty+1);
    },
    selectReduce:function () {
        var qty = Number($('.selectrow .basket').val());
        if(qty>0){
            $('.selectrow .basket').val(qty-1);
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
});