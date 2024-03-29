<?php

class FoodOrder extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        //Body
        $this->setData('cart',$this->section->loadViewPage('Cart/cart.tpl'));
        $childs = $this->sitemap->getChilds(55);

        foreach ($childs as &$sitemap){
            $sitemap['image'] = IMAGESERVER."fixsize-586x310/upload/cms_sitemap/".$sitemap['id']."/".$sitemap['image'];
        }
        $this->setData('sitemaps',$childs);
        $this->setTemplate('FoodOrder.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}