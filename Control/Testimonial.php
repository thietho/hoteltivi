<?php
namespace Lib;
class Testimonial extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=CMS/Testimonial/getTestimonial&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=CMS/Testimonial/getTestimonials&published=equal_1'.$condition);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }

}