<?php
namespace Lib;
use Lib\Api;
use Lib\Request;

class Product extends Control
{
    public function __construct(Api $api)
    {
        parent::__construct($api);
    }

    public function getProduct($id){
        $result = $this->api->get('?route=Inventory/Product/getProduct&id='.$id);
        return $result;
    }
    public function getProducts($condition){
        $result = $this->api->get('?route=Inventory/Product/getProducts'.$condition);
        return $result;
    }
    public function formate($product,$sitemapid = ''){
        if($sitemapid == ''){
            global $ctlSitemap;
            $sitemapids = $product['sitemapids'];
            $arrsitemapid = $this->string->stringToArray($sitemapids);
            $sitemap = $ctlSitemap->getItem($arrsitemapid[0]);
            $sitemapid = $sitemap['sitemapid'];
        }

        $product['summary'] = $this->string->getTextLength($product['summary'],0,15);
        $product['image'] = IMAGESERVER."autosize-400x250/upload/inv_product/".$product['id']."/".$product['image'];
        $product['priceview'] = $this->string->numberFormate($product['price']).' '.$this->setting['currency']['textvalue'];
        $product['link'] = $this->request->createLink($sitemapid,$product['id'].'-'.$this->string->clean($this->string->utf8convert($product['productname'])));
        return $product;
    }
}