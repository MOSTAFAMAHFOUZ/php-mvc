<?php
session_start();

require_once '../core/App.php';
require_once '../core/Auth.php';
require_once '../core/Router.php';
require_once '../core/DB.php';
require_once '../core/Request.php';
require_once '../core/Response.php';
require_once '../core/Session.php';
require_once '../core/Str.php';
require_once '../core/Validation.php';
require_once '../core/View.php';




define('BASE_PATH',dirname(__DIR__));


// connection 
define('DB_SERVER_NAME','localhost');
define('DB_USER_NAME','root');
define('DB_PASSWORD','');
define('DB_DATABASE_NAME','mvc');