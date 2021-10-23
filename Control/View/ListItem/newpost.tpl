<div class="sidebar">
    <h4 class="sidebar-title">Bài viết mới</h4>
    <div class="sidebar-item recent-posts">
        <?php foreach($newpost as $content){ ?>
        <div class="post-item clearfix">
            <img src="<?php echo $content['image']?>" alt="<?php echo $content['title']?>">
            <h4><a href="blog-single.html"><?php echo $content['title']?></a></h4>
            <time><?php echo $content['createdat']?></time>
        </div>
        <?php } ?>

    </div><!-- End sidebar recent posts-->

</div>