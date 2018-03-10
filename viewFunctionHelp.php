<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/8/2018
 * Time: 10:18 PM
 */
include "app\ViewHandler.php";


function view($file, $val = false)
{
    $viewHundler = new \app\ViewHandler();
    return $viewHundler::make($file, $val);
}
