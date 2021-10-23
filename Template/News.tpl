<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Bài viết</h2>
                <ol>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>Bài viết</li>
                </ol>
            </div>

        </div>
    </section>

    <section id="blog" class="blog">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">
                    <div class="row">
                        <?php foreach($contents as $content){ ?>
                        <div class="bai-viet-item col-lg-4">
                            <a href="#">
                                <figure class="figure">
                                    <div class="box-image">
                                        <div class="image-cover">
                                            <img src="<?php echo $content['image']?>" class="figure-img img-fluid rounded" alt="<?php echo $content['title']?>">
                                        </div>
                                    </div>
                                    <h5 class="title"><?php echo $content['title']?></h5>
                                    <span><?php echo $content['createdat']?></span>
                                </figure>
                            </a>
                        </div>
                        <?php }?>
                    </div><!-- End blog entries list -->
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
                <div class="col-lg-4">
                    <?php echo $newpost?><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section>

</main>