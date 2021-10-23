<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <div class="carousel-inner" role="listbox">
            <?php foreach($banners as $key => $banner){ ?>
            <div class="carousel-item <?php echo $key==0?'active':''?>" style="background-image: url(<?php echo $banner['image']?>);">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2><?php echo $banner['title']?></h2>
                        <p><?php echo $banner['summary']?></p>
                        <div class="text-center"><a href="" class="btn-get-started">Đặt Món</a></div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section><!-- End Hero -->