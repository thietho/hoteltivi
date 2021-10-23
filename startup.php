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
define('IMAGESERVER','http://coresystem.cntech.com.vn/FileServer/images/');
define('FILESERVER','http://coresystem.cntech.com.vn/FileServer/file/');
define('CORESYSTEM','http://coresystem.cntech.com.vn/');

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