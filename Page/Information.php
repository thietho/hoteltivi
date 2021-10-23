<?php

class Information extends Page
{
    public function index()
    {
        //Header
        $this->sitemap->loadTree(0);
        $mainmenu = $this->sitemap->renderMenu(14);

        $this->setData('header', $this->section->loadView('Common/header.tpl', array('mainmenu' => $mainmenu)));
        //Footer
        $this->setData('footer', $this->section->loadView('Common/footer.tpl'));

        //Body

        $this->setTemplate('Information.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}