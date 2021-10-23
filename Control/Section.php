<?php

namespace Lib;

use Lib\Api;
use Lib\Request;

class Section extends Control
{
    public $request;
    public $setting = array();
    private $session;
    public $language;
    public $member;
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
        $ctlSetting = new \Lib\Setting($api);
        $this->session = new Session();
        $data = $ctlSetting->getGetList();
        $this->language = new \Lib\Language('vn');
        foreach($data as $item){
            $this->setting[$item['code']] = $item;
        }
        $this->member = $this->session->get('member');
    }

    public function loadView($view, $data = array())
    {
        $this->setData('data',$data);
        $content = $this->render($view);
        return $content;
    }
    public function loadViewPage($view, $data = array())
    {
        $this->data = $data;
        $content = $this->render($view);
        return $content;
    }
    public function createLinkContent($sitemapid,$content){
        $content['id'] . '-' . $this->string->clean($this->string->utf8convert($content['title']));
        return $this->request->createLink($sitemapid,$content['id'] . '-' . $this->string->clean($this->string->utf8convert($content['title'])));
    }
}