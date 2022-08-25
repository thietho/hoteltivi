<section class="main-wrapper room-service">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>

        <div class="row">
            <div class="col-lg-12 px-0 main-content">
                <div class="content-wrapper">
                    <div class="room-service-carousel">
                        <?php foreach($services as $key => $service){ ?>
                        <div class="item col-lg-12" index="<?php echo $key?>">
                            <a href="#">
                                <p>
                                    <?php echo $service[$this->request->translate('servicename')]!=''?$service[$this->request->translate('servicename')]:$service['servicename']?>
                                </p>
                                <img src="<?php echo $service['image']?>" servicename="<?php echo $service[$this->request->translate('servicename')]!=''?$service[$this->request->translate('servicename')]:$service['servicename']?>">
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 px-0 main-content">
                <div class="menu-bottom">
                    <div class="row">
                        <div class="col-lg-4 left pr-0">
                            <?php echo $btnOk?>
                        </div>
                        <div class="col-lg-4 left">
                            <?php echo $btnBack?>
                        </div>
                        <div class="col-lg-4 right">
                            <?php echo $btnPortal?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>