<section class="main-wrapper info-sunset">
    <div class="lang-icon"><img src="img/lang-vi.png"/></div>
    <div class="container-fluid">
        <?php echo $header?>
        <div class="row">
            <div class="col-lg-4 main-sidebar">
                <div class="sidebar-carousel">
                    <?php foreach($sitemaps as $sitemap){ ?>
                    <div class="item" video="<?php echo $sitemap['video']?>">
                        <a href="#">
                            <p><?php echo $sitemap['sitemapname']?></p>
                            <img src="<?php echo $sitemap['image']?>">
                        </a>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-lg-8 main-content">
                <div class="content-wrapper">
                    <video id="showvideo" autoplay src="<?php echo $sitemaps[0]['video']?>" controls width="100%" height="100%" muted></video>
                </div>
                <div class="menu-bottom">
                    <div class="row">
                        <div class="col-lg-6 left">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>press <span class="icon"><img src="img/level-up.png"/></span></p>
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