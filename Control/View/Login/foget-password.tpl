<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-4">
                <div class="panel ">
                    <div class="panel-body">
                        <form id="frmForgotPassword">
                            <div class="form-group">
                                <label class="sr-only">Tên đăng nhập</label>
                                <input type="text" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <a href="#" id="btnResetPassword" class="btn-get-started">Cấp lại mật khẩu</a>
                                <a href="<?php echo $this->request->createLink('login')?>">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="small">Bạn chưa có tài khoản? <a href="<?php echo $this->request->createLink('register')?>">Đăng ký tài khoản tại đây</a></p>
            </div>
        </div>
    </div>
</section>