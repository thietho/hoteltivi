<?php

class FoodOrder extends Page
{
    public function index()
    {
        //Body
        $this->setTemplate('FoodOrder.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}