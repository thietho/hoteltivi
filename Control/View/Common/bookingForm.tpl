<section id="booking">
    <div id="search">
        <ul class="nav nav-tabs">
            <li><a href="#frmBookRoom" data-toggle="tab" class="active show">Phòng Nghỉ</a></li>
            <li><a href="#frmBookTicket" data-toggle="tab">Vé Cổng</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active show" id="frmBookRoom">
                <!-- End row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Ngày Nhận</label>
                            <input class="date-pick form-control" data-date-format="dd-mm-yyyy" type="text"
                                   id="txtFromDate"
                                   placeholder="Arrival" value="<?php echo $data['databooking']['checkin']?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Ngày Trả</label>
                            <input class="date-pick form-control" data-date-format="dd-mm-yyyy" type="text"
                                   id="txtToDate"
                                   placeholder="Departure" value="<?php echo $data['databooking']['checkout']?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Số Người</label>
                            <div class="viewinput form-control" id="resortqtyinput">
                                <span id="qtyAdults"><?php echo $data['databooking']['adults']?></span> người
                                <span id="qtyChilds"><?php echo $data['databooking']['childs']?></span> trẻ em
                                <span id="qtyRooms"><?php echo $data['databooking']['rooms']?></span> phòng
                            </div>
                            <div class="popupinput" id="popup-resortqtyinput">
                                <div class="form-group row">
                                    <div class="col-5 text-center">
                                        <label class="col-form-label">Người lớn</label>
                                    </div>
                                    <div class="col-7">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary btnReduce" view="txtAudults"
                                                        qty="qtyAdults" type="button"><i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control text-center"
                                                   value="<?php echo $data['databooking']['adults']?>"
                                                   aria-describedby="basic-addon1" id="txtAudults">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btnIncrease" view="txtAudults"
                                                        qty="qtyAdults" type="button"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-5 text-center">
                                        <label class="col-form-label">Trẻ em</label>
                                    </div>
                                    <div class="col-7">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary btnReduce" view="txtChilds"
                                                        qty="qtyChilds" type="button"><i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control text-center"
                                                   value="<?php echo $data['databooking']['childs']?>"
                                                   aria-describedby="basic-addon1" id="txtChilds">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btnIncrease" view="txtChilds"
                                                        qty="qtyChilds" type="button"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-5 text-center">
                                        <label class="col-form-label">Phòng</label>
                                    </div>
                                    <div class="col-7">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary btnReduce" view="txtRooms"
                                                        qty="qtyRooms" type="button"><i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control text-center"
                                                   value="<?php echo $data['databooking']['rooms']?>"
                                                   aria-describedby="basic-addon1" id="txtRooms">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btnIncrease" view="txtRooms"
                                                        qty="qtyRooms" type="button"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>.</label>
                            <button id="btnBookRooms" class="btn_1 green">Đặt Phòng</button>
                        </div>
                    </div>

                </div>
                <!-- End row -->
            </div>
            <!-- End rab -->
            <div class="tab-pane" id="frmBookTicket">
                <!-- End row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Ngày Đặt</label>
                            <input class="date-pick form-control" id="txtCheckinDate"
                                   data-date-format="dd-mm-yyyy" <?php echo $data['databooking']['checkdate']?>
                            type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số Người</label>
                            <div class="viewinput form-control" id="resortqtyinputticket">
                                <span id="qtyAdultsTicket"><?php echo $data['databooking']['tickeadults']?></span> người
                                <span id="qtyChildsTicket"><?php echo $data['databooking']['ticketchilds']?></span> trẻ
                                em
                            </div>
                        </div>
                        <div class="popupinput" id="popup-resortqtyinputticket">
                            <div class="form-group row">
                                <div class="col-5 text-center">
                                    <label class="col-form-label">Người lớn</label>
                                </div>
                                <div class="col-7">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary btnReduce"
                                                    view="txtAudultsTicket" qty="qtyAdultsTicket" type="button"><i
                                                        class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="text" class="form-control text-center"
                                               value="<?php echo $data['databooking']['tickeadults']?>"
                                               aria-describedby="basic-addon1" id="txtAudultsTicket">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary btnIncrease"
                                                    view="txtAudultsTicket" qty="qtyAdultsTicket" type="button"><i
                                                        class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-5 text-center">
                                    <label class="col-form-label">Trẻ em</label>
                                </div>
                                <div class="col-7">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary btnReduce" view="txtChildsTicket"
                                                    qty="qtyChildsTicket" type="button"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control text-center"
                                               value="<?php echo $data['databooking']['ticketchilds']?>"
                                               aria-describedby="basic-addon1" id="txtChildsTicket">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary btnIncrease" view="txtChildsTicket"
                                                    qty="qtyChildsTicket" type="button"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>.</label>
                            <button id="btnBookTicket" class="btn_1 green"></i>Đặt Vé</button>
                        </div>
                    </div>

                </div>
                <!-- End row -->
            </div>
        </div>
        <div id="bookingwaring" class="alert alert-danger" role="alert" style="display: none;"></div>
    </div>
</section>