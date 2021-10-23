<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chi tiết đặt vé</h5>
                    <div class="row">
                        <div class="col-12">
                            <h6>Ngày đặt</h6>
                            <label>
                                <?php echo $this->date->formatMySQLDate($data['databooking']['checkdate'])?>
                            </label>
                            <h6 class="card-subtitle mb-2 text-muted">Thời gian mở cửa 8:00 AM - 5:00 PM</h6>
                        </div>
                        
                        <div class="col-6">
                            <h6>Người lớn</h6>
                            <label>
                            <?php echo $this->string->numberFormate($data['dataTicketPrice']['adultprice'])?> VNĐ
                            </label>
                        </div>
                        <div class="col-6">
                            <h6>Trẻ em</h6>
                            <label>
                            <?php echo $this->string->numberFormate($data['dataTicketPrice']['childenprice'])?> VNĐ
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nội dung thanh toán</h5>
                        <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $data['databooking']['tickeadults']?> người lớn
                                </td>
                                <td class="text-right">
                                    <?php echo $this->string->numberFormate($data['databooking']['tickeadults']*$data['dataTicketPrice']['adultprice'])?> VNĐ
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $data['databooking']['ticketchilds']?> trẻ em
                                </td>
                                <td class="text-right">
                                    <?php echo $this->string->numberFormate($data['databooking']['ticketchilds']*$data['dataTicketPrice']['childenprice'])?> VNĐ
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                                <tr>
                                    <td>
                                        Tổng thanh toán
                                        
                                    </td>
                                    <td class="text-right">
                                        <?php $total = $data['databooking']['tickeadults']*$data['dataTicketPrice']['adultprice']+$data['databooking']['ticketchilds']*$data['dataTicketPrice']['childenprice'];?>
                                        <?php echo $this->string->numberFormate($total)?>
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
                <input type="hidden" name="ticketpriceid" value="<?php echo TICKETPRICEIS?>">
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin cá nhân của bạn</h5>
                        <div class="form-group">
                            <label for="inputFullname">Họ tên(*)</label>
                            <h5><?php echo $data['databooking']['customername']?></h5>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email(*)</label>
                            <h5><?php echo $data['databooking']['customeremail']?></h5>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Điện thoại(*)</label>
                            <h5><?php echo $data['databooking']['custormerphone']?></h5>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Địa chỉ</label>
                            <h5>
                                <?php echo $data['databooking']['customeraddress']?>
                                <?php echo isset($data['databooking']['ward'])?$data['databooking']['ward']['core_ward_path']:''?>
                            </h5>
                        </div>
                    </div>
                </div>
               
            </form>
        </div>

    </div>
</div>