<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="mgb-30">Các phòng phù hợp với yêu cầu của bạn</h3>
        </div>
        <div class="col-lg-9">
            <?php foreach($data['rooms'] as $room){ ?>
            <div class="strip_all_tour_list wow fadeIn roombooking roomitem" data-wow-delay="0.1s"
                 roomid="<?php echo $room['id']?>">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="img_list">
                            <img src="<?php echo IMAGESERVER?>autosize-300x300/upload/hotel_room/<?php echo $room['id']?>/<?php echo $room['image']?>"
                                 alt="">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="tour_list_desc">
                                    <h3><strong><?php echo $room['roomname']?></strong></h3>
                                    <ul class="list_icons">
                                        <li><i class="pe-7s-like2"></i> <strong>Tiện
                                                nghi:</strong> <?php echo $room['facilitiesview']?></li>
                                        <li><i class="pe-7s-exapnd2"></i> <strong>Sức chứa:</strong>
                                            <?php echo $room['adults']?> người lớn
                                            <?php if($room['childs'] > 0){ ?>
                                            <?php echo $room['adults']?> trẻ em
                                            <?php } ?></li>
                                        <li><i class="pe-7s-ticket"></i> <strong>Giá phòng 1 đêm:</strong> <a href="">
                                                <?php echo $this->string->numberFormate($room['price'])?> VNĐ</a></li>
                                        <li><i class="pe-7s-keypad"></i> <strong>Số phòng còn trống:</strong> <span
                                                    class="roomremain"></span></li>
                                        <li><i class="pe-7s-ticket"></i> <strong>Giá phòng
                                                <?php echo $data['booking']['numdate']?> đêm:
                                            </strong> <a href="" class="roomprice"
                                                         roomid="<?php echo $room['id']?>"></a><span
                                                    class="roompricenote text-right"> Đã bao gồm thuế và phí</span></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="">
                                    <ul class="list_ok">
                                        <li>Diện tích: <?php echo $room['acreage']?> m<sup>2</sup></li>
                                        <li>Hướng: <?php echo $room['viewname']?></li>
                                        <li>Giường: <?php echo $room['beddetail']?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 pdr-30">
                                <select class="form-control roomqty" roomid="<?php echo $room['id']?>"
                                        style="text-align-last: right;"></select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--End strip -->
            <?php } ?>
        </div>
        <div class="col-lg-3">

            <div class="box_style_1 listRoomBooking">
                <div id="listRoomBooking"></div>
                <a class="btn_full" id="btnBookRoomNow" href="#">Đặt phòng</a>
            </div>
            <!--/box_style_1 -->

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