<?php

require CONTROL."Banner.php";
require CONTROL."Product.php";
require CONTROL."Testimonial.php";
class HomePage extends Page
{
    public function index()
    {
        $sitemaps = $this->sitemap->getChilds(50);
        $listvideo = $this->sitemap->getChilds(51);
        foreach ($listvideo as &$sitemap){
            $sitemap['image'] = IMAGESERVER."fixsize-587x251/upload/cms_sitemap/".$sitemap['id']."/".$sitemap['image'];
            $sitemap['video'] = FILESERVER."upload/cms_sitemap/".$sitemap['id']."/".$sitemap['video'];
        }
        $random = rand(0,count($listvideo)-1);
        $this->setData('videointro',$listvideo[$random]);
        $this->setData('sitemaps',$sitemaps);
        $this->setTemplate('HomePage.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}