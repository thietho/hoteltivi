<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class Sitemap extends Control
{
    public $sitemaps;
    public $request;
    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->request = new Request();
    }

    public function loadTree($rootid){
        $result = $this->api->get('?route=CMS/SiteMap/getTree&rootid='.$rootid);
        if($result['statuscode']){
            foreach($result['data'] as $sitemap){
                if(!$sitemap['ishidden']){
                    $this->sitemaps[] = $sitemap;
                }
            }
        }
    }
    public function getChilds($parent){
        $result = $this->api->get('?route=CMS/SiteMap/getChilds&parent='.$parent);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getSitemap($sitemapid){
        $sitemaps = $this->string->array_Filter($this->sitemaps,'sitemapid',$sitemapid);
        if(!empty($sitemaps)){
            return $sitemaps[0];
        }else{
            $result = $this->api->get('?route=CMS/SiteMap/getSiteMaps&sitemapid=equal_' . $sitemapid);
            if ($result['statuscode']) {
                return $result['data'][0];
            } else {
                return array();
            }
        }
    }
    public function getItem($id){
        $result = $this->api->get('?route=CMS/SiteMap/getSiteMap&id='.$id);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getGetList($condition=''){
        $result = $this->api->get('?route=CMS/SiteMap/getSiteMaps'.$condition);
        if($result['statuscode']){
            return $result['data'];
        }else{
            return array();
        }
    }
    public function getPath($id,&$path,$root=0){
        $sitemap = $this->getItem($id);
        if(!empty($sitemap)){
            $path[] = $sitemap;
            if($sitemap['sitemapparent']!=$root){
                $this->getPath($sitemap['sitemapparent'],$path);
            }
        }

    }
    public function renderBanner($sitemap){
        if(empty($sitemap['gallery']))
            return '';
        $this->setData('id',$sitemap['id']);
        //var_dump($sitemap['gallery']);
        $gallery = json_decode($this->string->formateJson($sitemap['gallery']),true);
        foreach($gallery as &$item){
            $item['image'] = IMAGESERVER.'fixsize-1600x500/upload/cms_sitemap/'.$sitemap['id'].'/'. $item['image'];
        }
        $this->setData('banners',$gallery);

        $content = $this->render('Carousel/Carousel.tpl');
        return $content;
    }
    public function renderBreadcrumb($id,$root=0){
        $path = array();
        $this->getPath($id,$path,$root);
        $breadcrumb = '<li class="breadcrumb-item"><a href="'.HTTPSERVER.'">Home Page</a></li>';
        while (!empty($path)){
            $sitemap = array_pop($path);
            if($sitemap['id']!=$root){
                $breadcrumb .= '<li class="breadcrumb-item"><a href="'.$this->request->createLink($sitemap['sitemapid']).'">'.$sitemap['sitemapname'].'</a></li>';
            }
        }
        return '<nav aria-label="breadcrumb"><ol class="breadcrumb">'.$breadcrumb.'</ol></nav>';
    }
    public function renderMenu($parent,$level=0){

        $sitemaps = $this->string->array_Filter($this->sitemaps,'sitemapparent',$parent);
        if(!empty($sitemaps)){
            $str = '';
            foreach ($this->sitemaps as $sitemap){
                if($sitemap['sitemapparent'] == $parent){
                    $childs = $this->string->array_Filter($this->sitemaps,'sitemapparent',$sitemap['id']);
                    $aclass = 'nav-link';
                    if($level > 0){
                        $aclass = 'dropdown-item';
                    }
                    $link = $this->request->createLink($sitemap['sitemapid']);
                    if(empty($childs)){
                        $str .= '<li class="nav-item" sitemapid="'.$sitemap['id'].'"><a class="'.$aclass.'" href="'.$link.'">'.$sitemap['sitemapname'].'</a></li>';
                    }else{
                        $str .= '<li class="nav-item dropdown"><a class="'.$aclass.' dropdown-toggle" href="'.$link.'" id="sitemap_'.$sitemap['id'].'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$sitemap['sitemapname'].'</a>';
                        $str .= '<ul class="dropdown-menu animated fadeIn" aria-labelledby="sitemap_'.$sitemap['id'].'">'.$this->renderMenu($sitemap['id'],$level+1).'</li></ul>';
                    }

                }
            }
            return $str;
        }else{
            return '';
        }

    }
}