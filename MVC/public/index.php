<?php 


require_once '../core/config.php';

require_once '../vendor/autoload.php';
require_once '../core/Router.php';
$app = new Core\App();
$app->resolve();
// echo __DIR__;

// echo $_GET['url'];
// echo $_SERVER['REQUEST_URI'];
