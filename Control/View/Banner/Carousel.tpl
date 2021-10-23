<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($banners as $key => $banner){ ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $key?>" class="<?php echo $key==0?'active':'';?>"></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach($banners as $key => $banner){ ?>
        <div class="carousel-item <?php echo $key==0?'active':'';?>">
            <img class="first-slide width100"
                src="<?php echo IMAGESERVER?>root/upload/cms_banner/<?php echo $id?>/<?php echo $banner['image']?>"
                alt="<?php echo $banner['title']?>">
            <div class="container">
                <div class="carousel-caption text-left">
                    <?php if($banner['title']){ ?>
                    <h1>
                        <?php echo $banner['title']?>
                    </h1>
                    <?php } ?>
                    <?php if($banner['summary']){ ?>
                    <p>
                        <?php echo $banner['summary']?>
                    </p>
                    <?php } ?>
                    <?php if($banner['link']){ ?>
                    <p><a class="btn btn-lg btn-primary" href="<?php echo $banner['link']?>" role="button">Learn
                            more</a></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>