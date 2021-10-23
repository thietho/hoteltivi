<?php

require CONTROL."ListItem.php";
class News extends Page
{
    public function index(){
        $id = $this->request->get('id');
        //Header
        $this->sitemap->loadTree(0);
        $mainmenu = $this->sitemap->renderMenu(14);
        $this->setData('header',$this->section->loadView('Common/header.tpl',array('mainmenu'=>$mainmenu)));
        //Footer

         //Body
        $sitemap = $this->data['sitemap'];
        $this->setData('footer',$this->section->loadView('Common/footer.tpl'));
        $banner = $this->sitemap->renderBanner($sitemap);
        $this->setData('banner',$banner);
        $databooking = $this->getDataBooking();
        $this->data['bookingform'] = $this->section->loadView('Common/bookingForm.tpl',array('databooking' =>$databooking));
        if($id!=''){
            $arr = explode('-',$id);
            $contentid = $arr[0];

            $content = $this->content->getContent($contentid);

            $this->setTitle($content['title']);
            $this->setDescription($content['summary']);
            $this->setKeywords($content['summary']);
            $this->setAuthor('Hồ Lư');
            $this->setImage(IMAGESERVER.'root/upload/cms_content/'.$content['id'].'/'.$content['image']);
            $this->data['content'] = $content;
            $news = $this->content->getContentsbySitemap($sitemap['id'],'&paging=true&limit=12&createdat=lessthan_'.urlencode($this->date->formatMySQLDate($content['createdat']).' '.$this->date->getTime($content['createdat'])));
            $contents = array();
            foreach ($news['data'] as $content){
                $item['title'] = $content['title'];
                $item['summary'] = $content['summary'];
                $item['image'] = IMAGESERVER."fixsize-370x265/upload/cms_content/".$content['id']."/".$content['image'];
                $item['createdat'] = $this->date->formatMySQLDate($content['createdat']);
                $item['link'] = $this->request->createLink($sitemap['sitemapid'],$content['id'].'-'.$this->string->clean($this->string->utf8convert($content['title'])));
                $contents[] = $item;
            }
            $this->setData('morenews',$contents);
            $this->setTemplate('NewsDetail.tpl');
        }else{
            $page = $this->request->get('hlpage') == ''?1:$this->request->get('hlpage');
            $result = $this->content->getContentsbySitemap($sitemap['id'],'&paging=true&limit=18&page='.$page);

            if($result['statuscode']){
                $contents = $result['data'];
                foreach ($contents as &$content){
                    $content['summary'] = $this->string->getTextLength($content['summary'],0,15);
                    $content['image'] = IMAGESERVER."fixsize-500x333/upload/cms_content/".$content['id']."/".$content['image'];
                    $content['createdat'] = $this->date->formatMySQLDate($content['createdat']);
                    $content['link'] = $this->request->createLink($sitemap['sitemapid'],$content['id'].'-'.$this->string->clean($this->string->utf8convert($content['title'])));
                }
                //$this->data['news'] = $listItem->renderList();
                $this->setData('contents',$contents);
                $this->setData('pagination',$result['pagination']);
                $this->setData('linkpage',$this->request->createLink($sitemap['sitemapid']));
                $this->setTemplate('News.tpl');
            }

        }
        $newpost = $this->loadNewPost($sitemap);
        $this->setData('newpost',$this->section->loadViewPage('ListItem/newpost.tpl',['newpost' => $newpost]));
        $this->setLayout('default.tpl');
        return $this->render();
    }
    private function loadNewPost($sitemap){
        $result = $this->content->getGetList('&sortcol=createdat&sorttype=desc&paging=true&limit=5&page=1');
        $newpost = array();
        if($result['statuscode']){
            $news = $result['data'];
            foreach ($news as $content){
                $item['title'] = $content['title'];
                $item['summary'] = $this->string->getTextLength($content['summary'],0,15);
                $item['image'] = IMAGESERVER."fixsize-370x265/upload/cms_content/".$content['id']."/".$content['image'];
                $item['createdat'] = $this->date->formatMySQLDate($content['createdat']);
                $item['link'] = $this->request->createLink($sitemap['sitemapid'],$content['id'].'-'.$this->string->clean($this->string->utf8convert($content['title'])));
                $newpost[] = $item;
            }
        }
        return $newpost;
    }
}