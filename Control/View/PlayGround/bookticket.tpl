<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="box_style_1" style="z-index: 3;">
                <h3 class="inner">Chi tiết đặt vé</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Ngày đặt: </label>
                            <strong><?php echo $data['databooking']['checkdate']?></strong>
                            <p class="card-subtitle mb-2 text-muted">Thời gian mở cửa 8:00 AM - 5:00 PM</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Người lớn</label>
                            <p><strong><?php echo $this->
                                string->numberFormate($data['dataTicketPrice']['adultprice'])?> VNĐ</strong></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Trẻ em</label>
                            <p><strong><?php echo $this->
                                string->numberFormate($data['dataTicketPrice']['childenprice'])?> VNĐ</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box_style_1" style="z-index: 4;">
                <h3 class="inner">Nội dung thanh toán</h3>
                <table class="table table_summary">
                    <tbody>
                    <tr>
                        <td>
                            <?php echo $data['databooking']['tickeadults']?> người lớn
                        </td>
                        <td class="text-right">
                            <strong><?php echo $this->
                                string->numberFormate($data['databooking']['tickeadults']*$data['dataTicketPrice']['adultprice'])?>
                                VNĐ</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $data['databooking']['ticketchilds']?> trẻ em
                        </td>
                        <td class="text-right">
                            <strong><?php echo $this->
                                string->numberFormate($data['databooking']['ticketchilds']*$data['dataTicketPrice']['childenprice'])?>
                                VNĐ</strong>
                        </td>
                    </tr>
                    <tr class="total">
                        <td>
                            Tổng thanh toán
                        </td>
                        <td class="text-right">
                            <strong><?php $total = $data['databooking']['tickeadults']*$data['dataTicketPrice']['adultprice']+$data['databooking']['ticketchilds']*$data['dataTicketPrice']['childenprice'];?>
                                <?php echo $this->string->numberFormate($total)?>
                                VNĐ</strong>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-8">

            <form id="frmCustomerBooking">
                <input type="hidden" name="ticketpriceid" value="<?php echo TICKETPRICEIS?>">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><strong>Thông tin cá nhân của bạn</strong></h4>
                        <div class="form-group">
                            <label for="inputFullname">Họ tên(*)</label>
                            <input type="text" class="form-control" id="inputFullname" name="customername"
                                   placeholder="Họ tên" required autocomplete="name"
                                   value="<?php echo isset($this->member['fullname'])?$this->member['fullname']:''?>">
                            <div class="invalid-feedback customername"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email(*)</label>
                            <input type="email" class="form-control" id="inputEmail" name="customeremail"
                                   placeholder="Email"
                                   value="<?php echo isset($this->member['email'])?$this->member['email']:''?>">
                            <div class="invalid-feedback customeremail"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Điện thoại(*)</label>
                            <input type="tel" class="form-control" id="inputPhone" name="custormerphone"
                                   placeholder="Điện thoại"
                                   value="<?php echo isset($this->member['phone'])?$this->member['phone']:''?>">
                            <div class="invalid-feedback custormerphone"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Địa chỉ</label>
                            <input type="text" class="form-control" id="inputAddress" name="customeraddress"
                                   autocomplete="shipping street-address" placeholder="Địa chỉ"
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
                        <hr>
                        <div class="text-left">
                            <button type="button" class="btn_1" id="btnConfirmBooking">Xác nhận đặt vé</button>
                        </div>
                    </div>

                </div>

            </form>



        </div>

    </div>
</div>