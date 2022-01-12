<?php

require CONTROL."Banner.php";
require CONTROL."Product.php";
require CONTROL."Testimonial.php";
class HomePage extends Page
{
    public function index()
    {
        $sitemaps = $this->sitemap->getChilds(50);
        $this->setData('sitemaps',$sitemaps);
        $this->setTemplate('HomePage.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}