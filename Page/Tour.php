<?php
require CONTROL . "Service.php";
class Tour extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        //Body
        $condition = "&sitemapid=equal_".$this->data['sitemap']['id'];
        $ctrService = new \Lib\Service($this->api);
        $result = $ctrService->getGetList($condition);
        $services = $result['data'];
        foreach ($services as &$service){
            $service['image'] = IMAGESERVER."root/upload/hotel_service/".$service['id']."/".$service['image'];
        }
        $this->setData('services',$services);
        $this->setTemplate('Tour.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}