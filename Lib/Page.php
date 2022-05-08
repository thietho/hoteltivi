<?php

use Lib\Request;
use Lib\Session;
use Lib\Section;
use Lib\Sitemap;
use Lib\ObjString;
use Lib\Date;
use Lib\Content;
use Lib\Response;


class Page
{
    protected $template;
    protected $layout;
    protected $dirTemplate = 'Template/';
    protected $dirLayout = 'Layout/';
    protected $data;
    protected $body;
    protected $title;
    protected $description;
    protected $author;
    protected $image;
    protected $url;
    protected $keywords;
    protected $api;
    protected $request;
    protected $response;
    protected $sitemap;
    protected $breadcrumb;
    protected $section;
    protected $string;
    protected $date;
    protected $content;
    protected $session;
    protected $member;
    protected $optionset;
    protected $validation;
    protected $setting = array();
    protected $labels = array();
    public function __construct($api)
    {
        global $sitemap,$date,$string,$request,$setting,$labels;
        $this->api = $api;
        $this->request = $request;
        $this->response = new Response();
        $this->sitemap = new Sitemap($api);
        $this->string = $string;
        $this->date = $date;
        $this->content = new Content($api);
        $this->session = new Session();
        $this->setting = $setting;
        $this->section = new Section($api,$this->setting);
        $this->optionset = new \Lib\OptionSet($api);
        $this->validation = new \Lib\Validation();
        if(!empty($sitemap)){
            $this->setData('sitemap',$sitemap);
            //Set SEO Infor
            $this->breadcrumb = $this->sitemap->renderBreadcrumb($sitemap['id'],14);
            //Set SEO Infor
            $this->setTitle($sitemap['sitemapname']);
            $this->setDescription($sitemap['summary']);
            $this->setKeywords($sitemap['keywords']);
            $this->setAuthor('Hồ Lư');
            $this->setImage(IMAGESERVER . 'root/upload/cms_sitemap/' . $sitemap['id'] . '/' . $sitemap['shareimage']);
        }
        $this->member = $this->session->get('member');
        $this->labels = $labels;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @param mixed $data
     */
    public function setData($key,$val)
    {
        $this->data[$key] = $val;
    }
    public function loadPageResoure($path){
        $filename = $this->dirTemplate . $path;
        if(file_exists($filename)){
            ob_start();
            extract($this->data);
            require($filename);
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }
    }

    public function render()
    {
        $output = '';
        if (!empty($this->template)) {
            $filename = $this->dirTemplate . $this->template;
            extract($this->data);
            ob_start();
            require($filename);
            $this->body = ob_get_contents();
            ob_end_clean();
        }
        if($this->layout!=''){
            return $this->renderLayout();
        }else{
            echo $this->body;
            return $this->body;
        }

    }
    private function renderLayout(){
        $filename = $this->dirLayout . $this->layout;
        if(!empty($this->data)){
            extract($this->data);
        }
        ob_start();
        require($filename);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    protected function getDataBooking(){
        $databooking = array();
        if(!empty($this->request->get('checkin'))){
            $this->session->set('checkin',$this->request->get('checkin'));
            $this->session->set('checkout',$this->request->get('checkout'));
            $this->session->set('adults',$this->request->get('adults'));
            $this->session->set('childs',empty($this->request->get('childs'))?0:$this->request->get('childs'));
            $this->session->set('ageofchild',empty($this->request->get('ageofchild'))?'':$this->request->get('ageofchild'));
            $this->session->set('rooms',$this->request->get('rooms'));
        }
        if(!empty($this->request->get('checkdate'))){
            $this->session->set('checkdate',$this->request->get('checkdate'));
            $this->session->set('tickeadults',$this->request->get('tickeadults'));
            $this->session->set('ticketchilds',empty($this->request->get('ticketchilds'))?0:$this->request->get('ticketchilds'));
        }
        $databooking['checkin'] = $this->session->get('checkin');
        $databooking['checkout'] = $this->session->get('checkout');
        $databooking['adults'] = $this->session->get('adults')==''?2:$this->session->get('adults');
        $databooking['childs'] = $this->session->get('childs')==''?0:$this->session->get('childs');
        $databooking['ageofchild'] = $this->session->get('ageofchild')==''?'':$this->session->get('ageofchild');
        $databooking['rooms'] = $this->session->get('rooms')==''?1:$this->session->get('rooms');
        $databooking['datecheckin'] = $this->date->formatViewDate($databooking['checkin']);
        $databooking['datecheckout'] = $this->date->formatViewDate($databooking['checkout']);
        $databooking['numdate'] = ($this->date->timeToInt($databooking['checkout']) - $this->date->timeToInt($databooking['datecheckin']))/24/60/60;


        $databooking['checkdate'] = $this->session->get('checkdate');
        $databooking['tickeadults'] = $this->session->get('tickeadults')==''?2:$this->session->get('tickeadults');
        $databooking['ticketchilds'] = $this->session->get('ticketchilds')==''?0:$this->session->get('tickeadults');

        return $databooking;
    }
}