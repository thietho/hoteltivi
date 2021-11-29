<?php
require CONTROL . "Food.php";
class FoodMenu extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        //Body
        $this->setData('cart',$this->section->loadViewPage('Cart/cart.tpl'));
        $ctrFood = new \Lib\Food($this->api);
        $condition = "&sitemapid=containsin_70";
        $result = $ctrFood->getGetList($condition);
        $foods = $result['data'];

        foreach ($foods as &$food){
            $food['image'] = IMAGESERVER."fixsize-313x270/upload/hotel_food/".$food['id']."/".$food['image'];
        }
        $this->setData('foods',$foods);
        $this->setTemplate('FoodMenu.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}