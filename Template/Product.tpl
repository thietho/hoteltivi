<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?php echo $sitemap['sitemapname']?></h2>
                <ol>
                    <?php echo $this->breadcrumb?>
                </ol>
            </div>

        </div>
    </section>

    <section id="blog" class="blog">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <?php echo $this->section->loadViewPage('Product/product_list.tpl',['products' => $products]);?>
            <hr>
            <?php if($pagination['numpages'] > 1){ ?>
            <div class="blog-pagination">
                <ul class="justify-content-center">
                    <?php for($i=1;$i<=$pagination['numpages'];$i++){ ?>
                    <li class="<?php echo $i==$pagination['page']?'active':''?>"><a href="<?php echo $this->request->createLink($sitemap['sitemapid'])?>?hlpage=<?php echo $i?>"><?php echo $i?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </section>
</main>