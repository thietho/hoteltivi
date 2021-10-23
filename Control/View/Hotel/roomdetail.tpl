<?php $room = $data['room']?>

<div class="container">
    <div class="row">
        <div class="col-lg-12" id="single_tour_desc">
            <!-- Map button for tablets/mobiles -->
            <div id="Img_carousel" class="slider-pro">
                <div class="sp-slides">
                    <?php foreach($data['gallery'] as $item){ ?>                                       
                    <div class="sp-slide">
                        <img alt="Image" class="sp-image" src="css/images/blank.gif" data-src="<?php echo IMAGESERVER?>autosize-800x800/upload/hotel_room/<?php echo $room['id']?>/<?php echo $item['image']?>" data-small="<?php echo IMAGESERVER?>autosize-800x800/upload/hotel_room/<?php echo $room['id']?>/<?php echo $item['image']?>" data-medium="<?php echo IMAGESERVER?>autosize-800x800/upload/hotel_room/<?php echo $room['id']?>/<?php echo $item['image']?>" data-large="<?php echo IMAGESERVER?>autosize-800x800/upload/hotel_room/<?php echo $room['id']?>/<?php echo $item['image']?>" data-retina="<?php echo IMAGESERVER?>autosize-800x800/upload/hotel_room/<?php echo $room['id']?>/<?php echo $item['image']?>">
                    </div>
                    <?php } ?>
                    
                </div>
                <div class="sp-thumbnails">
                    <?php foreach($data['gallery'] as $item){ ?>     
                    <img alt="Image" class="sp-thumbnail" src="<?php echo IMAGESERVER?>autosize-800x800/upload/hotel_room/<?php echo $room['id']?>/<?php echo $item['image']?>">
                    <?php } ?>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-12">
                    <h2><?php echo $room['roomname']?></h2>
                    <p>
                        <?php echo $room['description']?>
                    </p>
                    <ul class="list_ok">
                        <li>Diện tích: <?php echo $room['acreage']?> m<sup>2</sup></li>
                        <li>Hướng: <?php echo $room['viewname']?></li>
                        <li>Giường: <?php echo $room['beddetail']?></li>
                    </ul>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Tiện nghi</h4>
                            <p><?php echo $room['facilitiesview']?></p>
                        </div>
                        <div class="col-md-6">
                            <h4>Tiện nghi khác</h4>
                            <p><?php echo $room['facilitiesotherview']?></p>
                        </div>
                    </div>
                    <!-- End row  -->
                </div>
                <!-- End col-md-9  -->
            </div>
            <!-- End row  -->
        </div>
        <!--End  single_tour_desc-->

    </div>
    <!--End row -->
</div>
<!--End container -->