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
                    <?php if(count($sitemaps) < 4){ ?>
                    <?php for($i=0;$i<4;$i++){ ?>
                    <?php foreach($sitemaps as $sitemap){ ?>
                    <div class="item" video="<?php echo $sitemap['video']?>" sitemapid="<?php echo $sitemap['id']?>">
                        <a href="#">
                            <p><?php echo $sitemap['sitemapname']?></p>
                            <img src="<?php echo $sitemap['image']?>">
                        </a>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-8 main-content">
                <div class="content-wrapper">
                    <div id="showbanner"></div>
                    <video id="showvideo" autoplay src="" width="100%" height="100%" muted onended="$('.slick-next').click();"></video>
                </div>
                <div class="menu-bottom">
                    <div class="row">
                        <div class="col-lg-6 left">
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
                        <div class="col-lg-6 right">
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