<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/10/2018
 * Time: 9:48 PM
 */

namespace Models;


class Model
{
    public static $table;
    public static $modelName;

    public function save()
    {
        $modelProps = get_object_vars($this);

        $db = new \DB();
        $db->connection('localhost', 'dbprojectlearn', 'root', '');
        $insertQuery = '';
        //todo--------

    }

    public static function all()
    {

        $table = Model::$table;

        $db = new \DB();
        $db->connection('localhost', 'dbprojectlearn', 'root', '');
        $query = 'SELECT * FROM '.$table;
        $data = $db->rawQuery($query, 'select', Model::$modelName);
        //$modelProps = get_object_vars(Model::class);

        return $data;
    }



}