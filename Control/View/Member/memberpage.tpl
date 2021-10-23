<div class="col-lg-9">
    <div class="col-md-6">
        <h4>Your profile</h4>
        <ul id="profile_summary">
            <li>Họ tên <span><?php echo $this->member['fullname']?></span>
            </li>
            <li>Email <span><?php echo $this->member['email']?></span>
            </li>
            <li>Điện thoại <span><?php echo $this->member['phone']?></span>
            </li>
            <li>Địa chỉ<span><?php echo $this->member['address']?>
                        <?php echo $this->member['ward']['core_ward_path']?></span>
            </li>
        </ul>
    </div>
    <div class="col-md-6">
        <p>
        <img id="preview" src="<?php echo empty($this->member['avatar'])?'':IMAGESERVER.'autosize-300x300/upload/crm_contact/'.$this->member['id'].'/'.$this->member['avatar']?>">
        </p>
    </div>
</div>