<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/8/2018
 * Time: 10:47 PM
 */

function viewLib($head,$type,$position = 'default')
{

    if(file_exists(__DIR__ . "/Head/" .$head.".json")){
        // Read JSON file
        $json = file_get_contents(__DIR__ . "/Head/" .$head.".json");

        //Decode JSON
        $json_data = json_decode($json);

        $mainR = '';
        $flag = (strcmp($position, 'default')==0) ? false : true;

        switch ($type)
        {
            case 'css':
                foreach ($json_data as $data)
                {

                    if(($data->type == 'css' && !$flag) || ($data->type == 'css' && $flag && strcmp($data->position, $position) == 0 )){
                        $mainR .= '<link rel="stylesheet" type="text/css" href="'."/project-learn/public/assets/css/".$data->name.'.css">'.PHP_EOL;
                    }
                }
                break;
            case 'js':
                foreach ($json_data as $data)
                {

                    if(($data->type == 'js' && !$flag) || ($data->type == 'js' && $flag && strcmp($data->position, $position) == 0 )){
                        $mainR .= '<script type='.'"text/javascript"'. ' src='.'"'.''."/project-learn/public/assets/js/".$data->name.'.js"></script>'.PHP_EOL;
                    }
                }
                break;
        }

        return ec($mainR);
    }else{return false;}
}

function ec($string)
{
    $g = printf($string);
    return $g;
}