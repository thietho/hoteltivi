<?php
class FoodOrder extends Page{
    public function add(){
        $data = $this->request->getDataPost();
        $foodorder = $this->session->get('foodorder');
        if(empty($foodorder)){
            $foodorder = array();
            //$data['quantity'] = 1;
            $foodorder[] = $data;
        }else{
            $is_exist = false;
            foreach ($foodorder as &$item){
                if($item['foodid'] == $data['foodid']){
                    $item['quantity']+=$data['quantity'];
                    $is_exist = true;
                }
            }
            if($is_exist == false){
                //$data['quantity'] = 1;
                $foodorder[] = $data;
            }
        }
        $this->session->set('foodorder',$foodorder);
        $this->response->jsonOutput($foodorder);
    }
    public function remove(){
        $foodid = $this->request->get('foodid');
        $foodorder = $this->session->get('foodorder');
        foreach ($foodorder as $key => $item){
            if($item['foodid'] == $foodid){
                unset($foodorder[$key]);
            }
        }
        $this->session->set('foodorder',$foodorder);
        $this->response->jsonOutput($foodorder);
    }
    public function get(){
        $foodorder = $this->session->get('foodorder');
        $this->response->jsonOutput($foodorder);
    }
    public function updateQuantity(){
        $foodid = $this->request->post('foodid');
        $quantity = $this->request->post('quantity');
        $foodorder = $this->session->get('foodorder');
        foreach ($foodorder as &$item){
            if($item['foodid'] == $foodid){
                $item['quantity'] = $quantity;
            }
        }
        $this->session->set('foodorder',$foodorder);
        $this->response->jsonOutput($foodorder);
    }
    public function clear(){
        $this->session->remove('foodorder');
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
                $foodorder = $this->session->get('foodorder');
                foreach ($foodorder as $item){
                    $saleOrderProduct_insert = array(
                        'saleorderid' => $saleorderid,
                        'foodid' => $item['foodid'],
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
        $foodorder = $this->session->get('foodorder');
        if(empty($foodorder)){
            $errors['foodorder'] = 'Giỏ hàng bạn đang trống!';
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