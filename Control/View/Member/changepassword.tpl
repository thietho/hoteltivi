<section class="content-current member-detail">
<form id="frmChangePassword" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <h4>Thay đổi mật khẩu</h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="curentpassword">Mật khẩu hiện tại(*)</label>
                <input type="password" class="form-control" id="curentpassword" name="curentpassword"
                       placeholder="Mật khẩu hiện tại">
                <div class="invalid-feedback curentpassword"></div>
            </div>
            <div class="form-group">
                <label for="newpassword">Mật khẩu mới(*)</label>
                <input type="password" class="form-control" id="newpassword" name="newpassword"
                       placeholder="Mật khẩu mới">
                <div class="invalid-feedback newpassword"></div>
            </div>
            <div class="form-group">
                <label for="newpassword">Xác nhận mật khẩu mới(*)</label>
                <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword"
                       placeholder="Xác nhận mật khẩu mới">
                <div class="invalid-feedback confirmnewpassword"></div>
            </div>
        </div>
        
    </div>
    <!-- End row -->
    <button type="submit" class="btn_1 green" id="btnChangePassword">Thay đổi mật khẩu</button>
</form>
</section>