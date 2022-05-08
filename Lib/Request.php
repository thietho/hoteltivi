<?php

namespace Lib;
class Request
{
    private $dataGet;
    private $dataPost;
    public $method;
    public $lang = 'vn';
    public $listlang = array(
        'vn' => 'Vietnamese',
        'en' => 'English',
        'zh' => 'Chinese',
        'ru' => 'Russian');
    public $listlangicon = array(
        'vn' => 'flag-icon-vn',
        'en' => 'flag-icon-gb-eng',
        'zh' => 'flag-icon-cn',
        'ru' => 'flag-icon-ru',
    );

    public function __construct()
    {
        if (!empty($_GET)) {
            $this->dataGet = $_GET;
        }
        if (isset($this->dataGet['sitemapid'])) {
            $arr = explode('/', $this->dataGet['sitemapid']);
            $this->dataGet['sitemapid'] = $arr[0];
            $this->dataGet['id'] = isset($arr[1]) ? $arr[1] : '';
        }
        if (!empty($_POST)) {
            $this->dataPost = $_POST;
        } else {
            $this->dataPost = json_decode(file_get_contents('php://input'), true);
        }
        if (!empty($this->dataGet)) {
            foreach ($this->dataGet as &$val) {
                if (!is_array($val)) {
                    $val = trim($val);
                }
            }
        }
        if (!empty($this->dataPost)) {
            foreach ($this->dataPost as &$val) {
                if (!is_array($val)) {
                    $val = trim($val);
                }

            }
        }
        $this->method = $_SERVER['REQUEST_METHOD'];

    }

    /**
     * @return mixed
     */
    public function get($key)
    {
        if (isset($this->dataGet[$key]))
            return $this->dataGet[$key];
        else {
            return '';
        }
    }

    /**
     * @return mixed
     */
    public function post($key)
    {
        if (isset($this->dataPost[$key]))
            return $this->dataPost[$key];
        else {
            return '';
        }
    }

    /**
     * @return array
     */
    public function getDataPost()
    {
        return $this->dataPost;
    }

    /**
     * @return array
     */
    public function getDataGet()
    {
        return $this->dataGet;
    }

    public function getQueryString()
    {
        return urldecode(http_build_query($this->dataGet));
    }

    public function translate($key)
    {
        $lang = $this->get('lang') == '' ? $this->lang : $this->get('lang');
        return $lang == $this->lang ? $key : $key . '_' . $lang;
    }

    public function getLang()
    {
        $lang = $this->get('lang');
        return $lang != '' ? $lang : $this->lang;
    }

    public function createLink($sitemapid = '', $id = '')
    {
        $lang = $this->get('lang');
        $link = HTTPSERVER . ($lang != '' ? $lang : $this->lang) . '/';
        if ($sitemapid == '') {
            return $link;
        }
        if ($id == '') {
            if ($sitemapid == 'Home') {
                return $link;
            } else {
                return $link . "$sitemapid.html";
            }

        }
        return $link . "$sitemapid/$id.html";
    }

    public function createLinkLang($lang)
    {
        $link = HTTPSERVER . ($lang != '' ? $lang : $this->lang) . '/';
        $sitemapid = $this->get('sitemapid');
        $id = $this->get('id');
        if ($sitemapid == '') {
            return $link;
        }
        if ($id == '') {
            if ($sitemapid == 'Home') {
                return $link;
            } else {
                return $link . "$sitemapid.html";
            }

        }
        return $link . "$sitemapid/$id.html";
    }

    public function getCurentLink()
    {
        $link = HTTPSERVER . substr($_SERVER['REQUEST_URI'], 1);
        return $link;
    }
}