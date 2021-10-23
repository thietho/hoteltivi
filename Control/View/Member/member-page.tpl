<section id="member">
    <div class="container">
        <div class="tabs tabs-vertical">
            <div class="row">
                <div class="d-flex align-items-start">
                    <div class="col-lg-4 nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">Thông tin cá nhân
                        </button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-profile" type="button" role="tab"
                                aria-controls="v-pills-profile" aria-selected="false">Lịch sử mua hàng
                        </button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-messages" type="button" role="tab"
                                aria-controls="v-pills-messages" aria-selected="false">Đổi mật khẩu
                        </button>
                    </div>
                    <div class="col-lg-8 tab-content" id="v-pills-tabContent">

                        <div class="row tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Thông tin cá nhân</h4>
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
                            </div>
                            <div class="col-lg-12 form-group">
                                <a href="<?php echo $this->request->createLink('information')?>" class="btn-get-started btn-huy">Chỉnh sửa thông tin</a>
                                <a href="#" onclick="common.logout()" class="btn-get-started btn-huy">Đăng xuất</a>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                             aria-labelledby="v-pills-profile-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Ngày đặt hàng</th>
                                    <th scope="col">Tình trạng đơn hàng</th>
                                </tr>
                                </thead>
                                <tbody id="orderhistory">
                                <tr>
                                    <th scope="row">1</th>
                                    <td>DH4589</td>
                                    <td>11/10/2021</td>
                                    <td>Đang giao</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>DH4549</td>
                                    <td>11/10/2021</td>
                                    <td>Hoàn thành</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>DH2567</td>
                                    <td>15/10/2021</td>
                                    <td>Đang chuẩn bị</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                             aria-labelledby="v-pills-messages-tab">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="sr-only">Password cũ</label>
                                    <input type="password" value="" placeholder="Nhập password cũ" class="form-control">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="sr-only">Password mới</label>
                                    <input type="password" value="" placeholder="Nhập password mới"
                                           class="form-control">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <a href="" class="btn-get-started">Đổi mật khẩu</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>