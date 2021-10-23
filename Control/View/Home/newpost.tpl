<section class="bai-viet">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="section-title"><b></b><span>Bài viết mới</span><b></b></h3>
                <p>Cùng đầu bếp của Nhà hàng chúng tôi tìm hiểu và học cách chế biến một số món ăn thông dụng nhé!</p>
            </div>
            <div class="col-lg-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($newsposts as $content){ ?>
                    <div class="bai-viet-item">
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
                    <?php } ?>
                </div>
            </div>

        </div>

    </div>
</section>