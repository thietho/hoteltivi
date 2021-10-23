<?php

class Login extends Page
{
    public function index(){
        //Header
        $this->sitemap->loadTree(0);
        $mainmenu = $this->sitemap->renderMenu(14);
        
        $this->setData('header',$this->section->loadView('Common/header.tpl',array('mainmenu'=>$mainmenu)));
        //Footer
        $this->setData('footer',$this->section->loadView('Common/footer.tpl'));

        //Body
        $banner = $this->sitemap->renderBanner($this->data['sitemap']);
        $this->setData('banner',$banner);

        $this->setData('content',$this->section->loadView('Login/'.$this->data['sitemap']['sitemapid'].'.tpl'));
        $this->setTemplate('Login.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}