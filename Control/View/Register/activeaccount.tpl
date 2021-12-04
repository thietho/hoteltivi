<section class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                <div id="login">
                        <div class="text-center"><img src="<?php echo HTTPSERVER?>img/logo_sticky.png" alt="Image" data-retina="true" ></div>
                        <form id="frmActive">
                        <h3 class="text-center">Kích hoạt tài khoản</h3>
                        <hr>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" id="email" data-cy="email" name="email" type="email" placeholder="Email" value="">
                                 <div class="invalid-feedback confirmpassword"></div>
                            </div>
                            <div class="form-group">
                                <label>Mã kích hoạt</label>
                                <input class="form-control" id="activecode" name="activecode" type="text" placeholder="Mã kích hoạt" value="">
                                <div class="invalid-feedback confirmpassword"></div>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="Mật khẩu" value="">
                                <div class="invalid-feedback confirmpassword"></div>
                            </div>
                            <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <input class="form-control" type="password" id="confirmpassword" name="confirmpassword" placeholder="Xác nhận mật khẩu" value="">
                                <div class="invalid-feedback confirmpassword"></div>
                            </div>
                            <a href="#" class="btn_full" id="btnActive">Kích hoạt tài khoản</a>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>

