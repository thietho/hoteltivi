<section class="main-wrapper room-service">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>

        <div class="row">
            <div class="col-lg-12 px-0 main-content">
                <div class="content-wrapper">
                    <div class="tour-travel-carousel">
                        <?php foreach($services as $service){ ?>
                        <div class="item col-lg-12">
                            <a href="#">
                                <img src="<?php echo $service['image']?>">
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 px-0 main-content">
                <div class="menu-bottom">
                    <div class="row">
                        <div class="col-lg-4 left pr-0">
                            <div class="text-wrapper choise">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>Nhấn <span class="icon"><img src="<?php echo HTTPSERVER?>img/ok-icon.png"/></span></p>
                                            <p>để chọn</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>dịch <span>vụ</span></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 left">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>Nhấn <span class="icon"><img src="<?php echo HTTPSERVER?>img/level-up.png"/></span></p>
                                            <p>trở lại</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>Trở <span>lại</span></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 right">
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