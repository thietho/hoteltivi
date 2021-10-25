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
    public $language;
    protected $setting = array();

    public function __construct($api)
    {
        global $sitemap,$setting;
        $this->api = $api;
        $this->request = new Request();
        $this->response = new Response();
        $this->section = new Section($api);
        $this->sitemap = new Sitemap($api);
        $this->string = new ObjString();
        $this->date = new Date();
        $this->content = new Content($api);
        $this->optionset = new \Lib\OptionSet($api);
        $this->session = new Session();
        $this->language = new \Lib\Language('vn');
        $this->setting = $setting;
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
            return $output;
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
}