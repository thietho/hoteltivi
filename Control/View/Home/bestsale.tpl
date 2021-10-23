<section class="ban-chay">
    <div class="section-bg">
        <div class="section-bg-overlay"></div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="section-title"><b></b><span>Món ăn bán chạy</span><b></b></h3>
                <p>Chúng tôi gợi ý cho bạn một số món ăn đã trở thành thương hiệu của chúng tôi và có doanh thu bán chạy nhất tháng 4/2019</p>
            </div>
        </div>
        <?php echo $this->loadViewPage('Product/product_list.tpl',['products' => $products]);?>

    </div>
</section>