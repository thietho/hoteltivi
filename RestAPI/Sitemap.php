<?php
class Sitemap extends Page
{
    public function showBanner(){
        $id = $this->request->get('id');
        $sitemap = $this->sitemap->getItem($id);
        echo $this->sitemap->renderBanner($sitemap);
    }
}