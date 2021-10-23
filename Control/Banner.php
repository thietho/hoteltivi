<?php
namespace Lib;
class Banner extends Control
{
    public $banner;
    public function load($id){
        $result = $this->api->get('?route=CMS/Banner/getBanner&id='.$id);
        if($result['statuscode']){
            $this->banner = $result['data'];
        }
    }
    public function renderBanner(){
        $this->setData('id',$this->banner['id']);
        $this->setData('banners',json_decode($this->banner['bannerimages'],true));
        $content = $this->render('Banner/Carousel.tpl');
        return $content;
    }
    public function getBanner($id){
        $this->load($id);
        $banners = json_decode($this->banner['bannerimages'],true);
        foreach ($banners as &$banner){
            $banner['image'] = IMAGESERVER.'root/upload/cms_banner/'.$id.'/'.$banner['image'];
        }
        return $banners;
    }
}