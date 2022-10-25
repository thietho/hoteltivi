<?php
// define('HTTPSERVER','http://localhost/HLFramework/WebSite/');
// define('CONTROLVIEW','Control/View/');
// define('IMAGESERVER','http://localhost/HLFramework/CoreSystem/FileServer/images/');
// define('CORESYSTEM','http://localhost/HLFramework/CoreSystem/');
if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('HTTPSERVER','http://localhost/hoteltivi/');
}else{
    define('HTTPSERVER','http://tivi.cntech.com.vn/');
}

define('CONTROLVIEW','Control/View/');
define('CONTROL','Control/');
define('IMAGESERVER','https://admin.sunsetsanato.com/FileServer/images/');
define('FILESERVER','https://admin.sunsetsanato.com/FileServer/file/');
define('CORESYSTEM','https://admin.sunsetsanato.com/');

define('JS',HTTPSERVER.'scripts/');
define('CSS',HTTPSERVER.'css/');
define('FONTS',HTTPSERVER.'fonts/');
define('IMAGES',HTTPSERVER.'img/');
define('UI',HTTPSERVER.'UI/');
$files = glob( 'Lib/*.php');
foreach ($files as $file) {
    require($file);
}
define('TICKETPRICEIS',1);
require CONTROL.'Section.php';
require CONTROL.'Content.php';
require CONTROL.'Sitemap.php';
require CONTROL.'Setting.php';
require CONTROL.'OptionSet.php';
require CONTROL.'Label.php';

define('DIHOTELENPOIN','http://115.79.241.38:8123/');
define('SMILEENPOIN','http://115.79.241.38:8089/');