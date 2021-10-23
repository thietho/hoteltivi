<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php foreach($data['rooms'] as $room){ ?>
            <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="fotorama" data-max-width="100%" data-nav="thumbs">
                            <img src="<?php echo IMAGESERVER?>autosize-500x500/upload/hotel_room/<?php echo $room['id']?>/<?php echo $room['image']?>"
                                 alt="<?php echo $room['roomname']?>">
                            <?php foreach($room['gallery'] as $item){ ?>
                            <img src="<?php echo IMAGESERVER?>autosize-500x500/upload/hotel_room/<?php echo $room['id']?>/<?php echo $item['image']?>"
                                 alt="<?php echo $item['title']?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="tour_list_desc">
                            <h3><strong><?php echo $room['roomname']?></strong></h3>
                            <span class="limit-text-3"><?php echo $room['description']?></span>                          
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="price_list">
                            <div>
                                <ul class="list_ok">
                                    <li>Diện tích: <?php echo $room['acreage']?> m<sup>2</sup></li>
                                    <li>Hướng: <?php echo $room['viewname']?></li>
                                    <li>Giường: <?php echo $room['beddetail']?></li>
                                </ul>
                                <p><a href="<?php echo $room['link']?>" class="btn_1">Chi tiết</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End strip -->
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item active"><span class="page-link">1<span class="sr-only">(current)</span></span>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>