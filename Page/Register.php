<?php
class Register extends Page
{
    public function index(){
        //Header
        $this->sitemap->loadTree(0);
        $mainmenu = $this->sitemap->renderMenu(14);
        
        $this->setData('header',$this->section->loadView('Common/header.tpl',array('mainmenu'=>$mainmenu)));
        //Footer
        $this->setData('footer',$this->section->loadView('Common/footer.tpl'));

        //Body
        $ctlOptionSet = new \Lib\OptionSet($this->api);
        $data = $ctlOptionSet->getItem(12);
        $dataTitle = json_decode($data['optionsetvalue'],true);
        $this->setData('dataTitle',$dataTitle);
        $banner = $this->sitemap->renderBanner($this->data['sitemap']);
        $this->setData('banner',$banner);

        $this->setData('content',$this->section->loadView('Register/'.$this->data['sitemap']['sitemapid'].'.tpl',array(
            'sitemap' => $this->data['sitemap'],
            'dataTitle' => $dataTitle
        )));
        $this->setTemplate('Register.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}