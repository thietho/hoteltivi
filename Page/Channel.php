<?php

class Channel extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        //Body
        $this->setTemplate('Channel.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}