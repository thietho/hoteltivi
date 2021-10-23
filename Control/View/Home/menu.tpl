<section id="cta" class="cta">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <img src="<?php echo HTTPSERVER?>assets/img/LOGO-NHA-HANG-2.png" alt="" class="img-fluid logo">
                <h3 class="section-title mgt-20">
                    <b></b>
                    <span>Thực đơn tại Ẩm Thực 3 Cựa</span>
                    <b></b>
                </h3>
                <p> Thực đơn hấp dẫn của nhà hàng có tới hơn 150 món ăn chuẩn vị Việt Nam sẵn sàng cho bạn lựa chọn</p>
            </div>
            <div class="col-lg-12 tab-thuc-don">
                <ul class="nav justify-content-center nav-pills mb-3" id="pills-tab" role="tablist">
                    <?php foreach($sitemaps as $key => $sitemap){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $key==0?'active':''?>" id="menu-tab-1" data-bs-toggle="pill" data-bs-target="#menu-<?php echo $key+1?>" type="button" role="tab" aria-controls="menu-<?php echo $key+1?>" aria-selected="true">
                            <?php echo $sitemap['sitemapname']?>
                        </button>
                    </li>
                    <?php } ?>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <?php foreach($sitemaps as $key => $sitemap){ ?>
                    <div class="tab-pane fade show <?php echo $key==0?'active':''?>" id="menu-<?php echo $key+1?>" role="tabpanel" aria-labelledby="menu-tab-<?php echo $key+1?>">
                        <?php echo $this->loadViewPage('Product/product_list.tpl',['products' => $sitemap['products']]);?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</section>