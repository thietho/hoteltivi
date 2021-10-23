<?php

use Control\OptionSet;
use Lib\Room;

require CONTROL . "Room.php";
require CONTROL . "Ward.php";
class RoomBooking extends Page
{
    public function index()
    {
        $this->sitemap->loadTree(0);
        $sitemapid = $this->request->get('sitemapid');
        $sitemap = $this->sitemap->getSitemap($sitemapid);

        $this->breadcrumb = $this->sitemap->renderBreadcrumb($sitemap['id'], 14);
        //Set SEO Infor
        $this->setTitle("Booking Room");
        $this->setDescription($sitemap['summary']);
        $this->setKeywords($sitemap['keywords']);
        $this->setAuthor('Hồ Lư');
        $this->setImage(IMAGESERVER . 'root/upload/cms_sitemap/' . $sitemap['id'] . '/' . $sitemap['shareimage']);
        //Header

        $mainmenu = $this->sitemap->renderMenu(14);
        $this->setData('header', $this->section->loadView('Common/header.tpl', array('mainmenu' => $mainmenu)));
        //Footer
        $this->setData('footer', $this->section->loadView('Common/footer.tpl'));
        //Body
        $this->data['content'] = $sitemap;
        $ctrRoom = new \Lib\Room($this->api);
        if ($this->request->get('id') != '') {
            $arr = explode('-', $this->request->get('id'));
            $bookingid = $arr[0];
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
        } else {
            $this->getDataBooking();
            $bookingdetail = $this->session->get('bookingdetail');
        }

        if (empty($bookingdetail)) {
            $this->response->redirect($this->request->createLink('rooms'));
        }

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

        $this->setData('bookingdetail', $bookingdetail);
        if (isset($booking)) {
            $this->setData('booking', $booking);
        }
        $this->setData('content',$this->section->loadViewPage('RoomBooking/'.$this->data['sitemap']['sitemapid'].'.tpl',$this->data));
        $this->setTemplate('RoomBooking.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }


}
