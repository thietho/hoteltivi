<section class="main-wrapper my-bill">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>
        <div class="row">
            <div class="col-lg-4 px-0">
                <div class="col-lg-12 main-sidebar">
                    <table width="100%" class="table">
                        <thead>
                        <tr class="head">
                            <th class="bill-date sidebar" scope="col">date</th>
                            <th class="bill-price sidebar" scope="col">mount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="bill-date sidebar"><span>15.10.2021</span></td>
                            <td class="bill-price sidebar"><span>1.500.000 vnđ</span></td>
                        </tr>
                        <tr>
                            <td class="bill-date sidebar"><span>15.10.2021</span></td>
                            <td class="bill-price sidebar"><span>1.500.000 vnđ</span></td>
                        </tr>
                        <tr>
                            <td class="bill-date sidebar"><span>15.10.2021</span></td>
                            <td class="bill-price sidebar"><span>1.500.000 vnđ</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 bill-total px-0">
                    <p class="price-vat">Prices are subject to 10% service charge and 10% government VAT</p>
                    <p class="price-total">YOUR TOTAL: 5.000.000 VNĐ</p>
                </div>
            </div>
            <div class="col-lg-8 main-content">
                <div class="content-wrapper">
                    <div class="bill-content">
                        <table class="table">
                            <thead>
                            <tr class="head">
                                <th class="bill-date" scope="col">date</th>
                                <th class="bill-service" scope="col">service</th>
                                <th class="bill-price" scope="col">price (vnđ)</th>
                            </tr>
                            </thead>
                            <tbody id="listitems"></tbody>
                        </table>
                    </div>

                </div>
                <div class="menu-bottom">
                    <div class="row">
                        <div class="col-lg-6 left">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>press <span class="icon"><img src="<?php echo HTTPSERVER?>img/level-up.png"/></span></p>
                                            <p>to level up</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>level <span>back</span></p>
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
                                            <p>press <span>smart</span></p>
                                            <p>to close page</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>the <span>menu</span></p>
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