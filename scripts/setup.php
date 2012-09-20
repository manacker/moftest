<?php

require_once __DIR__ . "/../vendor/autoload.php";

define('XMBC_USER_DIR',  realpath(__DIR__.'/../scraper2/'));
define('THUMBNAIL_PATH',  '/scraper2/Thumbnails');

use \Zend\ServiceManager;


$moviedb = new Zend\Db\Adapter\Adapter(array(
    'driver' => 'Pdo_Sqlite',
    'database' => XMBC_USER_DIR . '/Database/MyVideos67.db'
));
$texturedb = new Zend\Db\Adapter\Adapter(array(
    'driver' => 'Pdo_Sqlite',
    'database' => XMBC_USER_DIR.'/Database/Textures13.db'
));

