<?php

class Tour extends Page
{
    public function index()
    {
        //Body
        $this->setTemplate('Tour.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}