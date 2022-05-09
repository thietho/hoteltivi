<div class="col-lg-12 main-sidebar">
    <table width="100%" class="table">
        <thead>
        <tr class="head">
            <th class="sidebar food-no" scope="col">No.</th>
            <th class="sidebar food-name" scope="col"><?php echo $this->labels['lbl_foodname']?></th>
            <th class="sidebar food-qlt" scope="col"><?php echo $this->labels['lbl_qtl']?></th>
            <th class="sidebar food-price" scope="col"><?php echo $this->labels['lbl_price']?></th>
        </tr>
        </thead>
        <tbody id="listfoodorder"></tbody>
    </table>
    <div class="row">
        <div class="col-lg-6">
            <p class="total"><?php echo $this->labels['lbl_total']?>: <span></span></p>
        </div>
        <div class="col-lg-6">
            <div class="basket-wrapper" id="btnBasket" index="0">
                <div id="countitem"></div>
                <img class="basket-icon" src="<?php echo HTTPSERVER?>img/cart-icon.png"/>
            </div>
        </div>
    </div>
</div>