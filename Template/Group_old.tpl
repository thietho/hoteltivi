<section class="main-wrapper room-service">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>

        <div class="row bodyview">
            <?php foreach($sitemaps as $key => $sitemap){ ?>
            <div class="item col-lg-4" index="<?php echo $key?>">
                <a href="<?php echo $this->request->createLink($sitemap['sitemapid'])?>" pagetype="<?php echo $sitemap['sitemaptype']?>" video="<?php echo $sitemap['video']?>">
                    <p>
                        <?php echo $sitemap[$this->request->translate('sitemapname')]!=''?$sitemap[$this->request->translate('sitemapname')]:$sitemap['sitemapname']?>
                    </p>
                    <img src="<?php echo $sitemap['image']?>" servicename="<?php echo $sitemap[$this->request->translate('sitemapname')]!=''?$sitemap[$this->request->translate('sitemapname')]:$sitemap['sitemapname']?>">
                </a>
            </div>
            <?php } ?>
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