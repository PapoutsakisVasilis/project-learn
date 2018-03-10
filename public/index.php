<?php
use app\Routes\Route;

include "../Autoload.php";
$auto = new \Autoload();
$auto->load();
$auto->loadSessions();

$url = $_SERVER['REQUEST_URI']; //returns the current URL
Sessions::init();
$parts = explode('/',$url);
$dir = "";
$counter = count($parts);
$count = 0;
foreach ($parts as $part) {
    $count++;
    $final = ($count == $counter || $count == 1)? "" :"/";

    $dir .= $part . $final ;
}
//echo $dir;
return Route::checkTheURI($dir, $_SERVER['REQUEST_METHOD']);
