<?php

class Tivi extends Page
{
    public function index()
    {
        //Body
        $this->setTemplate('Tivi.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}