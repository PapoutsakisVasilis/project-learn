<?php
use app\Routes\Route;

Route::get("project-learn/public/","MainIndexController","index");
Route::post("project-learn/public/","MainIndexController","indexPost");
Route::get("project-learn/public/db/","MainIndexController","callDB");
Route::post("project-learn/public/valcheck","MainIndexController","valueCheckTest");