<?php
include_once 'constants.php';
include_once 'debug.php';

spl_autoload_register('autoloader');

function autoloader($path) {
    $file = SRC . preg_replace('/\\\\/','/', $path) . '.php';

    if(file_exists($file)) {
        include_once $file;
    }
}

$GLOBALS['response'] = $response = new \Helper\Response();
$GLOBALS['request'] = $request = new \Helper\Request();
