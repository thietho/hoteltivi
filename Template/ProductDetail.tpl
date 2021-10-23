<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?php echo $sitemap['sitemapname']?></h2>
                <ol>
                    <?php echo $breadcrumb?>
                </ol>
            </div>

        </div>
    </section>

    <section id="thuc-don-chi-tiet" class="thuc-don-chi-tiet">
        <div class="container">
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">

                            <div class="preview-pic tab-content">
                                <?php foreach($product['images'] as $key => $image){ ?>
                                <div class="tab-pane <?php echo $key==0?'active':''?>" id="pic-<?php echo $key?>"><img src="<?php echo $image['image']?>" /></div>
                                <?php } ?>
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                <?php foreach($product['images'] as $key => $image){ ?>
                                <li class="<?php echo $key==0?'active':''?>"><a class="tab-item" data-target="#pic-<?php echo $key?>" data-toggle="tab"><img src="<?php echo $image['image']?>" /></a></li>
                                <?php } ?>
                            </ul>

                        </div>
                        <div class="details col-md-6">
                            <h4 class="product-title"><?php echo $product['productname']?></h4>
                            <p class="product-description"><?php echo $product['summary']?></p>
                            <h4 class="price">Giá: <span><?php echo $product['priceview']?></span></h4>
                            <div class="action">
                                <a productid="<?php echo $product['id']?>"
                                   productname="<?php echo $product['productname']?>"
                                   price="<?php echo $product['price']?>"
                                   image="<?php echo $product['image']?>"
                                   class="add-to-cart btn-dat-hang btn-get-started">Đặt Món</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mgt-30">

            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-title"><span>Món ăn bán chạy</span></h3>
                </div>
            </div>
            <?php echo $this->section->loadViewPage('Product/product_list.tpl',['products' => $bestsale]);?>
        </div>
    </section>

</main>