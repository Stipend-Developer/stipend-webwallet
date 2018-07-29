<?php
//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
//error_reporting(-1);

session_start();
header('Cache-control: private'); // IE 6 FIX

define("WITHDRAWALS_ENABLED", true); //Disable withdrawals during maintenance

include('jsonRPCClient.php');
include('classes/Client.php');
include('classes/User.php');

// function by zelles to modify the number to bitcoin format ex. 0.00120000
function satoshitize($satoshitize) {
   return sprintf("%.8f", $satoshitize);
}

// function by zelles to trim trailing zeroes and decimal if need
function satoshitrim($satoshitrim) {
   return rtrim(rtrim($satoshitrim, "0"), ".");
}

require('settings.php');

if(isSet($_GET['lang'])) {
    $lang = $_GET['lang'];
    // register the session and set the cookie
    $_SESSION['lang'] = $lang;
    setcookie('lang', $lang, time() + (3600 * 24 * 30));
} else if(isSet($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else if(isSet($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = 'en';
}

switch ($lang) {
  case 'en':
  $lang_file = 'lang.en.php';
  break;

  default:
  $lang_file = 'lang.en.php';
}

include_once 'languages/'.$lang_file;

?>
