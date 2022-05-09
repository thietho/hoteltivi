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
                            <div class="text-wrapper choise">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p><?php echo $this->labels['lbl_press']?> <span class="icon"><img src="<?php echo HTTPSERVER?>img/ok-icon.png"/></span></p>
                                            <p><?php echo $this->labels['lbl_to_choose']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_service']?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 left">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p><?php echo $this->labels['lbl_press']?> <span class="icon"><img src="<?php echo HTTPSERVER?>img/level-up.png"/></span></p>
                                            <p><?php echo $this->labels['lbl_return']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_return']?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 right">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p><?php echo $this->labels['lbl_press']?> <span>PORTAL</span></p>
                                            <p><?php echo $this->labels['lbl_return_homepage']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_homepage']?></p>
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