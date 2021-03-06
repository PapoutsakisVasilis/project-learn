<?php

/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/10/2018
 * Time: 7:12 PM
 */
final class Sessions
{
    private static $status = false;
    public static function init()
    {
        if (!Sessions::$status)
        {
            Sessions::$status = true;
            session_start();
        }

    }

    public function sessioner()
    {
        return $this;
    }

    public static function destroy($key)
    {
        unset($_SESSION["$key"]);
    }

}

function session($key,$flagWill = false)
{
    $temp = null;
    if (isset($_SESSION["$key"]))
    {
        $temp = $_SESSION["$key"];
        if ($flagWill){
            Sessions::destroy($key);
        }

    }
    return $temp;
}

function sessionFlag($key)
{
    if (isset($_SESSION["$key"]))
    {
        return true;
    }else{ return false;}
}

function sessionDestroy($key)
{
    Sessions::destroy($key);
}

function session_set($sessionVals)
{
    if (is_array($sessionVals))
    {
        foreach ($sessionVals as $keySess => $valSess){
            $_SESSION["$keySess"] = $valSess;
        }
    }elseif (is_object($sessionVals)){
        //todo properties to session
        $allProps = get_object_vars($sessionVals);
        foreach ($allProps as $propK => $propV){
            $_SESSION["$propK"] = $propV;
        }
    }
}