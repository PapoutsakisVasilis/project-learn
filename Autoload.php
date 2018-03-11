<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/1/2018
 * Time: 7:35 PM
 */

Class Autoload
{
    public function load()
    {
        return require "app/Routes/Route.php";
    }

    public function loadControllers()
    {
        foreach (glob($_SERVER['DOCUMENT_ROOT']."/project-learn/app/Controllers/*.php") as $filename)
        {
            include $filename;

        }
    }

    public function loadRoutes()
    {

    }

    public function loadViewHandler()
    {
        return require "viewFunctionHelp.php";
    }

    public function loadViewFiles()
    {
        foreach (glob($_SERVER['DOCUMENT_ROOT']."/project-learn/app/Views/*.php") as $filename)
        {
           include_once $filename;
        }
    }

    public function loadRedirections()
    {
        return require "app/Services/Redirections.php";
    }

    public function loadSessions()
    {
        return require "app/Services/Sessions.php";
    }

    public function loadDB()
    {
        return require "app/Services/DB.php";
    }

    public function loadModels()
    {
        foreach (glob($_SERVER['DOCUMENT_ROOT']."/project-learn/app/Models/*.php") as $filename)
        {
            include_once $filename;
        }
    }

    public function loadRequests()
    {
        return require "app/Services/Request.php";
    }



}

