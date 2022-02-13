<div class="row">
    <div class="col-lg-4 sub-menu-title">
        <div class="text-wrapper">
            <p class="bottom"><?php echo $sitemap['sitemapname']?></p>
        </div>
    </div>
    <div class="col-lg-6 sub-menu-breadcrumb">
        <div class="text-wrapper">
            <div class="top text-right">
                <p class="name">Mr Leo</p>
                <p id="roomnumber">room 198</p>
            </div>
            <div class="bottom">
                <p>Trang chủ <img src="<?php echo HTTPSERVER?>img/right-arrow.png"/> <?php echo $sitemap['sitemapname']?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-2 sub-menu-logo text-center">
        <a href="<?php echo $this->request->createLink()?>"><img src="<?php echo HTTPSERVER?>img/logo-w.png"/></a>
    </div>
</div>