<?php

class Contact extends Page
{
    public function index(){
        $sitemapid = $this->request->get('sitemapid');
        $sitemap = $this->sitemap->getSitemap($sitemapid);
        $this->breadcrumb = $this->sitemap->renderBreadcrumb($sitemap['id']);
        //Set SEO Infor
        $this->setTitle($sitemap['sitemapname']);
        $this->setDescription($sitemap['sitemapname']);
        $this->setKeywords($sitemap['sitemapname']);
        $this->setAuthor('Hồ Lư');
        $this->setImage(IMAGESERVER.'root/upload/cms_sitemap/'.$sitemap['id'].'/'.$sitemap['shareimage']);
        
        //Header
        $this->sitemap->loadTree(0);
        $mainmenu = $this->sitemap->renderMenu(14);
        $this->setData('header',$this->section->loadView('Common/header.tpl',array('mainmenu'=>$mainmenu)));
        //Footer
        $this->setData('footer',$this->section->loadView('Common/footer.tpl'));
        //Body
        $banner = $this->sitemap->renderBanner($sitemap);
        $this->setData('banner',$banner);

        $this->setTemplate('Contact.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}