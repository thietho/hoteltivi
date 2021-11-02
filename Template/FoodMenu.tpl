<section class="main-wrapper food-order">
    <div class="lang-icon"><img src="img/lang-vi.png"/></div>
    <div class="container-fluid">
        <?php echo $header?>

        <div class="row">
            <div class="col-lg-4 px-0">
                <div class="col-lg-12 main-sidebar">
                    <table width="100%" class="table">
                        <thead>
                        <tr class="head">
                            <th class="sidebar food-no" scope="col">No.</th>
                            <th class="sidebar food-name" scope="col">Name</th>
                            <th class="sidebar food-qlt" scope="col">Qlt</th>
                            <th class="sidebar food-price" scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="sidebar food-no"><span>1</span></td>
                            <td class="sidebar food-name"><span>Bánh kem</span></td>
                            <td class="sidebar food-qlt"><span>1</span></td>
                            <td class="sidebar food-price"><span>500.000 VNĐ</span></td>
                        </tr>
                        <tr>
                            <td class="sidebar food-no"><span>1</span></td>
                            <td class="sidebar food-name"><span>Bánh kem</span></td>
                            <td class="sidebar food-qlt"><span>1</span></td>
                            <td class="sidebar food-price"><span>500.000 VNĐ</span></td>
                        </tr>
                        <tr>
                            <td class="sidebar food-no"><span>1</span></td>
                            <td class="sidebar food-name"><span>Bánh kem</span></td>
                            <td class="sidebar food-qlt"><span>1</span></td>
                            <td class="sidebar food-price"><span>500.000 VNĐ</span></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="total">Total: 100.000 VNĐ</p>
                        </div>
                        <div class="col-lg-6">
                            <a href="#" data-toggle="modal" data-target="#basket-popup">
                                <div class="basket-wrapper">
                                    <img class="basket-icon" src="img/basket-icon.png"/>
                                    <p class="basket-text">basket</p>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-8 main-content">
                <div class="content-wrapper">
                    <div class="food-menu-carousel">
                        <?php foreach($foods as $key => $food){ ?>
                        <div class="item col-lg-12" index="<?php echo $key?>">
                            <p><?php echo $food['foodname']?></p>
                            <img src="<?php echo $food['image']?>">
                        </div>
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
    <div class="modal fade" id="food-order-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title food-name">Mỳ xào giòn</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <table width="100%" class="table">
                                    <tbody>
                                    <tr>
                                        <td class=""></td>
                                        <td class="food-qlt">
                                            <div class="form-group">
                                                <input id="after" class="form-control" type="number" value="1" min="1"
                                                       max="10"/>
                                            </div>
                                        </td>
                                        <td class="food-price"><span>350.000 VNĐ</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <p class="food-des">Mô tả món ăn...</p>
                            </div>
                            <div class="form-group form-inline col-lg-12">
                                <label class="note" for="">Ghi chú</label>
                                <textarea class="form-control" rows="5"></textarea>
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
    <!-- Basket -->
    <div class="modal fade" id="basket-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title food-name"><img src="img/cart-icon.png"/> <span class="cart-number">7</span>Shopping
                        <span>Basket</span></h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <table width="100%" class="table">
                                    <thead>
                                    <tr class="head">
                                        <th class="food-no" scope="col">No.</th>
                                        <th class="food-name" scope="col">Name</th>
                                        <th class="food-qlt" scope="col">Qlt</th>
                                        <th class="food-price" scope="col">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="food-no">1</td>
                                        <td class="food-name">Mỳ xào giòn</td>
                                        <td class="food-qlt">
                                            <div class="form-group">
                                                <input class="form-control basket" type="number" value="1" min="1"
                                                       max="10"/>
                                            </div>
                                        </td>
                                        <td class="food-price"><span>350.000 VNĐ</span></td>
                                    </tr>
                                    <tr>
                                        <td class="food-no">1</td>
                                        <td class="food-name">Mỳ xào giòn</td>
                                        <td class="food-qlt">
                                            <div class="form-group">
                                                <input class="form-control basket" type="number" value="1" min="1"
                                                       max="10"/>
                                            </div>
                                        </td>
                                        <td class="food-price"><span>350.000 VNĐ</span></td>
                                    </tr>
                                    <tr>
                                        <td class="food-no">1</td>
                                        <td class="food-name">Mỳ xào giòn</td>
                                        <td class="food-qlt">
                                            <div class="form-group">
                                                <input class="form-control basket" type="number" value="1" min="1"
                                                       max="10"/>
                                            </div>
                                        </td>
                                        <td class="food-price"><span>350.000 VNĐ</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="col-lg-7">
                                <h5 class="modal-title food-name food-total">Shopping <span>Basket</span></h5>
                                <p class="food-vat">Prices are subject to 10% service charge and 10% VAT</p>
                            </div>
                            <div class="col-lg-5">
                                <p class="food-price-total">2.450.000 VNĐ</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-4 px-0">
                        <h5 class="modal-title food-name  mr-2"><img src="img/level-back-icon.png"/> level
                            <span>back</span></h5>
                    </div>
                    <div class="col-lg-4 px-0">
                        <h5 class="modal-title food-name"><img src="img/empty-basket-icon.png"/> empty
                            <span>basket</span></h5>
                    </div>
                    <div class="col-lg-4 px-0">
                        <h5 class="modal-title food-name ml-2"><img src="img/order-now-icon.png"/> order
                            <span>now</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>