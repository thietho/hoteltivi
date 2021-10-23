<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="color-dark-2"><strong>Chi tiết đặt phòng</strong></h4>
                <div class="row">
                    <div class="col-6">
                        <h6 class="booking-date">Nhận phòng</h6>
                        <label>
                            <?php echo $bookingdetail['checkin']?>
                        </label>
                        <h6 class="card-subtitle mb-2 mt-1 text-muted">Từ 2h trưa</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="booking-date">Trả phòng</h6>
                        <label>
                            <?php echo $bookingdetail['checkout']?>
                        </label>
                        <h6 class="card-subtitle mb-2 mt-1 text-muted">Đến 12h trưa</h6>
                    </div>
                    <div class="col-12">
                        <h6 class="mt-2">Tổng thời gian lưu trú: </h6>
                        <label class="mb-2">
                            <?php echo $bookingdetail['numdate']?> đêm
                        </label>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h6>Các phòng bạn chọn</h6>
                        <ul>
                            <?php foreach($bookingdetail['bookingdetail'] as $room){ ?>
                            <li>
                                <?php echo $room['qty']?> x
                                <?php echo $room['roomname']?>
                            </li>
                            <?php } ?>
                        </ul>
                        <h6 class="mt-2">Số người có thể ở</h6>
                        <label>
                            <?php echo $bookingdetail['sumadults']?> người lớn
                        </label>
                        <label>
                            <?php echo $bookingdetail['sumchilds']?> trẻ em
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="color-dark-2"><strong>Nội dung thanh toán</strong></h4>
                <table class="table booking-table">
                    <tbody>
                    <tr>
                        <td>
                            <?php echo $bookingdetail['sumroom']?> phòng
                        </td>
                        <td class="text-right color-blue">
                            <?php echo $this->string->numberFormate($bookingdetail['total'])?> VNĐ
                        </td>
                    </tr>
                    <tr>
                        <td>10% VAT</td>
                        <td class="text-right color-blue">
                            <?php echo $this->string->numberFormate($bookingdetail['total']*0.1)?> VNĐ
                        </td>
                    </tr>
                    <tr>
                        <td>5% phí phục vụ</td>
                        <td class="text-right color-blue">
                            <?php echo $this->string->numberFormate($bookingdetail['total']*0.05)?> VNĐ
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>
                            Tổng thanh toán
                            <h6 class="card-subtitle mb-2 mt-2 text-muted">Cho
                                <?php echo $bookingdetail['sumadults']?> người lớn
                            </h6>
                        </td>
                        <td class="text-right color-blue">
                            <?php echo $this->
                            string->numberFormate($bookingdetail['total']+$bookingdetail['total']*0.15)?>
                            VNĐ
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <form id="frmCustomerBooking">
            <input type="hidden" name="bookingtotal" value="<?php echo $bookingdetail['total']?>">
            <input type="hidden" name="vatamount" value="<?php echo $bookingdetail['total']*0.1?>">
            <input type="hidden" name="servicechargeamount" value="<?php echo $bookingdetail['total']*0.05?>">
            <input type="hidden" name="total"
                   value="<?php echo $bookingdetail['total']+$bookingdetail['total']*0.15?>">
            <div class="card">
                <div class="card-body">
                    <h4 class="color-dark-2 mb-3"><strong>Thông tin cá nhân của bạn</strong></h4>
                    <div class="form-group">
                        <label for="customername">Họ tên(*)</label>
                        <input type="text" class="form-control" id="customername" name="customername"
                               placeholder="Họ tên" required autocomplete="name"
                               value="<?php echo isset($this->member['fullname'])?$this->member['fullname']:''?>">
                        <div class="invalid-feedback customername"></div>
                    </div>
                    <div class="form-group">
                        <label for="customeremail">Email(*)</label>
                        <input type="email" class="form-control" id="customeremail" name="customeremail"
                               placeholder="Email"
                               value="<?php echo isset($this->member['email'])?$this->member['email']:''?>">
                        <div class="invalid-feedback customeremail"></div>
                    </div>
                    <div class="form-group">
                        <label for="custormerphone">Điện thoại(*)</label>
                        <input type="tel" class="form-control" id="custormerphone" name="custormerphone"
                               placeholder="Điện thoại"
                               value="<?php echo isset($this->member['phone'])?$this->member['phone']:''?>">
                        <div class="invalid-feedback custormerphone"></div>
                    </div>
                    <div class="form-group">
                        <label for="customeraddress">Địa chỉ</label>
                        <input type="text" class="form-control" id="customeraddress" name="customeraddress"
                               autocomplete="shipping street-address"
                               value="<?php echo isset($this->member['address'])?$this->member['address']:''?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Thành phố/Tỉnh</label>
                            <select class="form-control province" name="province" id="province"
                                    data-live-search="true"></select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputState">Quận/Huyện</label>
                            <select class="form-control district" name="district" id="district"></select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputWard">Phường/Xã</label>
                            <select class="form-control ward" name="ward" id="ward"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Bạn đặt phòng cho ai?</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios"
                                   id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Cho chính mình
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios"
                                   id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Đặt giùm người khác
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <?php foreach($bookingdetail['bookingdetail'] as $key => $item){ ?>
            <?php $room = $item['rooninfor']?>
            <div class="card">
                <div class="card-body">
                    <h3>
                        <?php echo $room['roomname']?>
                    </h3>
                    <ul>
                        <li class="d-inline-flex p-2">Diện tích:
                            <?php echo $room['acreage']?> m<sup>2</sup>
                        </li>
                        <li class="d-inline-flex p-2">Hướng:
                            <?php echo $room['viewname']?>
                        </li>
                        <li class="d-inline-flex p-2">Giường:
                            <?php echo $room['beddetail']?>
                        </li>
                        <li class="d-inline-flex p-2">
                            <?php echo $room['facilitiesview']?>
                        </li>
                    </ul>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputGestName">Họ tên</label>
                            <input type="text" class="form-control" id="inputGestName"
                                   name="gestfullname[<?php echo $room['id']?>]" placeholder="Họ tên">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputGestPhone">Số điện thoại</label>
                            <input type="text" class="form-control" id="inputGestPhone"
                                   name="gestphone[<?php echo $room['id']?>]" placeholder="Điện thoại">
                        </div>
                    </div>

                </div>
            </div>
            <?php } ?>
        </form>

    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn_full" id="btnConfirmBooking">Xác nhận đặt phòng</button>
    </div>
</div>