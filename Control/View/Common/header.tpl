<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

        <div class="logo">
            <h1 class="text-light"><a href="index.html">Flattern</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="index.html"><img src="<?php echo HTTPSERVER?>assets/img/LOGO-NHA-HANG.png" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <?php echo $data['mainmenu']?>
                <li class="html header-button-1">
                    <div class="header-button">
                        <a href="tel:0911522166" class="button primary is-medium hotline-btn">
                            <span>Hotline: 0911.522.166</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="gio-hang" href="<?php echo $this->request->createLink('cart')?>">
                        <div class="gio-hang-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.95 35.07" width="25" height="25"><defs><style>.cls-1{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.8px;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M10,10.54V5.35A4.44,4.44,0,0,1,14.47.9h0a4.45,4.45,0,0,1,4.45,4.45v5.19"></path><path class="cls-1" d="M23.47,34.17h-18A4.58,4.58,0,0,1,.91,29.24L2.5,8.78A1.44,1.44,0,0,1,3.94,7.46H25a1.43,1.43,0,0,1,1.43,1.32L28,29.24A4.57,4.57,0,0,1,23.47,34.17Z"></path></g></g></svg></div>
                        <span id="items-in-cart">0</span>
                    </a>
                </li>
                <li>
                    <?php if(empty($this->member)){ ?>
                    <a class="thanh-vien" href="<?php echo $this->request->createLink('login')?>">
                        <div class="thanh-vien-icon"><svg id="icon-smember" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 560 560" width="22"><defs><style>#icon-smember .cls-1{fill:none;stroke:#fff;stroke-width:30px;}</style></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><circle class="cls-1" cx="280" cy="280" r="265"></circle><circle class="cls-1" cx="280" cy="210" r="115"></circle><path class="cls-1" d="M86.82,461.4C124.71,354.71,241.91,298.93,348.6,336.82A205,205,0,0,1,473.18,461.4"></path></g></g></svg></div>
                    </a>
                    <?php }else{ ?>
                    <a class="thanh-vien" href="<?php echo $this->request->createLink('member-page')?>">
                        <div class="thanh-vien-icon"><svg id="icon-smember" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 560 560" width="22"><defs><style>#icon-smember .cls-1{fill:none;stroke:#fff;stroke-width:30px;}</style></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><circle class="cls-1" cx="280" cy="280" r="265"></circle><circle class="cls-1" cx="280" cy="210" r="115"></circle><path class="cls-1" d="M86.82,461.4C124.71,354.71,241.91,298.93,348.6,336.82A205,205,0,0,1,473.18,461.4"></path></g></g></svg></div>
                    </a>
                    <?php }?>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>