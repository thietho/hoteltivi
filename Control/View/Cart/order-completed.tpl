<section id="shop-checkout">
    <form id="frmConfirmOrder" method="post" class="sep-top-md">
        <div class="container">
            <div class="shop-cart">
                <div class="row">
                    <div class="col-lg-6 no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="upper">Địa chỉ giao hàng</h4>
                            </div>
                            <div class="col-lg-12 form-group">
                                Họ tên: <?php echo $saleOrder['shipping_fullname']?>
                            </div>
                            <div class="col-lg-12 form-group">
                                Địa chỉ: <?php echo $saleOrder['shipping_address']?>
                                <?php echo $saleOrder['shipping_ward_text']!=''?', '.$saleOrder['shipping_ward_text']:''?>
                                <?php echo $saleOrder['shipping_district_text']!=''?', '.$saleOrder['shipping_district_text']:''?>
                                <?php echo $saleOrder['shipping_province_text']!=''?', '.$saleOrder['shipping_province_text']:''?>
                            </div>

                            <div class="col-lg-6 form-group">
                                Email: <?php echo $saleOrder['shipping_email']?>
                            </div>
                            <div class="col-lg-6 form-group">
                                Điện thoại: <?php echo $saleOrder['shipping_phone']?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="upper">Đơn hàng</h4>
                        <div class="table table-sm table-striped table-responsive table table-bordered table-responsive">
                            <table class="table m-b-0">
                                <thead>
                                <tr>
                                    <th class="cart-product-thumbnail">Sản phẩm</th>
                                    <th class="cart-product-subtotal">Số lượng</th>
                                    <th class="cart-product-subtotal">Giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sum = 0;?>
                                <?php foreach($saleOrder['detail'] as $item){ ?>
                                <?php if(isset($item['productid'])){ ?>
                                <tr>
                                    <td class="cart-product-thumbnail">
                                        <div class="cart-product-thumbnail-name"><?php echo $item['productname']?></div>
                                    </td>
                                    <td class="cart-product-subtotal text-right">
                                        <span class="amount "><?php echo $this->
                                            string->numberFormate($item['quantity'])?></span>
                                    </td>
                                    <td class="cart-product-subtotal text-right">
                                        <span class="amount text-right"><?php echo $this->
                                            string->numberFormate($item['price']*$item['quantity'])?></span>
                                    </td>
                                </tr>
                                <?php $sum+= $item['price']*$item['quantity']?>
                                <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="upper">Phương thức thanh toán</h4>
                            <div class="list-group">
                                <p>
                                    <label>
                                        <?php echo $saleOrder['paymentmethod_text']?>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <h4>Thanh toán</h4>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="cart-product-name">
                                            <strong>Tổng cộng</strong>
                                        </td>
                                        <td class="cart-product-name text-right">
                                            <span class="amount"><strong><?php echo $this->
                                                    string->numberFormate($sum)?></strong></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>