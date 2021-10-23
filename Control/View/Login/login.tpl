<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-4">
                <div class="panel ">
                    <div class="panel-body">
                        <form id="frmLogin">
                            <div class="form-group">
                                <label class="sr-only">Tên đăng nhập</label>
                                <input type="text" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group m-b-5">
                                <label class="sr-only">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group form-inline m-b-10 ">
                                <div class="form-check">
                                    <label>
                                        <input type="checkbox"><small class="m-l-10"> Remember me</small>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" id="btnLogin" class="btn-get-started">Đăng nhập</a>
                                <a href="<?php echo $this->request->createLink('foget-password')?>">Quên mật khẩu</a>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="small">Bạn chưa có tài khoản? <a href="<?php echo $this->request->createLink('register')?>">Đăng ký tài khoản tại đây</a></p>
            </div>
        </div>
    </div>
</section>