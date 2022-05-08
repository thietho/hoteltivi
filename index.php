<?php
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require 'startup.php';
$request = new \Lib\Request();
$cache = new \Lib\Cache();
$api = new \Lib\Api();
$api->checkCacheVersion();
$date = new \Lib\Date();
$string = new \Lib\ObjString();
$ctlSetting = new \Lib\Setting($api);
$ctlSitemap = new \Lib\Sitemap($api);
$language = new \Lib\Language('vn');
$data = $ctlSetting->getGetList();
$setting = array();
foreach($data as $item){
    $setting[$item['code']] = $item;
}
$ctrLable = new \Lib\Label($api);
$dataLable = $ctrLable->getGetList();
$labels = array();
foreach ($dataLable as $item){
    if($request->get('lang')=='' || $request->get('lang')=='vn'){
        $labels[$item['code']] = $item['label'];
    }else{
        $labels[$item['code']] = $item['label_'.$request->get('lang')]!=''?$item['label_'.$request->get('lang')]:$item['label'];
    }

}
if($request->get('object') == ''){

    $cachefile = md5(json_encode($request->getDataGet())).'.tpl';
    $sitemapid = $request->get('sitemapid')==''?'Home':$request->get('sitemapid');
    $sitemap = $ctlSitemap->getSitemap($sitemapid);
    $page = $sitemap['sitemaptype'];
    $arr_notcache = array('RoomBooking','Member','TicketBooking');
    if(in_array($page,$arr_notcache)){
        $output = '';
    }else{
        $output = $cache->get($cachefile);
    }
    $output = '';
    if(empty($output)){
        require_once('Page/'.$page.'.php');
        $objPage = new $page($api);
        echo $output = $objPage->index();
        $cache->create($cachefile,$output);
    }else{
        echo $output;
    }

}else{
    $object = $request->get('object');
    require_once('RestAPI/'.$object.'.php');
    $objPage = new $object($api);
    if($request->get('method') == ''){
        echo $objPage->index();
    }else{
        $method = $request->get('method');
        echo $objPage->$method();
    }

}

?>
