<section class="main-wrapper list-channel">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>
        <div class="row">
            <div class="col-lg-3 pl-0">
                <div class="list-group">
                    <a href="<?php echo $this->request->createLink('listchannel')?>" class="list-group-item list-group-item-action list-group-channel <?php echo $this->request->get('group')==''?'groupchannelselect':''?>"><?php echo $this->labels['lbl_all_chanels']?></a>
                    <?php foreach($channelGroups as $key => $group){ ?>
                    <a href="<?php echo $this->request->createLink('listchannel')?>?group=<?php echo $key?>" class="list-group-item list-group-item-action list-group-channel <?php echo $this->request->get('group')==$key?'groupchannelselect':''?>"><?php echo $this->labels['channel_'.$key]?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-9 px-0 main-content">
                <div class="content-wrapper">
                    <div class="list-channel-carousel">
                        <?php foreach($channels as $key => $channel){ ?>
                        <div class="item col-lg-12" index="<?php echo $key?>" ip="<?php echo $channel['channelip']?>" port="<?php echo $channel['channelport']?>">
                            <a href="#">
                                <img src="<?php echo $channel['logo']?>">
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