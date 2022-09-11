<style>
    .slick-current{
        outline: #F58220 solid 6px!important;
        outline-offset: -7px!important;
    }
    .myCarousel{
        height: 100%;
    }
    .myCarousel .carousel-inner{
        height: 100%;
    }
    #showbanner{
        height: 100%;
        display: none;
    }
    .sidebar-carousel{
        position: absolute;
    }
</style>
<section class="main-wrapper info-sunset">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>
        <div class="row">
            <div class="col-lg-4 main-sidebar video-list">
                <div class="sidebar-carousel">
                    <?php foreach($sitemaps as $sitemap){ ?>
                    <div class="item" video="<?php echo $sitemap['video']?>" sitemapid="<?php echo $sitemap['id']?>">
                        <a href="#">
                            <p>
                                <?php echo $sitemap[$this->request->translate('sitemapname')]!=''?$sitemap[$this->request->translate('sitemapname')]:$sitemap['sitemapname']?>
                            </p>
                            <img src="<?php echo $sitemap['image']?>">
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-8 main-content">
                <div class="content-wrapper">
                    <div id="showbanner"></div>
                    <video id="showvideo" autoplay src="" width="100%" height="100%" muted onended="//$('.slick-next').click();"></video>
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