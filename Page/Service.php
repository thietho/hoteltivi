<?php

class Service extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        //Body
        $this->setTemplate('Service.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}