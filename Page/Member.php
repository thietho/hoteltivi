<?php
require CONTROL . "SaleOrder.php";
class Member extends Page
{
    public function index(){
        //Header
        if(empty($this->member)){
            $this->response->redirect($this->request->createLink());
        }
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

        $this->setData('content',$this->section->loadView('Member/'.$this->data['sitemap']['sitemapid'].'.tpl'));
        $this->setTemplate('Member.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}