FoodOrder = {
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
        });
    },
    load:function () {
        $.getJSON(HTTPSERVER+'FoodOrder/get.api',function (result) {
            console.log(result);
            var html = '';
            var htmlpopup = '';
            var sum = 0;
            var count = 0;
            for (const i in result) {
                html += '<tr>\n' +
                    '                            <td class="sidebar food-no"><span>'+ (Number(i)+1)+'</span></td>\n' +
                    '                            <td class="sidebar food-name"><span>'+result[i].foodname+'</span></td>\n' +
                    '                            <td class="sidebar food-qlt"><span>'+result[i].quantity+'</span></td>\n' +
                    '                            <td class="sidebar food-price"><span>'+common.formateNumber(result[i].price)+'</span></td>\n' +
                    '                        </tr>';
                htmlpopup += '<tr>\n' +
                    '                                        <td class="food-no">'+ (Number(i)+1)+'</td>\n' +
                    '                                        <td class="food-name">'+result[i].foodname+'</td>\n' +
                    '                                        <td class="food-qlt">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-down">-</button></span><input class="form-control basket" type="text" value="'+result[i].quantity+'" min="1" style="text-align: center;"><span class="input-group-btn"><button type="button" class="btn btn-up">+</button></span></div>\n' +
                    '                                            </div>\n' +
                    '                                        </td>\n' +
                    '                                        <td class="food-price"><span>'+common.formateNumber(result[i].price)+'</span></td>\n' +
                    '                                    </tr>'
                sum += Number(result[i].quantity)*Number(result[i].price);
                count+= Number(result[i].quantity);


            }
            $('#listfoodorder').html(html);
            $('#listfoodorderpopup').html(htmlpopup);
            $('.total span').html(common.formateNumber(sum));
            $('#countitem').html(common.formateNumber(count));
            $('.cart-number').html(common.formateNumber(count));
        })
    }
}