<style>
    .upload-drop-zone {
        height: 200px;
        border-width: 2px;
        margin-bottom: 20px;
    }

    .upload-drop-zone {
        color: #ccc;
        border-style: dashed;
        border-color: #ccc;
        line-height: 200px;
        text-align: center
    }
    .upload-drop-zone.drop {
        color: #222;
        border-color: #222;
    }
    .upload_1 {
        margin:20px 0;
    }

</style>
<section class="register">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 center no-padding offset-lg-2">
                <form id="frmMemberInformation" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-lg-12 form-group">
                            <label class="sr-only">Họ tên</label>
                            <input type="text" name="fullname" placeholder="Họ tên" class="form-control" value="<?php echo $this->member['fullname']?>">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">Email</label>
                            <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $this->member['email']?>">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">Điện thoại</label>
                            <input type="text" name="phone" placeholder="Điện thoại" class="form-control" value="<?php echo $this->member['phone']?>">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="sr-only">Địa chỉ</label>
                            <input type="text" name="address" placeholder="Địa chỉ" class="form-control" value="<?php echo $this->member['address']?>">
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="sr-only">Thành phố/Tỉnh</label>
                                    <select class="form-control province" name="province" id="province"
                                            data-live-search="true">
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="sr-only">Quận/Huyện</label>
                                    <select class="form-control district" name="district" id="district">
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="sr-only">Phường/Xã</label>
                                    <select class="form-control ward" name="ward" id="ward">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 form-group">
                        <a id="btnUpdateInformation" class="btn-get-started btn-huy">Chỉnh sửa thông tin</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>