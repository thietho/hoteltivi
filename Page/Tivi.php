<?php

class Tivi extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        //Body
        $childs = $this->sitemap->getChilds($this->data['sitemap']['id']);
        switch ($this->data['sitemap']['sitemapid']){
            case 'youtube':
                $this->response->rezdirect('https://www.youtube.com/');
                break;
        }
        foreach ($childs as &$sitemap){
            $sitemap['image'] = IMAGESERVER."fixsize-587x251/upload/cms_sitemap/".$sitemap['id']."/".$sitemap['image'];
            $sitemap['video'] = FILESERVER."upload/cms_sitemap/".$sitemap['id']."/".$sitemap['video'];
        }

        $this->setData('sitemaps',$childs);
        $this->setTemplate('Tivi.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}