<?php
require CONTROL . "TicketPrice.php";
require CONTROL . "TicketBooking.php";
require CONTROL . "Ward.php";
use Lib\TicketBooking as LibTicketBooking;
use Lib\TicketPrice;

class TicketBooking extends Page
{
    public function index()
    {
        $data = $this->request->getDataPost();
        if (!empty($data)) {
            $func = $this->request->get('func');
            $this->$func();
        } else {

            $this->sitemap->loadTree(0);
            $sitemapid = $this->request->get('sitemapid');
            $sitemap = $this->sitemap->getSitemap($sitemapid);

            $this->breadcrumb = $this->sitemap->renderBreadcrumb($sitemap['id'], 14);
            //Set SEO Infor
            $this->setTitle("Booking Ticket");
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
            $banner = $this->sitemap->renderBanner($sitemap);
            $this->setData('banner', $banner);
            if($this->request->get('id') == ''){
                $databooking = $this->getDataBooking();
                $this->data['bookingform'] = $this->section->loadView('Common/bookingForm.tpl', array('databooking' => $databooking));
            }else{
                $arr = explode('-',$this->request->get('id'));
                $bookingid = $arr[0];
                $ctlTicketBooking = new \Lib\TicketBooking($this->api);
                $booking = $ctlTicketBooking->getItem($bookingid);
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
                $this->setData('bookingform','');
            }
            
            //$capacity = floor($databooking['adults'] / $databooking['rooms']);

            $this->data['content'] = $sitemap;

            $ctlTicketPrice = new TicketPrice($this->api);
            $dataTicketPrice = $ctlTicketPrice->getItem(TICKETPRICEIS);
            $this->setData('bookingconent', $this->section->loadView('PlayGround/' . $sitemapid . '.tpl', array('dataTicketPrice' => $dataTicketPrice, 'databooking' => $databooking)));

            $this->setTemplate('TicketBooking.tpl');
            $this->setLayout('default.tpl');
            return $this->render();
        }
    }
}
