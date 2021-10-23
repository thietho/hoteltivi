<section id="shop-cart">
    <div class="container">
        <div class="shop-cart">
            <div class="row">
                <!--<div class="col-lg-6">
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" placeholder="Coupon Code" id="CouponCode" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" id="widget-subscribe-submit-button" class="btn btn-coupon">Áp dụng</button>
                            </div>
                        </div>
                        <p class="small">Nếu bạn có mã giảm giả, nhập tại đây.</p>
                    </form>
                </div>-->
                <div class="row">
                    <div class="col-lg">
                        <div class="table table-sm table-striped table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="cart-product-remove"></th>
                                    <th class="cart-product-thumbnail">Sản phẩm</th>
                                    <th class="cart-product-price">Giá</th>
                                    <th class="cart-product-quantity">Số lượng</th>
                                    <th class="cart-product-subtotal">Tổng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sum = 0;?>
                                <?php foreach($cart as $item){ ?>
                                    <?php if(isset($item['productid'])){ ?>
                                        <tr class="cartitem">
                                            <td class="cart-product-remove">
                                                <a href="#" onclick="cart.remove(<?php echo $item['productid']?>)"><i class="fa fa-times"></i></a>
                                            </td>
                                            <td class="cart-product-thumbnail">
                                                <a href="#">
                                                    <img src="<?php echo $item['image']?>" alt="<?php echo $item['productname']?>">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="cart-product-thumbnail-name"><?php echo $item['productname']?></div>
                                            </td>
                                            <td class="cart-product-price text-right">
                                                <span class="amount cartprice" productid="<?php echo $item['productid']?>" price="<?php echo $item['price']?>"><?php echo $this->string->numberFormate($item['price'])?></span>
                                            </td>
                                            <td class="cart-product-quantity">
                                                <div class="quantity form-group">
                                                    <input type="number" class="form-control text-right cartquantity" productid="<?php echo $item['productid']?>" value="<?php echo $item['quantity']?>" min="1" aria-required="true" aria-invalid="false" placeholder="1">
                                                </div>
                                            </td>
                                            <td class="cart-product-subtotal text-right">
                                                <span class="amount cartsubtal" productid="<?php echo $item['productid']?>"></span>
                                            </td>
                                        </tr>
                                        <?php $sum += $item['price']*$item['quantity'];?>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="countqty" class="text-right"></th>
                                    <th id="sumorder" class="text-right"></th>
                                </tr>
                                </tfoot>
                            </table>



                        </div>
                        <div class="text-right">
                            <a href="<?php echo $this->request->createLink('cart-confirm');?>" class="btn btn-danger icon-left"><span>Tiếp tục đặt món</span></a>
                            <a href="<?php echo $this->request->createLink('menu');?>" class="btn btn-danger icon-left"><span>Đặt thêm món khác</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>