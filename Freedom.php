<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/2/2018
 * Time: 2:26 AM
 */

if (defined('STDIN')) {
    $action = $argv[1];
    $actionParam = $argv[2];
} else {
    return;
}

switch ($action)
{
    case "make::view":

        if (!isset($actionParam)){echo("View Without Name..."); return;}

        echo("$actionParam");
        if (file_exists("app/Views/".$actionParam.'.php')){echo(" File Already Exists..."); return;}
        $myfile = fopen("app/Views/$actionParam.php", "w") or die("Unable to open file!");
        $txt = '<?php include "viewsHelper.php"?>'.PHP_EOL;
        $txt .= "<html> \n";
        $txt .= "<head> \n";
        $txt .= '<?php viewHead("app","css"); ?>'.PHP_EOL;
        $txt .= "</head> \n";
        $txt .= "<body> \n";
        $txt .= "\n";
        $txt .= "\n";
        $txt .= '<?php viewHead("app","js"); ?>'."\n";
        $txt .= "</body> \n";
        $txt .= "</html> \n";
        fwrite($myfile, $txt);
        fclose($myfile);
        echo("View File Was Created");
        break;


    default:
        echo("||||||---------- Freedom Creations ------------||||||| ".PHP_EOL);
        echo(PHP_EOL);
        echo(PHP_EOL);

        echo("--Create-- make::view nameOfView  Located At App Views".PHP_EOL);
        //todo generation of appKey --echo exec('whoami'); --hint

        break;

}