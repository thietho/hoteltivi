<?php
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require 'startup.php';
$request = new \Lib\Request();
$cache = new \Lib\Cache();
$api = new \Lib\Api();

$ctlSetting = new \Lib\Setting($api);
$ctlSitemap = new \Lib\Sitemap($api);
$data = $ctlSetting->getGetList();
$setting = array();
foreach($data as $item){
    $setting[$item['code']] = $item;
}
if($request->get('object') == ''){
    $api->checkCacheVersion();
    $cachefile = md5(json_encode($request->getDataGet())).'.tpl';
    $output = $cache->get($cachefile);
    if(empty($output)){
        $sitemapid = $request->get('sitemapid')==''?'Home':$request->get('sitemapid');

        $sitemap = $ctlSitemap->getSitemap($sitemapid);
        $page = $sitemap['sitemaptype'];
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
