<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo IMAGES?>favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    <?php echo $this->title?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="<?php echo $this->title?>">
    <meta name="keywords" content="<?php echo $this->keywords?>">
    <meta name="description" content="<?php echo $this->description?>">
    <meta name="author" content="<?php echo $this->author?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $this->url?>">
    <meta property="og:title" content="<?php echo $this->title?>">
    <meta property="og:description" content="<?php echo $this->description?>">
    <meta property="og:image" content="<?php echo $this->image?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo $this->url?>">
    <meta property="twitter:title" content="<?php echo $this->title?>">
    <meta property="twitter:description" content="<?php echo $this->description?>">
    <meta property="twitter:image" content="<?php echo $this->image?>">

    <link href="<?php echo CSS?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CSS?>main.css" rel="stylesheet">
    <link href="<?php echo CSS?>hlstyle.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTPSERVER?>slick/slick.css"/>
    <link href="<?php echo HTTPSERVER?>css/toastr.min.css" id="theme" rel="stylesheet">
</head>

<body id="top">
<?php echo $this->body?>
<script type="text/javascript">
    var HTTPSERVER = "<?php echo HTTPSERVER?>";
    var sitemapid = '<?php echo $this->request->get("sitemapid")?>';
    var id = '<?php echo $this->request->get("id")?>';
    try {
        request = JSON.parse('<?php echo json_encode($this->request->getDataGet())?>');
        console.log(request);
    } catch (e) {
        console.log(e);
    }
    try {
        dataLang = JSON.parse('<?php echo json_encode($this->labels)?>');
        console.log(dataLang);
    } catch (e) {
        console.log(e);
    }
</script>
<script type="text/javascript" src="<?php echo JS?>jquery-3.6.0.js"></script>

<script src="<?php echo JS?>bootstrap.bundle.min.js"></script>
<script src="<?php echo JS?>main.js"></script>
<script src="<?php echo JS?>hcap.js"></script>
<script src="<?php echo HTTPSERVER?>js/common.js"></script>
<script src="<?php echo HTTPSERVER?>js/foodorder.js"></script>

<script type="text/javascript" src="<?php echo HTTPSERVER?>slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo HTTPSERVER?>js/main.js"></script>
<script src="<?php echo HTTPSERVER?>js/toastr.min.js"></script>
<!-- Basket -->
<div class="modal fade" id="basket-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title food-name"><img src="<?php echo HTTPSERVER?>img/cart-icon.png"/>
                    <span class="cart-number">7</span> <?php echo $this->labels['lbl_cart']?></h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="col-lg-12">
                            <table width="100%" class="table">
                                <thead>
                                <tr class="head">
                                    <th class="food-no" scope="col">No.</th>
                                    <th class="food-name" scope="col"><?php echo $this->labels['lbl_foodname']?></th>
                                    <th class="food-qlt" scope="col"><?php echo $this->labels['lbl_qtl']?></th>
                                    <th class="food-price" scope="col"><?php echo $this->labels['lbl_price']?></th>
                                </tr>
                                </thead>
                                <tbody id="listfoodorderpopup"></tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="col-lg-7">
                            <h5 class="modal-title food-name food-total"><?php echo $this->labels['lbl_total']?></h5>
                            <p class="food-vat"><?php echo $this->labels['lbl_warring_service_vat']?></p>
                        </div>
                        <div class="col-lg-5">
                            <p class="food-price-total">2.450.000 VNĐ</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-lg-4 px-0">
                    <h5 class="modal-title food-name  mr-2" index="0" action="back"><img src="<?php echo HTTPSERVER?>img/level-back-icon.png"/> <?php echo $this->labels['lbl_return']?></h5>
                </div>
                <div class="col-lg-4 px-0">
                    <h5 class="modal-title food-name" index="1" action="emptybasket"><img src="<?php echo HTTPSERVER?>img/empty-basket-icon.png"/> <?php echo $this->labels['lbl_cancelorder']?></h5>
                </div>
                <div class="col-lg-4 px-0">
                    <h5 class="modal-title food-name ml-2" action="ordernow" index="2"><img src="<?php echo HTTPSERVER?>img/order-now-icon.png"/> <?php echo $this->labels['lbl_confirm']?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="videopopup">
    <video id="videoplayer" muted onended="TiviVideoPlayer.closePopup()"></video>
    <button type="button" id="btnSkip"><?php echo $this->labels['lbl_press']?> Ok to Skip</button>
</div>
<!-- Modal -->
<div class="modal fade" id="room-service-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $this->request->translate('lbl_call_for_service')?></span></h5>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ok">OK</button>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">CANCEL</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php echo $this->loadPageResoure($sitemap['sitemaptype'].'.js')?>
</script>
</body>
</html>