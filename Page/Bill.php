<?php

class Bill extends Page
{
    public function index()
    {
        //Body
        $this->setTemplate('Bill.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}