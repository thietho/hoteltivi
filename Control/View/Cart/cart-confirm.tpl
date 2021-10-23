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
                                <label class="sr-only">Họ tên</label>
                                <input type="text" class="form-control" placeholder="Họ tên(*)" name="fullname" value="<?php echo !empty($this->member)?$this->member['fullname']:''?>">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="sr-only">Địa chỉ</label>
                                <input type="text" placeholder="Địa chỉ(*)" name="address" class="form-control" value="<?php echo !empty($this->member)?$this->member['address']:''?>">
                            </div>
                            <div class="col-lg-12 form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="sr-only">Thành phố/Tỉnh</label>
                                        <select class="form-control province" name="province" id="province"
                                                data-live-search="true"></select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="sr-only">Quận/Huyện</label>
                                        <select class="form-control district" name="district" id="district"></select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="sr-only">Phường/Xã</label>
                                        <select class="form-control ward" name="ward" id="ward"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Email</label>
                                <input type="text" value="<?php echo !empty($this->member)?$this->member['email']:''?>" placeholder="Email" name="email" class="form-control">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Điện thoại</label>
                                <input type="text" value="<?php echo !empty($this->member)?$this->member['phone']:''?>" placeholder="Điện thoại(*)" name="phone" class="form-control">
                            </div>
                            <?php if(empty($this->member)){ ?>
                            <div class="col-lg-12">
                                <a href="#" class="float-right"><small><cite>Chưa có tài khoản, tạo mới tại
                                            đây</cite></small></a>
                            </div>
                            <?php } ?>
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
                                <?php foreach($cart as $item){ ?>
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
                                        <input type="radio" name="paymentmethod" id="paymentmethod" value="bank"
                                               checked="">
                                        Chuyển khoản
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="radio" name="paymentmethod" id="paymentmethod" value="cash"
                                               checked="">
                                        Thanh toán khi nhận hàng
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <a href="#" id="btnConfirmOrder" class="btn btn-danger icon-left float-right"><span>Xát nhận đơn hàng</span></a>
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