<?php

/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/1/2018
 * Time: 9:36 PM
 */
namespace app;



class ViewHandler
{

    public static function make($file,$var = false)
    {

        if(file_exists(__DIR__."/Views/"."$file")){
            if($var != false && count($var) > 0){
                foreach ($var as $key => $value)
                {
                    ${"$key"} = $value;
                }
            }


            return require (__DIR__."/Views/"."$file");
        }else{
            return require (__DIR__."/Views/DefaultPages/ErrorPage.php");
        }

    }

    public function with()
    {
        echo"go";
    }

}

