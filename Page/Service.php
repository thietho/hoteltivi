<?php
require CONTROL . "Service.php";
class Service extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        $condition = "&sitemapid=equal_".$this->data['sitemap']['id'];
        $ctrService = new \Lib\Service($this->api);
        $result = $ctrService->getGetList($condition);
        $services = $result['data'];
        foreach ($services as &$service){
            $service['image'] = IMAGESERVER."root/upload/hotel_service/".$service['id']."/".$service['image'];
        }
        $this->setData('services',$services);
        //Body
        $this->setTemplate('Service.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}