<?php

require CONTROL."Banner.php";
require CONTROL."Product.php";
require CONTROL."Testimonial.php";
class HomePage extends Page
{
    public function index()
    {
        $sitemaps = $this->sitemap->getChilds(50);
        $this->setData('sitemaps',json_encode($sitemaps));


        $this->setTemplate('HomePage.tpl');
        $this->setLayout('default.tpl');
        return $this->render();
    }
    private function loadNewPost(){
        $result = $this->content->getGetList('&sortcol=createdat&sorttype=desc&paging=true&limit=6&page=1');
        $newpost = array();
        if($result['statuscode']){
            $news = $result['data'];
            foreach ($news as $content){
                $item['title'] = $content['title'];
                $item['summary'] = $this->string->getTextLength($content['summary'],0,15);
                $item['image'] = IMAGESERVER."fixsize-370x265/upload/cms_content/".$content['id']."/".$content['image'];
                $item['createdat'] = $this->date->formatMySQLDate($content['createdat']);
                $item['link'] = $this->request->createLink('News',$content['id'].'-'.$this->string->clean($this->string->utf8convert($content['title'])));
                $newpost[] = $item;
            }
        }
        return $newpost;
    }
}