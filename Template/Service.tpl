<section class="main-wrapper room-service">
    <div class="lang-icon"><img src="img/lang-vi.png"/></div>
    <div class="container-fluid">
        <?php echo $header?>

        <div class="row">
            <div class="col-lg-12 px-0 main-content">
                <div class="content-wrapper">
                    <div class="room-service-carousel">
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>TRANSFER</p>
                                <img src="img/service-transfer.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>CALL TAXI</p>
                                <img src="img/service-transfer-2.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>ROOM CLEAN</p>
                                <img src="img/service-transfer-3.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>LAUNDRY</p>
                                <img src="img/service-transfer-4.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>wake up call</p>
                                <img src="img/service-transfer-5.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>food order</p>
                                <img src="img/service-transfer-6.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>VIDEO INFO</p>
                                <img src="img/service-transfer.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>VIDEO INFO</p>
                                <img src="img/service-transfer.jpg">
                            </a>
                        </div>
                        <div class="item col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#room-service-popup">
                                <p>VIDEO INFO</p>
                                <img src="img/service-transfer.jpg">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 px-0 main-content">
                <div class="menu-bottom">
                    <div class="row">
                        <div class="col-lg-4 left pr-0">
                            <div class="text-wrapper choise">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>press <span class="icon"><img src="img/ok-icon.png"/></span></p>
                                            <p>to choise</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>the <span>service</span></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 left">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>press <span class="icon"><img src="img/level-up.png"/></span></p>
                                            <p>to level up</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>level <span>back</span></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 right">
                            <div class="text-wrapper">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-lg-6 press-left text-left">
                                            <p>press <span>smart</span></p>
                                            <p>to close page</p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p>the <span>menu</span></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="room-service-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">call <span>taxi</span></h5>
                </div>
                <div class="modal-body">
                    <p>Please help us book taxi:</p>
                    <form>
                        <div class="form-row">
                            <div class="form-group form-inline col-lg-12">
                                <label class="title" for="">Number of seats</label>
                                <input type="number" class="form-control number-seat qlt" id="" placeholder="">
                                <label class="title" for="">Qlt</label>
                                <input type="number" class="form-control number-seat qlt" id="" placeholder="">
                                <label class="title" for="">At time</label>
                                <input type="datetime-local" class="form-control datetime at-time" id="" placeholder="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ok">OK</button>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
</section>