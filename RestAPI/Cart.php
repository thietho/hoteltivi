<?php
require CONTROL . "SaleOrder.php";
class Cart extends Page{
    public function add(){
        $data = $this->request->getDataPost();
        $cart = $this->session->get('cart');
        if(empty($cart)){
            $cart = array();
            $data['quantity'] = 1;
            $cart[] = $data;
        }else{
            $is_exist = false;
            foreach ($cart as &$item){
                if($item['productid'] == $data['productid']){
                    $item['quantity']++;
                    $is_exist = true;
                }
            }
            if($is_exist == false){
                $data['quantity'] = 1;
                $cart[] = $data;
            }
        }
        $this->session->set('cart',$cart);
        $this->response->jsonOutput($cart);
    }
    public function remove(){
        $productid = $this->request->get('productid');
        $cart = $this->session->get('cart');
        foreach ($cart as $key => $item){
            if($item['productid'] == $productid){
                unset($cart[$key]);
            }
        }
        $this->session->set('cart',$cart);
        $this->response->jsonOutput($cart);
    }
    public function get(){
        $cart = $this->session->get('cart');
        $this->response->jsonOutput($cart);
    }
    public function updateQuantity(){
        $productid = $this->request->post('productid');
        $quantity = $this->request->post('quantity');
        $cart = $this->session->get('cart');
        foreach ($cart as &$item){
            if($item['productid'] == $productid){
                $item['quantity'] = $quantity;
            }
        }
        $this->session->set('cart',$cart);
        $this->response->jsonOutput($cart);
    }
    public function clear(){
        $this->session->remove('cart');
    }
    public function comfirmOrder(){
        $data = $this->request->getDataPost();
        $errors = $this->validate($data);
        if(empty($errors)){
            $saleOrderCtr = new \Lib\SaleOrder($this->api);
            $saleOrder_insert = array(
                'accountid' => 0,
                'contactid' => !empty($this->member['id'])?$this->member['id']:0,
                'saleorder_title' => 'Đơn hàng khách mua từ website',
                'status' => 'new',
                'paymentmethod' => $data['paymentmethod'],
                'billing_fullname' => $data['fullname'],
                'billing_phone' => $data['phone'],
                'billing_email' => $data['email'],
                'billing_address' => $data['address'],
                'billing_province' => $data['province'],
                'billing_district' => $data['district'],
                'billing_ward' => $data['ward'],
                'shipping_fullname' => $data['fullname'],
                'shipping_phone' => $data['phone'],
                'shipping_email' => $data['email'],
                'shipping_address' => $data['address'],
                'shipping_province' => $data['province'],
                'shipping_district' => $data['district'],
                'shipping_ward' => $data['ward'],
            );
            $result = $saleOrderCtr->save($saleOrder_insert);
            $result['link'] = $this->request->createLink('order-completed',$result['data']['id'].'-'.$result['data']['saleorder_code']);
            if($result['statuscode']){
                $saleorderid = $result['data']['id'];
                $cart = $this->session->get('cart');
                foreach ($cart as $item){
                    $saleOrderProduct_insert = array(
                        'saleorderid' => $saleorderid,
                        'productid' => $item['productid'],
                        'productname' => $item['productname'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['price']*$item['quantity'],
                    );
                    $saleOrderCtr->saveSaleOrderProduct($saleOrderProduct_insert);
                }
            }
            $this->clear();
        }else{
            $result = array(
                'statuscode' => 0,
                'errors' => $errors,
                'text' => 'Validate faile!'
            );

        }
        $this->response->jsonOutput($result);
    }
    private function validate($data){
        $errors = array();
        if(empty(trim($data['fullname']))){
            $errors['fullname'] = 'Bạn chưa nhập họ tên!';
        }
        if(empty(trim($data['address']))){
            $errors['address'] = 'Bạn chưa nhập địa chỉ!';
        }
        if(empty(trim($data['address']))){
            $errors['email'] = 'Bạn chưa nhập email!';
        }
        if(empty(trim($data['phone']))){
            $errors['email'] = 'Bạn chưa số điện thoại!';
        }
        $cart = $this->session->get('cart');
        if(empty($cart)){
            $errors['cart'] = 'Giỏ hàng bạn đang trống!';
        }
        return $errors;
    }
    public function sendNoti($saleorderid = ''){
        if($saleorderid == ''){
            $saleorderid = $this->request->get('saleorderid');
        }
        $saleOrderCtr = new \Lib\SaleOrder($this->api);
         $result = $saleOrderCtr->getItem($saleorderid);
        $saleOrder = $result['data'];

        //Gửi mail kích hoạt tài khoản
        $body = $this->section->loadView('Cart/order-completed.tpl', array('saleOrder' => $saleOrder));

        $mail = array(
            'mailto' => array(
                array('email' => $saleOrder['billing_email'], 'name' => $saleOrder['billing_fullname'])
            ),
            'mailreply' => '',
            'mailreplyname' => '',
            'mailcc' => '',
            'mailbcc' => '',
            'attachments' => '',
            'subject' => 'Đặt hàng thành công',
            'body' => $body,
            'bodytext' => strip_tags($body),
        );
        $ctlMail = new \Lib\Mail($this->api);
        $ctlMail->sendMail($mail);

    }
}