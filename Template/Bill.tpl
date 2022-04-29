<section class="main-wrapper my-bill">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>
        <div class="row">
            <div class="col-lg-4 px-0">
                <div class="col-lg-12 main-sidebar-bill">
                    <table width="100%" class="table">
                        <thead>
                        <tr class="head">
                            <th class="bill-date sidebar" scope="col">Ngày</th>
                            <th class="bill-price sidebar" scope="col">Số tiền</th>
                        </tr>
                        </thead>

                    </table>
                    <div class="showcontent">
                        <table width="100%" class="table">
                            <tbody id="listdate"></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 bill-total px-0">
                    <p class="price-vat">Giá đã bao gồm 10% phí dịch vụ và 10% VAT</p>
                    <p class="price-total">Tổng cộng: <span id="billtotal"></span> VNĐ</p>
                </div>
            </div>
            <div class="col-lg-8 main-content">
                <div class="content-wrapper">
                    <div class="bill-content regioncurrent">
                        <table class="table">
                            <thead>
                            <tr class="head">
                                <th class="bill-date" scope="col">Ngày</th>
                                <th class="bill-service" scope="col">Dịch vụ</th>
                                <th class="bill-price" scope="col">Đơn giá (vnđ)</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="showcontent">
                            <table class="table">
                                <tbody id="listitems"></tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="menu-bottom">
                    <div class="row">
                        <div class="col-lg-6 left">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>Nhấn <span class="icon"><img
                                                            src="<?php echo HTTPSERVER?>img/level-up.png"/></span></p>
                                            <p>trở lại</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>Trở <span>lại</span></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 right">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>Nhấn <span>PORTAL</span></p>
                                            <p>về trang chủ</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>Trang <span>chủ</span></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>