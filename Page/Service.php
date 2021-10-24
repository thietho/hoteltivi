<?php

class Service extends Page
{
    public function index()
    {
        //Body
        $this->setTemplate('Service.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}