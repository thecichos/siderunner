<?php

use Siderunner\SiderunnerImplentation\WriteToThousand;

error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', 'error.log');

include_once preg_replace('/(\/var\/www\/)(.*)/', '$1', __DIR__)."vendor/autoload.php";

$obj = new WriteToThousand();

$obj->run();