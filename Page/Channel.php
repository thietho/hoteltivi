<?php

class Channel extends Page
{
    public function index()
    {
        //Body
        $this->setTemplate('Channel.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}