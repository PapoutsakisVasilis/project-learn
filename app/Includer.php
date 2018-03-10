<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/1/2018
 * Time: 8:24 PM
 */



foreach (glob($_SERVER['DOCUMENT_ROOT']."/project-learn/app/Controllers/*.php") as $filename)
{
    include $filename;
}


//require "Controllers/*.php";