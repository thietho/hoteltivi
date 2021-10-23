<?php
require CONTROL.'Product.php';
class Product extends Page
{
    public function index(){

        $sitemapid = $this->request->get('sitemapid');
        $sitemap = $this->sitemap->getSitemap($sitemapid);
        $this->breadcrumb = $this->sitemap->renderBreadcrumb($sitemap['id']);
        //Header
        $this->sitemap->loadTree(0);
        $mainmenu = $this->sitemap->renderMenu(14);
        $this->setData('header',$this->section->loadView('Common/header.tpl',array('mainmenu'=>$mainmenu)));
        //Footer
        $this->setData('footer',$this->section->loadView('Common/footer.tpl'));
        $id = $this->request->get('id');
        $ctlPrduct = new \Lib\Product($this->api);
        if($id!=''){
            $arr = explode('-',$id);
            $contentid = $arr[0];
            $result = $ctlPrduct->getProduct($contentid);
            $product = $result['data'];
            $this->setTitle($product['productname']);
            $this->setDescription($product['summary']);
            $this->setKeywords($product['keywords']);
            $this->setAuthor('Hồ Lư');
            $this->setImage(IMAGESERVER.'root/upload/inv_product/'.$product['id'].'/'.$product['image']);
            //Body
            $images = array();
            $product['image'] = IMAGESERVER."autosize-800x500/upload/inv_product/".$product['id']."/".$product['image'];
            $images[] = array(
                'image' => $product['image'],
                'title' => $product['productname'],
                'summary' => $product['summary'],
            );
            $product['summary'] = $this->string->viewPlanText($product['summary']);
            $product['priceview'] = $this->string->numberFormate($product['price']).$this->setting['currency']['textvalue'];
            if($product['otherimage']!=''){
                $otherimage = json_decode($product['otherimage'],true);
                foreach ($otherimage as $item){
                    $images[] = array(
                        'image' => IMAGESERVER."autosize-800x500/upload/inv_product/".$product['id']."/".$item['image'],
                        'title' => $item['title'],
                        'summary' => $item['summary'],
                    );
                }
            }
            $product['images'] = $images;
            $this->setData('product',$product);
            $this->setTemplate('ProductDetail.tpl');

            $result = $ctlPrduct->getProducts("&paging=true&limit=8&page=1&type=containsin_bestsaler");
            $products = $result['data'];
            foreach ($products as &$product){
                $product = $ctlPrduct->formate($product);
            }
            $this->setData('bestsale',$products);
        }else{
            //Set SEO Infor
            $this->setTitle($sitemap['sitemapname']);
            $this->setDescription($sitemap['summary']);
            $this->setKeywords($sitemap['keywords']);
            $this->setAuthor('Hồ Lư');
            $this->setImage(IMAGESERVER.'root/upload/cms_sitemap/'.$sitemap['id'].'/'.$sitemap['shareimage']);
            //Body
            $page = $this->request->get('hlpage') == ''?1:$this->request->get('hlpage');
            if($sitemapid != 'menu'){
                $result = $ctlPrduct->getProducts("&paging=true&limit=20&page=$page&sitemapids=containsin_".$sitemap['id']);
            }else{
                $result = $ctlPrduct->getProducts("&paging=true&limit=20&page=$page");
            }

            if($result['statuscode']){
                $products = $result['data'];
                foreach ($products as &$product){
                    $product = $ctlPrduct->formate($product,$sitemap['sitemapid']);
                }

                $this->setData('products', $products);
                $this->setData('pagination', $result['pagination']);
                $this->setTemplate('Product.tpl');
            }


        }
        $this->setData('breadcrumb',$this->sitemap->renderBreadcrumb($sitemap['id'],14));
        $this->setData('sitemap', $sitemap);
        $this->setLayout('default.tpl');
        return $this->render();
    }
}