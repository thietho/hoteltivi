<section class="main-wrapper food-order">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>
        <div class="row">
            <div class="col-lg-4 px-0" id="cart-region">
                <?php echo $cart?>
            </div>
            <div class="col-lg-8 main-content" id="main-region">
                <div class="content-wrapper">
                    <div class="food-order-carousel">
                        <?php foreach($sitemaps as $key => $sitemap){ ?>
                        <div class="item col-lg-12" index="<?php echo $key?>" sitemapid="<?php echo $sitemap['sitemapid']?>">
                            <a href="<?php echo $this->request->createLink($sitemap['sitemapid'])?>">
                                <p><?php echo $sitemap['sitemapname']?></p>
                                <img src="<?php echo $sitemap['image']?>">
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
                                            <p><?php echo $this->labels['lbl_press']?> <span class="icon"><img src="<?php echo HTTPSERVER?>img/ok-icon.png"/></span></p>
                                            <p><?php echo $this->labels['lbl_to_choose']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_service']?></p>
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
                                            <p><?php echo $this->labels['lbl_press']?> <span class="icon"><img src="<?php echo HTTPSERVER?>img/level-up.png"/></span></p>
                                            <p><?php echo $this->labels['lbl_return']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_return']?></p>
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
                                            <p><?php echo $this->labels['lbl_press']?> <span>PORTAL</span></p>
                                            <p><?php echo $this->labels['lbl_return_homepage']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_homepage']?></p>
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