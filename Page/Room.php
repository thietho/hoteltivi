<?php
require CONTROL . "Room.php";
class Room extends Page
{
    public function index()
    {
        $data = $this->request->getDataPost();
        if (!empty($data)) {
            $func = $this->request->get('func');
            $this->$func();
        } else {
            $this->sitemap->loadTree(14);
            $sitemapid = $this->request->get('sitemapid');
            $sitemap = $this->sitemap->getSitemap($sitemapid);
            
            $this->breadcrumb = $this->sitemap->renderBreadcrumb($sitemap['id'], 14);
            //Set SEO Infor
            $this->setTitle($sitemap['sitemapname']);
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
            $this->setData('banner',$banner);
            $databooking = $this->getDataBooking();
            $capacity = floor($databooking['adults'] / $databooking['rooms']);
            $this->data['bookingform'] = $this->section->loadView('Common/bookingForm.tpl', array('databooking' => $databooking));
            $this->data['content'] = $sitemap;
            
            $ctrRoom = new \Lib\Room($this->api);
    
            if (empty($databooking['checkin'])) {
                if($this->request->get('id')==''){
                    $condition = '';
                    $roomtype = $this->request->get('roomtype');
                    if(!empty($roomtype)){
                        $condition .= "&roomtype=equal_$roomtype";
                    }
                    $condition .= "&sortcol=adults&sorttype=asc";
                    $dataroom = $ctrRoom->getGetList($condition);
                    foreach ($dataroom as &$room) {
                        $room = $ctrRoom->formateData($room);
                        $gallery = json_decode($room['gallery'],true);
                        $room['gallery'] = $gallery;
                        $room['link'] = $this->request->createLink($sitemap['sitemapid'],$room['id'].'-'.$this->string->clean($this->string->utf8convert($room['roomname'])));
                    }
                    $this->setData('listroom', $this->section->loadView('Hotel/rooms.tpl', array('rooms' => $dataroom)));
                }else{
                    $arr = explode('-',$this->request->get('id'));
                    $id = $arr[0];
                    $room = $ctrRoom->getItem($id);
                    $room = $ctrRoom->formateData($room);
                    $gallery = json_decode($room['gallery'],true);
                    $this->setData('listroom', $this->section->loadView('Hotel/roomdetail.tpl', array('room' => $room,'gallery' => $gallery)));

                }

            } else {
                $condition = "&adults=morethanequal_$capacity&sortcol=adults&sorttype=asc";
                $dataroom = $ctrRoom->getGetList($condition);
                $numberroombooking = $databooking['rooms'];
                foreach ($dataroom as &$room) {
                    $room = $ctrRoom->formateData($room);
                    if ($room['numberofrooms'] >= $numberroombooking) {
                        $room['numberroombooking'] = $numberroombooking;
                        $numberroombooking = 0;
                    } else {
                        $room['numberroombooking'] = $room['numberofrooms'];
                        $numberroombooking -= $room['numberofrooms'];
                    }
                    //$room['checkroom'] = $ctrRoom->checkRoom($room['id'], $databooking['checkin'], $databooking['checkout']);
                }
                $this->setData('listroom', $this->section->loadView('Hotel/booking.tpl', array('rooms' => $dataroom, 'booking' => $databooking)));
            }
            $this->setData('databooking', json_encode($databooking));
    
            $this->setTemplate('Room.tpl');
            $this->setLayout('default.tpl');
            return $this->render();
        }   
    }
}
