<?php

/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/2/2018
 * Time: 1:49 AM
 */
final class Redirections
{
    public static $path = '';
    public function to($path)
    {
        $this::$path = $path;
        return $this;
    }

    public function back()
    {

    }

    public function with($array)
    {

        foreach ($array as $key => $value)
        {
            $_SESSION["$key"] = $value;
        }
        return $this;

    }

    public function send()
    {
        header("Location: http://localhost/project-learn/".$this::$path);
        return $this;
    }


}

function redirect()
{
    $red = new Redirections();
    return $red;
}


