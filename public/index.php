<?php


// Load Config
require_once '../app/config/config.php';
// Helper
require_once '../app/helpers/helper.php';


// Load Libraries
spl_autoload_register(function($className){
  require_once APPROOT.'/libraries/'. $className .'.php';
});


$core = new Core;



