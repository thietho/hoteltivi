<section class="main-wrapper food-order">
    <!--<div class="lang-icon"><img src="<?php echo HTTPSERVER?>img/lang-vi.png"/></div>-->
    <div class="container-fluid">
        <?php echo $header?>
        <div class="row">
            <div class="col-lg-4 px-0" id="cart-region">
                <?php echo $cart?>
            </div>
            <div class="col-lg-8 main-content" id="main-region">
                <div class="content-wrapper">
                    <div class="food-menu-carousel">
                        <?php $key = 0;?>
                        <?php foreach($foods as  $food){ ?>
                        <div class="item col-lg-12" index="<?php echo $key?>"
                             foodid="<?php echo $food['id']?>"
                             foodname="<?php echo $food[$this->request->translate('foodname')]!=''?$food[$this->request->translate('foodname')]:$food['foodname']?>"
                             price="<?php echo $food['price']?>"
                        >
                            <div class="food-name">
                                <?php echo $food[$this->request->translate('foodname')]!=''?$food[$this->request->translate('foodname')]:$food['foodname']?>
                                <div class="text-right"><?php echo $this->string->numberFormate($food['price'])?></div>
                            </div>
                            <img src="<?php echo $food['image']?>">
                        </div>
                        <?php $key++;?>
                        <?php } ?>
                        <?php if(count($foods)<=6){ ?>
                        <?php foreach($foods as $food){ ?>
                        <div class="item col-lg-12" index="<?php echo $key?>"
                             foodid="<?php echo $food['id']?>"
                             foodname="<?php echo $food[$this->request->translate('foodname')]!=''?$food[$this->request->translate('foodname')]:$food['foodname']?>"
                             price="<?php echo $food['price']?>"
                        >
                            <div class="food-name">
                                <?php echo $food[$this->request->translate('foodname')]!=''?$food[$this->request->translate('foodname')]:$food['foodname']?>
                                <div class="text-right"><?php echo $this->string->numberFormate($food['price'])?></div>
                            </div>
                            <img src="<?php echo $food['image']?>">
                        </div>
                        <?php $key++;?>
                        <?php } ?>
                        <?php } ?>
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
                                            <p><?php echo $this->labels['lbl_press']?> <span class="icon"><img src="<?php echo HTTPSERVER?>img/ok-icon.png"/></span></p>
                                            <p><?php echo $this->labels['lbl_to_choose']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_service']?></p>
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
                                            <p><?php echo $this->labels['lbl_press']?> <span class="icon"><img src="<?php echo HTTPSERVER?>img/level-up.png"/></span></p>
                                            <p><?php echo $this->labels['lbl_return']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_return']?></p>
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
                                            <p><?php echo $this->labels['lbl_press']?> <span>PORTAL</span></p>
                                            <p><?php echo $this->labels['lbl_return_homepage']?></p>
                                        </div>
                                        <div class="col-lg-6 press-right text-right">
                                            <p><?php echo $this->labels['lbl_homepage']?></p>
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
    <div class="modal fade" id="food-order-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title food-name">M??? x??o gi??n</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <table width="100%" class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-right"><?php echo $this->labels['lbl_quantity']?>: </td>
                                        <td class="food-qlt">
                                            <div class="form-group">
                                                <input id="after" class="form-control quantity" type="number" value="1" min="1"/>
                                                <input type="hidden" id="foodid">
                                                <input type="hidden" id="foodname">
                                                <input type="hidden" id="price">
                                            </div>
                                        </td>
                                        <td class="food-price"><span>350.000 VN??</span></td>
                                    </tr>
                                    </tbody>
                                </table>
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