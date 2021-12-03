<?php
require CONTROL . "Notification.php";
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
        //$this->response->jsonOutput(array('Cleared!'));
    }
    public function saveOrder(){
        $data = $this->request->getDataPost();
        $errors = $this->validate($data);
        if(empty($errors)){
            $ctrNotification = new \Lib\Notification($this->api);
            $foodorder = $this->session->get('foodorder');
            $content = '';
            $total = 0;
            $count = 0;
            foreach ($foodorder as $key => $item){
                $total += $item['price']*$item['quantity'];
                $count += $item['quantity'];
                $content .= '<tr>'.
                        '<td>'.($key+1).'</td>'.
                        '<td>'.$item['foodname'].'</td>'.
                        '<td style="text-align: right">'.$item['quantity'].'</td>'.
                        '<td style="text-align: right">'.$this->string->numberFormate($item['price']).'</td>'.
                        '<td style="text-align: right">'.$this->string->numberFormate($item['price']*$item['quantity']) .'</td>'.
                        '</tr>';
            }
            $header = '<thead><tr>'.
                        '<th>No.</th>'.
                        '<th>Name</th>'.
                        '<th>Quantity</th>'.
                        '<th>Price</th>'.
                        '<th>Subtotal</th>'.
                        '</tr></thead>';
            $footer = '<tfoot>'.
                       '<tr>'.
                       '<td></td>'.
                       '<td>Count</td>'.
                       '<td style="text-align: right">'.$count.'</td>'.
                       '<td>Total</td>'.
                       '<td style="text-align: right">'.$this->string->numberFormate($total).'</td>'.
                       '</tr>'.
                       '</tfoot>';
            $content = '<table class="table table-bordered table-striped dataTable">'.$header.'<tbody>'.$content.'</tbody>'.$footer.'</table>';
            $notification_insert = array(
                'title' => 'Phòng '.$data['roomnumber'].' đặt món ăn',
                'status' => 'new',
                'content' => $content,
            );
            $result = $ctrNotification->save($notification_insert);

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
        if(empty(trim($data['roomnumber']))){
            $errors['roomnumber'] = 'Chư xát định được phòng!';
        }
        $foodorder = $this->session->get('foodorder');
        if(empty($foodorder)){
            $errors['foodorder'] = 'Giỏ hàng bạn đang trống!';
        }
        return $errors;
    }
}