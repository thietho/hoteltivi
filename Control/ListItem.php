<?php
namespace Lib;
class ListItem extends Control
{
    public $items = array();
    public $column = 3;

    public function renderGrird(){
        $gird = '<div class="row">';
        foreach ($this->items as $item){
            $gird .= '<div class="text-center col-lg-'.(12/$this->column).'"><img class="rounded-circle" src="'.IMAGESERVER.'autosize-140x140/'.$item['image'].'" title="'.$item['title'].'" alt="'.$item['title'].'" width="140" height="140">
                <h2>'.$item['title'].'</h2>
                <p>'.$item['summary'].'</p>
                <p><a class="btn btn-secondary" href="'.$item['link'].'" role="button">View details »</a></p></div>';
        }
        $gird .= '</div>';
        return $gird;
    }
    public function renderGrirdProduct(){
        $gird = '<div class="row">';
        foreach ($this->items as $item){
            $gird .= '<div class="text-center col-lg-'.(12/$this->column).'"><img src="'.IMAGESERVER.'autosize-300x300/'.$item['image'].'" title="'.$item['title'].'" alt="'.$item['title'].'" height="300">
                <h2>'.$item['title'].'</h2>
                <p>'.$item['price'].'</p>
                <p><a class="btn btn-secondary" href="'.$item['link'].'" role="button">View details »</a></p></div>';
        }
        $gird .= '</div>';
        return $gird;
    }
    public function renderList(){
        $content = $this->render('ListItem/List.tpl');
        return $content;
    }
}