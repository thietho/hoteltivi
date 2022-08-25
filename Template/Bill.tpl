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
                            <th class="bill-date sidebar" scope="col"><?php echo $this->labels['lbl_date']?></th>
                            <th class="bill-price sidebar" scope="col"><?php echo $this->labels['lbl_amout']?></th>
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
                    <p class="price-vat"><?php echo $this->labels['lbl_warring_service_vat']?></p>
                    <p class="price-total"><?php echo $this->labels['lbl_total']?>: <span id="billtotal"></span> VNĐ</p>
                </div>
            </div>
            <div class="col-lg-8 main-content">
                <div class="content-wrapper">
                    <div class="bill-content regioncurrent">
                        <table class="table">
                            <thead>
                            <tr class="head">
                                <th class="bill-date" scope="col"><?php echo $this->labels['lbl_date']?></th>
                                <th class="bill-service" scope="col"><?php echo $this->labels['lbl_service']?></th>
                                <th class="bill-price" scope="col"><?php echo $this->labels['lbl_unit_price']?> (vnđ)</th>
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
                            <?php echo $btnBack?>
                        </div>
                        <div class="col-lg-6 right">
                            <?php echo $btnPortal?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>