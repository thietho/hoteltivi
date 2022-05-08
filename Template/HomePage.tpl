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
                        <h1 class="title"><?php echo $this->labels['lbl_hello']?></h1>
                        <p class="name"><?php echo $this->labels['lbl_customers']?></p>
                        <div style="padding-top: 10px">
                            <p class="des"><?php echo $this->labels['lbl_your_room_number_is']?> <span id="roomnumber"></span></p>
                            <p class="des"><?php echo $this->labels['lbl_wellcom']?></p>
                            <!--<div id="log"></div>-->
                        </div>

                    </div>
                </div>
                <div class="language text-center">
                    <table style="margin: 0 auto">
                        <tr id="langRegion">
                            <td>
                                <?php if($this->request->getLang() == 'vn'){ ?>
                                <img src="<?php echo IMAGES?>vi-flag.png"/><br>
                                <?php }else{ ?>
                                <img src="<?php echo IMAGES?>vi-flag-dis.png"/><br>
                                <?php } ?>
                                <a href="<?php echo $this->request->createLinkLang('vn')?>">Việt Nam</a>
                            </td>
                            <td>
                                <?php if($this->request->getLang() == 'en'){ ?>
                                <img src="<?php echo IMAGES?>en-flag.png"/><br>
                                <?php }else{ ?>
                                <img src="<?php echo IMAGES?>en-flag-dis.png"/><br>
                                <?php } ?>

                                <a href="<?php echo $this->request->createLinkLang('en')?>">English</a>
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
                    <a href="<?php echo $this->request->createLink($sitemaps[$i]['sitemapid'])?>">
                        <div class="item-wrapper">
                            <div class="img-wrapper"><img src="<?php echo IMAGESERVER?>root/upload/cms_sitemap/<?php echo $sitemaps[$i]['id']?>/<?php echo $sitemaps[$i]['image']?>"/></div>
                            <h4 class="title">
                                <?php if($this->request->getLang() == 'vn'){ ?>
                                <?php echo $sitemaps[$i]['sitemapname']?>
                                <?php }else{ ?>
                                <?php echo $sitemaps[$i]['sitemapname_'.$this->request->getLang()]==''?$sitemaps[$i]['sitemapname']:$sitemaps[$i]['sitemapname_'.$this->request->getLang()]?>
                                <?php } ?>
                            </h4>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<div style="display: none" id="videointro"><?php echo $videointro['video']?></div>