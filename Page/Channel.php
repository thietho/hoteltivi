<?php
require CONTROL . "Channel.php";
class Channel extends Page
{
    public function index()
    {
        $this->setData('header',$this->section->loadViewPage('Common/header.tpl',['sitemap' => $this->data['sitemap']]));
        //Body
        $channelGroup = $this->optionset->getItem(37);
        $ctrChannel = new \Lib\Channel($this->api);
        $condition = '';
        if($this->request->get('group')!=''){
            $condition .= "&channelgroup=equal_".$this->request->get('group');
        }
        $result = $ctrChannel->getGetList($condition);

        $this->setData('channelGroups',json_decode($channelGroup['optionsetvalue'],true));
        $channels = $result['data'];

        foreach ($channels as &$channel){
            $channel['logo'] = IMAGESERVER."fixsize-313x190/upload/hotel_channel/".$channel['id']."/".$channel['logo'];
        }
        $this->setData('channels',$channels);
        $this->setTemplate('Channel.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
}