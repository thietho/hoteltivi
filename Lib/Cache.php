<?php

namespace Lib;
class Cache
{
    private $dir = 'cache/';
    private $expire = 60*60*24;

    public function __construct()
    {

    }

    public function create($filename, $content)
    {
        if (!is_dir($this->dir)) {
            mkdir($this->dir);
            chmod($this->dir, 0777);
        }
        return file_put_contents($this->dir . $filename, $content);
    }
    public function check($filename)
    {
        if (file_exists($this->dir . $filename)) {
            return true;
        } else {
            return false;
        }
    }
    public function getPath($filename){
        if($this->check($filename)){
            return $this->dir.$filename;
        }else{
            return '';
        }
    }
    public function get($filename)
    {
        if (file_exists($this->dir . $filename)) {
            return file_get_contents($this->dir . $filename);
        } else {
            return '';
        }
    }

    public function delete($filename)
    {
        if(file_exists($filename)){
            unlink($filename);
        }

    }

    public function clear()
    {
        $files = glob($this->dir . '*.*');
        if ($files) {
            foreach ($files as $file) {
                unlink($file);
            }
        }
    }

    public function clearView()
    {
        $files = glob($this->dir . '*.tpl');
        if ($files) {
            foreach ($files as $file) {
                unlink($file);
            }
        }
    }

    public function clearClass($classname){
        $files = glob($this->dir .$classname. '*');
        if ($files) {
            foreach ($files as $file) {
                unlink($file);
            }
        }
    }


}