<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class Content extends Control
{

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function getContent($id){
        $result = $this->api->get('?route=CMS/Content/getContent&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getContentsbySitemap($id,$condition = ''){
        $result = $this->api->get('?route=CMS/Content/getContents&sitemapids=containsin_'.$id.'&sortcol=createdat&sorttype=DESC'.$condition);
        return $result;
    }
    public function getItem($id){
        $result = $this->api->get('?route=CMS/Content/getContent&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=CMS/Content/getContents'.$condition);
        return $result;
    }

}