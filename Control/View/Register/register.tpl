<section class="register">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 center no-padding offset-lg-2">
                <form id="frmRegister" class="form-transparent-grey">
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Bạn điền hãy điền những thông tin bên dưới để tạo tài khoản mới</p>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="sr-only">Họ tên</label>
                            <input type="text" name="fullname" placeholder="Họ tên" class="form-control">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">Email</label>
                            <input type="text" name="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">Điện thoại</label>
                            <input type="text" name="phone" placeholder="Điện thoại" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="sr-only">Địa chỉ</label>
                            <input type="text" name="address" placeholder="Địa chỉ" class="form-control">
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
                        <div class="col-lg-12 form-group">
                            <a href="#" id="btnRegister" class="btn-get-started btn-dang-ky">Đăng ký</a>
                            <a href="<?php echo $this->request->createLink()?>" class="btn-get-started btn-huy">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>