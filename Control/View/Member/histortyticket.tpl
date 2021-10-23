<div class="card">
    <div class="card-body">

        <div class="member-table">
    
            <div class="row header">
              <div class="cell">
                Mã Booking
              </div>
              <div class="cell">
                Ngày dặt
              </div>
              <div class="cell">
                Ngày vào cổng
              </div>
              <div class="cell">
                Trình trạng
              </div>
            </div>
            <?php foreach($data['bookings'] as $booking){ ?>
            <div class="row">
              <div class="cell">
                <a href="<?php echo $this->request->createLink('ticketbookingdetail',$booking['id'].'-'.$booking['bookingid'])?>"><?php echo $booking['bookingid']?></a>
              </div>
              <div class="cell">
                <?php echo $this->date->formatMySQLDate($booking['bookingdate'])?>
              </div>
              <div class="cell">
                <?php echo $this->date->formatMySQLDate($booking['checkin'])?>
              </div>
              <div class="cell text-danger">
                <?php echo $this->language->data['roombooking'][$booking['ticketstatus']]?>
              </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>


