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
                                <p>
                                    <?php echo $sitemap[$this->request->translate('sitemapname')]!=''?$sitemap[$this->request->translate('sitemapname')]:$sitemap['sitemapname']?>
                                </p>
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
                            <?php echo $btnOk?>
                        </div>
                        <div class="col-lg-4 left">
                            <?php echo $btnBack?>
                        </div>
                        <div class="col-lg-4 right">
                            <?php echo $btnPortal?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>