<?php
namespace Lib;

class Channel extends Control
{
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getItem($id){
        $result = $this->api->get('?route=Customize/Channel/getChannel&id='.$id);
        return $result;
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=Customize/Channel/getChannels'.$condition);
        return $result;
    }
    public function save($data){
        $result = $this->api->post('?route=Customize/Channel/Save', $data);
        return $result;
    }
}