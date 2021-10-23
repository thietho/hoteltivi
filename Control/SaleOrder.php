<?php
namespace Lib;

class SaleOrder extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=CRM/SaleOrder/getSaleOrder&id='.$id);
        return $result;
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=CRM/SaleOrder/getSaleOrders'.$condition);
        return $result;
    }
    public function save($data){
        $result = $this->api->post('?route=CRM/SaleOrder/Save', $data);
        return $result;
    }
    //SaleOrderProduct
    public function getSaleOrderProduct($id){
        $result = $this->api->get('?route=CRM/SaleOrderProduct/getSaleOrderProduct&id='.$id);
        return $result;
    }
    public function getGetSaleOrderProductList($condition=''){
        $result = $this->api->get('?route=CRM/SaleOrderProduct/getSaleOrderProducts'.$condition);
        return $result;
    }
    public function saveSaleOrderProduct($data){
        $result = $this->api->post('?route=CRM/SaleOrderProduct/Save', $data);
        return $result;
    }

}