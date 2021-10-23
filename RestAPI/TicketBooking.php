<?php
require CONTROL . "Contact.php";
require CONTROL . "Mail.php";
require CONTROL . "Ward.php";
require CONTROL . "TicketPrice.php";
require CONTROL . "TicketBooking.php";
class TicketBooking extends Page
{
    public function confirmBooking()
    {
        $data = $this->request->getDataPost();
        $databooking = $this->getDataBooking();
        $ctlTicketPrice = new \Lib\TicketPrice($this->api);
        $dataTicketPrice = $ctlTicketPrice->getItem(TICKETPRICEIS);
        $dataTicketBooking = array(
            'bookingdate' => $this->date->getTodayNoTime(),
            'acccountid' => 0,
            'contactid' => isset($this->member['id'])?$this->member['id']:0,
            'ticketstatus' => 'waitpayment',
            'customername' => $data['customername'],
            'custormerphone' => $data['custormerphone'],
            'customeremail' => $data['customeremail'],
            'customeraddress' => $data['customeraddress'],
            'customerwarid' => $data['ward'],
            'checkin' => $this->date->formatViewDate($databooking['checkdate']),
            'numberadults' => $databooking['tickeadults'],
            'numberchilds' => $databooking['ticketchilds'],
            'adultprice' => $dataTicketPrice['adultprice'],
            'childenprice' => $dataTicketPrice['childenprice'],
            'bookingtotal' => $databooking['ticketchilds'],
        );
        $ctlTicketBooking = new \Lib\TicketBooking($this->api);
        $ticketBooking = $ctlTicketBooking->save($dataTicketBooking);
        $ticketBooking['link'] = $this->request->createLink('confirmticketbooking',$ticketBooking['data']['id'].'-'.$ticketBooking['data']['bookingid']);
        $this->session->remove('checkdate');
        $this->session->remove('tickeadults');
        $this->session->remove('ticketchilds');
        echo json_encode($ticketBooking);
    }
    public function sendNoti($bookingid = ''){
        if($bookingid == ''){
            $bookingid = $this->request->get('bookingid');
        }
        $ctrTicketBooking = new \Lib\TicketBooking($this->api);
        $booking = $ctrTicketBooking->getItem($bookingid);

        $ward = new \Lib\Ward($this->api);
        if(isset($booking['customerwarid'])){
            $booking['ward'] = $ward->getItem($booking['customerwarid']);
        }
        $databooking = array(
            'checkdate' => $booking['checkin'],
            'tickeadults' => $booking['numberadults'],
            'ticketchilds' => $booking['numberchilds'],
            'customername' => $booking['customername'],
            'custormerphone' => $booking['custormerphone'],
            'customeraddress' => $booking['customeraddress'],
            'customeremail' => $booking['customeremail'],
            'customerwarid' => $booking['customerwarid'],
            'ward' => $booking['ward'],
        );
        $ctlTicketPrice = new \Lib\TicketPrice($this->api);
        $dataTicketPrice = $ctlTicketPrice->getItem(TICKETPRICEIS);
        //Gửi mail kích hoạt tài khoản
        $body = $this->section->loadView('PlayGround/ticketbookingdetail_email.tpl', array('dataTicketPrice' => $dataTicketPrice, 'databooking' => $databooking));

        $mail = array(
            'mailto' => array(
                array('email' => $booking['customeremail'], 'name' => $booking['customername'])
            ),
            'mailreply' => '',
            'mailreplyname' => '',
            'mailcc' => '',
            'mailbcc' => '',
            'attachments' => '',
            'subject' => 'Đặt vé thành công',
            'body' => $body,
            'bodytext' => strip_tags($body),
        );
        $ctlMail = new \Lib\Mail($this->api);
        $ctlMail->sendMail($mail);

    }
}