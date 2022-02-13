<div class="site-wrapper">
    <!--<video style="position: absolute" src="http://coresystem.cntech.com.vn/FileServer/file/upload/cms_sitemap/64/bamboo.mp4" width="1280" height="720" autoplay muted></video>-->
    <div class="site-wrapper-inner">
        <div class="cover-container">
            <div class="text-right home-top clearfix">
                <div class="inner">
                    <div class="weather">
                        <div class="temp">
                            <img src="<?php echo IMAGES?>weather/02d.png" id="weather-icon"/>
                            <span id="weather-current"></span>
                            <p class="des">have a nice day</p>
                        </div>
                        <div class="time">
                            <span id="shorttime">09:30</span>
                            <p class="date" id="fulltime">15 oCT 2021</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cover welcome-wrapper">
                <div class="welcome">
                    <div class="logo">
                        <img src="<?php echo IMAGES?>home-logo.png"/>
                    </div>
                    <div class="content">
                        <h1 class="title">Xin chào</h1>
                        <p class="name">Mr. Leo</p>
                        <div style="padding-top: 10px">
                            <p class="des">Số phòng của bạn là <span id="roomnumber">198</span></p>
                            <p class="des">Chúng tôi hy vọng bạn sẽ tận hưởng kỳ nghỉ của bạn tại Sunset Santo của chúng tôi</p>
                            <div id="log"></div>
                        </div>

                    </div>
                </div>
                <div class="language text-center">
                    <table style="margin: 0 auto">
                        <tr id="langRegion">
                            <td>
                                <img src="<?php echo IMAGES?>vi-flag.png"/><br>
                                <a href="#">Việt Nam</a>
                            </td>
                            <td>
                                <img src="<?php echo IMAGES?>en-flag-dis.png"/><br>
                                <a href="#">English</a>
                            </td>
                        </tr>
                    </table>


                </div>
            </div>

        </div>
    </div>
</div>

<section class="home-menu">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 home-static curent">
                <div class="about-us">
                    <div class="item-wrapper">
                        <img src="<?php echo IMAGES?>logo.png"/>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 list-item">
                <?php for($i=1; $i < count($sitemaps); $i++){ ?>
                <div class="list-item-sub">
                    <a href="#">
                        <div class="item-wrapper">
                            <div class="img-wrapper"><img src="<?php echo IMAGESERVER?>root/upload/cms_sitemap/<?php echo $sitemaps[$i]['id']?>/<?php echo $sitemaps[$i]['image']?>"/></div>
                            <h4 class="title"><?php echo $sitemaps[$i]['sitemapname']?></h4>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<div style="display: none" id="videointro"><?php echo $videointro['video']?></div>