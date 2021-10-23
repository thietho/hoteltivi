<?php
require CONTROL . "SaleOrder.php";
class Cart extends Page
{
    public function index()
    {
        global $sitemap,$setting;
        //Header
        $this->sitemap->loadTree(0);
        $mainmenu = $this->sitemap->renderMenu(14);

        $this->setData('header', $this->section->loadView('Common/header.tpl', array('mainmenu' => $mainmenu)));
        //Footer
        $this->setData('footer', $this->section->loadView('Common/footer.tpl'));

        //Body
        $cart = array();
        //$this->session->remove('cart');
        if(!empty($this->session->get('cart'))){
            $cart = $this->session->get('cart');
        }

        if($this->request->get('sitemapid') == 'order-completed'){
            $strid = $this->request->get('id');
            if(empty($strid)){
                $this->response->redirect($this->request->createLink());
            }else{
                $arr = explode('-',$strid);
                $saleorderid = $arr[0];
                $saleOrderCtr = new \Lib\SaleOrder($this->api);
                $saleOrder = $saleOrderCtr->getItem($saleorderid);
                $condition = "&saleorderid=equal_".$saleorderid;
                $saleOrderProduct = $saleOrderCtr->getGetSaleOrderProductList($condition);
                $saleOrder['data']['detail'] = $saleOrderProduct['data'];
                $this->setData('content',$this->section->loadViewPage('Cart/'.$sitemap['sitemapid'].'.tpl',['saleOrder' => $saleOrder['data']]));
            }

        }else{
            $this->setData('content',$this->section->loadViewPage('Cart/'.$sitemap['sitemapid'].'.tpl',['cart' => $cart]));
        }

        $this->setTemplate('Cart.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}