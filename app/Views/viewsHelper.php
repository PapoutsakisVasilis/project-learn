<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/8/2018
 * Time: 10:47 PM
 */

function viewHead($head,$type)
{

    if(file_exists(__DIR__."/Head/"."$head".".json")){
        // Read JSON file
        $json = file_get_contents(__DIR__."/Head/"."$head".".json");

        //Decode JSON
        $json_data = json_decode($json);

        $mainR = '';
        switch ($type)
        {
            case 'css':
                foreach ($json_data as $data)
                {
                    if($data->type == 'css'){
                        $mainR .= '<link rel="stylesheet" type="text/css" href="'."/project-learn/public/assets/css/".$data->name.'.css">'.PHP_EOL;
                    }
                }
                break;
            case 'js':
                foreach ($json_data as $data)
                {

                    if($data->type == 'js'){
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