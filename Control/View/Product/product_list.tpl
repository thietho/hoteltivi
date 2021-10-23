<div class="row">
    <?php foreach($products as $product){ ?>
    <div class="col-lg-3">
        <figure class="figure san-pham">
            <a href="<?php echo $product['link']?>"><img src="<?php echo $product['image']?>" class="figure-img img-fluid rounded" alt="<?php echo $product['productname']?>"></a>
            <h5 class="title"><?php echo $product['productname']?></h5>
            <div class="price-wrapper">
                <span class="price"><?php $product['price']?></span>
            </div>
            <p><?php echo $product['summary']?></p>
            <a productid="<?php echo $product['id']?>"
               productname="<?php echo $product['productname']?>"
               price="<?php echo $product['price']?>"
               image="<?php echo $product['image']?>"
               class="add-to-cart btn-dat-hang btn-get-started">Đặt Món</a>
        </figure>
    </div>
    <?php } ?>
</div>