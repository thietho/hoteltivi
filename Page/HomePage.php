<?php

require CONTROL."Banner.php";
require CONTROL."Product.php";
require CONTROL."Testimonial.php";
class HomePage extends Page
{
    public function index()
    {
        //Header
        $this->sitemap->loadTree(14);
        $mainmenu = $this->sitemap->renderMenu(14);
        $this->setData('header', $this->section->loadView('Common/header.tpl', array('mainmenu' => $mainmenu)));
        //Footer
        $this->setData('footer', $this->section->loadView('Common/footer.tpl'));
        //Body
        $bannerctr = new \Lib\Banner($this->api);
        $homebanner = $bannerctr->getBanner(1);
        $this->setData('banner',$this->section->loadViewPage('Home/banner.tpl',['banners' => $homebanner]));
        //Thực đơn
        $arr_sitmapid = array(50,51,52,53);
        $datasitemap = array();
        foreach ($arr_sitmapid as $id){
            $datasitemap[] = $this->sitemap->getItem($id);
        }
        $ctlPrduct = new \Lib\Product($this->api);
        foreach ($datasitemap as &$sitemap){
            $result = $ctlPrduct->getProducts("&paging=true&limit=8&page=1&sitemapids=containsin_".$sitemap['id']);
            $products = $result['data'];
            foreach ($products as &$product){
                $product = $ctlPrduct->formate($product,$sitemap['sitemapid']);
            }
            $sitemap['products'] = $products;
        }
        $this->setData('menu',$this->section->loadViewPage('Home/menu.tpl',['sitemaps' => $datasitemap]));
        $result = $ctlPrduct->getProducts("&paging=true&limit=8&page=1&type=containsin_bestsaler");
        $products = $result['data'];
        foreach ($products as &$product){

            $product = $ctlPrduct->formate($product);
        }
        $this->setData('bestsale',$this->section->loadViewPage('Home/bestsale.tpl',['products'=>$products]));

        $newpost = $this->loadNewPost();
        $this->setData('newpost',$this->section->loadViewPage('Home/newpost.tpl',['newsposts'=>$newpost]));
        $this->setTemplate('HomePage.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
    private function loadNewPost(){
        $result = $this->content->getGetList('&sortcol=createdat&sorttype=desc&paging=true&limit=6&page=1');
        $newpost = array();
        if($result['statuscode']){
            $news = $result['data'];
            foreach ($news as $content){
                $item['title'] = $content['title'];
                $item['summary'] = $this->string->getTextLength($content['summary'],0,15);
                $item['image'] = IMAGESERVER."fixsize-370x265/upload/cms_content/".$content['id']."/".$content['image'];
                $item['createdat'] = $this->date->formatMySQLDate($content['createdat']);
                $item['link'] = $this->request->createLink('News',$content['id'].'-'.$this->string->clean($this->string->utf8convert($content['title'])));
                $newpost[] = $item;
            }
        }
        return $newpost;
    }
}