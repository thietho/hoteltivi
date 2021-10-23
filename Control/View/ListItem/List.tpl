<?php foreach($this->items as $key => $item){ ?>
<hr class="featurette-divider">
<div class="row featurette">
    <div class="col-md-7 <?php echo $key%2==0?'':'order-md-2';?>">
        <h2 class="featurette-heading"><a href="<?php echo $item['link']?>"><?php echo $item['title']?></a></h2>
        <p class="lead"><?php echo $item['summary']?></p>
    </div>
    <div class="col-md-5 ?php echo $key%2==0?'':'order-md-1';?>">
        <a href="<?php echo $item['link']?>"><img class="featurette-image img-fluid mx-auto" src="<?php echo IMAGESERVER.'autosize-500x500/'.$item['image']?>"
                alt="<?php echo $item['title']?>"></a>
    </div>
</div>
<?php } ?>
