<?php
require CONTROL . "Service.php";
class Group extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));

        $sitemaps = $this->sitemap->getChilds($this->data['sitemap']['id']);
        foreach ($sitemaps as &$sitemap){
            $sitemap['image'] = IMAGESERVER."fixsize-360x180/upload/cms_sitemap/".$sitemap['id']."/".$sitemap['image'];
            $sitemap['video'] = !empty($sitemap['video'])?FILESERVER."upload/cms_sitemap/".$sitemap['id']."/".$sitemap['video']:'';
        }
        $this->setData('sitemaps',$sitemaps);
        //Body
        $this->setTemplate('Group.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}