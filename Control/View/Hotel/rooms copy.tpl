<div class="container">
    <h2>Danh sách phòng</h2>
    <div class="row">
        <?php foreach($data['rooms'] as $room){ ?>
        <div class="col-md-6">
            <div class="row roomitem">
                <div class="col-6">
                    <figure>
                        <img src="<?php echo IMAGESERVER?>autosize-300x300/upload/hotel_room/<?php echo $room['id']?>/<?php echo $room['image']?>"
                            alt="" class="img-fluid">
                    </figure>
                </div>
                <div class="col-6">
                    <h5>
                        <?php echo $room['roomname']?>
                    </h5>
                    <ul>
                        <li>Diện tích:
                            <?php echo $room['acreage']?> m<sup>2</sup>
                        </li>
                        <li>Hướng:
                            <?php echo $room['view']?>
                        </li>
                        <li>Giường:
                            <?php echo $room['beddetail']?>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <?php } ?>
    </div>
</div>