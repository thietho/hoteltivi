<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class Mail extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }


    public function sendMail($data){
        $result = $this->api->postJSON('?route=Common/Mail/Send', $data);
        return $result;
    }

}