<?php
require CONTROL . "Contact.php";
require CONTROL . "Mail.php";
require CONTROL . "Ward.php";
require CONTROL . "Room.php";
class RoomBooking extends Page
{
    public function checkRoom(){
        $roomid = $this->request->post('roomid');
        $checkin = $this->request->post('checkin');
        $checkout = $this->request->post('checkout');
        $ctrRoom = new \Lib\Room($this->api);
        $data = $ctrRoom->checkRoom($roomid,$checkin,$checkout);
        echo json_encode($data);
    }
    public function bookRoom()
    {
        $data = $this->request->getDataPost();
        $databookingdetail = $this->getDataBooking();
        $databookingdetail['bookingdetail'] = $data;
        $this->session->set('bookingdetail', $databookingdetail);
        return json_encode(array('statuscode' => 1));
    }
    private function validateForm($data){
        $errors = array();
        if(empty($data['customername'])){
            $errors['customername'] = 'Bạn chưa nhập họ tên';
        }
        if(empty($data['custormerphone'])){
            $errors['custormerphone'] = 'Bạn chưa nhập số điện thoại';
        }
        if(empty($data['customeremail'])){
            $errors['customeremail'] = 'Bạn chưa nhập số email';
        }
        return $errors;
    }
    public function confirmBooking()
    {
        $databookingdetail = $this->session->get('bookingdetail');
        $databookingdetail['bookingcontact'] = $this->request->getDataPost();

        $errors = $this->validateForm($this->request->getDataPost());
        if(empty($errors)){
            $ctlroom = new \Lib\Room($this->api);
            $databooking = array(
                'bookingdate' => $this->date->getTodayNoTime(),
                'acccountid' => 0,
                'contactid' => isset($this->member['id'])?$this->member['id']:0,
                'customername' => isset($databookingdetail['bookingcontact']['customername'])?$databookingdetail['bookingcontact']['customername']:'',
                'custormerphone' => isset($databookingdetail['bookingcontact']['custormerphone'])?$databookingdetail['bookingcontact']['custormerphone']:'',
                'customeremail' => isset($databookingdetail['bookingcontact']['customeremail'])?$databookingdetail['bookingcontact']['customeremail']:'',
                'customeraddress' => isset($databookingdetail['bookingcontact']['customeraddress'])?$databookingdetail['bookingcontact']['customeraddress']:'',
                'customerwarid' => isset($databookingdetail['bookingcontact']['ward'])?$databookingdetail['bookingcontact']['ward']:'',
                'checkin' => $this->date->formatViewDate($databookingdetail['checkin']),
                'checkout' => $this->date->formatViewDate($databookingdetail['checkout']),
                'adults' => $databookingdetail['adults'],
                'childs' => $databookingdetail['childs'],
                'rooms' => $databookingdetail['rooms'],
                'bookingstatus' => 'waitpayment',
                'paid' => 0,
                'numdate' => $databookingdetail['numdate'],
                'vatamount' => $databookingdetail['bookingcontact']['vatamount'],
                'servicechargeamount' => $databookingdetail['bookingcontact']['servicechargeamount'],
                'bookingtotal' => $databookingdetail['bookingcontact']['bookingtotal'],
                'total' => $databookingdetail['bookingcontact']['total'],
            );
            $result = $ctlroom->saveBooking($databooking);
            if($result['statuscode']){
                $bookingid = $result['data']['id'];
                $arrbookdate = array();
                for ($i = 0; $i < $databookingdetail['numdate']; $i++) {
                    $arrbookdate[] = $this->date->addday($databookingdetail['datecheckin'], $i);
                }
                $total = 0;
                foreach($databookingdetail['bookingdetail'] as $key => $detail){
                    foreach($arrbookdate as $date){
                        $datadetail = array(
                            'bookingid' => $bookingid,
                            'roomid' => $detail['roomid'],
                            'bookdate' => $this->date->formatMySQLDate($date),
                            'bookprice' => $detail['price'],
                            'quantityrooms' => $detail['qty'],
                            'booksubtotal' => $detail['qty']*$detail['price'],
                            'bookingstatus' => 'new',
                            'guestfullname' => $databookingdetail['bookingcontact']['gestfullname'][$detail['roomid']],
                            'guestphone' => $databookingdetail['bookingcontact']['gestphone'][$detail['roomid']],
                        );
                        $total += $datadetail['booksubtotal'];
                        $ctlroom->saveBookingDetail($datadetail);
                    }
                }
                $result['link'] = $this->request->createLink('confirmbooking',$result['data']['id'].'-'.$result['data']['bookingid']);
//                $this->session->remove('bookingdetail');
//                $this->session->remove('checkin');
//                $this->session->remove('checkout');
//                $this->session->remove('adults');
//                $this->session->remove('childs');
//                $this->session->remove('rooms');
//                $this->sendNoti($result['data']['id']);
            }
            echo json_encode($result);
        }else{
            echo json_encode(array(
                'statuscode' => 0,
                'text' => 'Save failed',
                'data' => $errors
            ));
        }

        // $result = $ctlroom->saveBooking(array(
        //     'id' => $bookingid,
        //     'bookingtotal' => $total
        // ));
        // print_r($result);
    }
    public function sendNoti($bookingid = ''){
        if($bookingid == ''){
            $bookingid = $this->request->get('bookingid');
        }
        $ctrRoom = new \Lib\Room($this->api);
        $booking = $ctrRoom->getBooking($bookingid);

        $ward = new \Lib\Ward($this->api);
        if(isset($booking['customerwarid'])){
            $booking['ward'] = $ward->getItem($booking['customerwarid']);
        }
        $bookingdetail = array(
            'checkin' => $this->date->formatMySQLDate($booking['checkin']),
            'checkout' => $this->date->formatMySQLDate($booking['checkout']),
            'adults' => $booking['adults'],
            'childs' => $booking['childs'],
            'rooms' => $booking['rooms'],
            'datecheckin' => $booking['checkin'],
            'datecheckout' => $booking['checkout'],
            'numdate' => $booking['numdate']
        );
        $condition = "&bookingid=equal_$bookingid&bookdate=equal_" . $bookingdetail['checkin'];
        $details = $ctrRoom->getBookingDetails($condition);
        $data = array();
        foreach ($details as $detail) {
            $arr = array(
                'roomid' => $detail['roomid'],
                'qty' => $detail['quantityrooms'],
                'price' => $detail['bookprice'],
                'guestfullname' => $detail['guestfullname'],
                'guestphone' => $detail['guestphone']
            );
            $data[] = $arr;
        }
        $bookingdetail['bookingdetail'] = $data;
        $booking['details'] = $details;

        $sumadults = 0;
        $sumchilds = 0;
        $sumroom = 0;
        $total = 0;

        foreach ($bookingdetail['bookingdetail'] as &$item) {
            $room = $ctrRoom->getItem($item['roomid']);
            $item['roomname'] = $room['roomname'];
            $item['adults'] = $room['adults'];
            $sumadults += $room['adults'] * $item['qty'];
            $item['childs'] = $room['childs'];
            $sumchilds += $room['childs'] * $item['qty'];
            $sumroom += $item['qty'];
            $total += $item['price'] * $item['qty'];
            $item['rooninfor'] = $ctrRoom->formateData($room);
        }
        $bookingdetail['sumadults'] = $sumadults;
        $bookingdetail['sumchilds'] = $sumchilds;
        $bookingdetail['sumroom'] = $sumroom;
        $bookingdetail['total'] = $total;

        //Gửi mail kích hoạt tài khoản
        $body = $this->section->loadViewPage('RoomBooking/roombookingdetail_email.tpl', array('booking' =>$booking,'bookingdetail' => $bookingdetail));

        $mail = array(
            'mailto' => array(
                array('email' => $booking['customeremail'], 'name' => $booking['customername'])
            ),
            'mailreply' => '',
            'mailreplyname' => '',
            'mailcc' => '',
            'mailbcc' => '',
            'attachments' => '',
            'subject' => 'Đặt phòng thành công',
            'body' => $body,
            'bodytext' => strip_tags($body),
        );
        $ctlMail = new \Lib\Mail($this->api);
        $ctlMail->sendMail($mail);

    }
}