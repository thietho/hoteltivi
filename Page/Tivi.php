<?php

class Tivi extends Page
{
    public function index()
    {
        //Header
        $this->sitemap->loadTree(0);
        //$mainmenu = $this->sitemap->renderMenu(14);

        //Body
        $this->setData('content',$this->section->loadViewPage('Tivi/'.$this->data['sitemap']['sitemapid'].'.tpl'));
        $this->setTemplate('Tivi.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}