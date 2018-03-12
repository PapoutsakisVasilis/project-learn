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
        if (!isset($this->id) || $this->id == null)
        {
            $modelProps = get_object_vars($this);

            $db = new \DB();
            $db->connection('localhost', 'dbprojectlearn', 'root', '');
            $insertQuery = '';
            $collumns = '';
            $values = '';
            $count = 0;
            foreach ($modelProps as $propK => $propV){
                if ($count == 0){
                    $count++;
                    $insertQuery .= 'INSERT INTO '.self::$table.' ';
                }
                if (strcmp($propK, 'id') != 0){
                    $collumns .= "$propK, ";
                    $values .= "'".$propV."', ";
                }


            }
            $insertQuery = $insertQuery.'('.substr($collumns, 0, -2).') VALUES ('.substr($values, 0, -2).');';
            $db = new \DB();
            $db->connection('localhost', 'dbprojectlearn', 'root', '');
            $data = $db->rawQuery($insertQuery, 'insert', Model::$modelName);
            if ($data!=false){
                $this->id = $data;
                return $this;
            }else{
                return $data;
            }
        }elseif (isset($this->id) && $this->id != null){

            $modelProps = get_object_vars($this);

            $db = new \DB();
            $db->connection('localhost', 'dbprojectlearn', 'root', '');
            $updateQuery = '';

            $count = 0;
            foreach ($modelProps as $propK => $propV){
                if ($count == 0){
                    $count++;
                    $updateQuery .= 'UPDATE '.self::$table.' SET ';
                }
                if (strcmp($propK, 'id') != 0){
                    $updateQuery .= $propK.' = '."'".$propV."', ";
                }
            }
            $updateQuery = substr($updateQuery, 0, -2).' WHERE id = '.$this->id.';';
            $db = new \DB();
            $db->connection('localhost', 'dbprojectlearn', 'root', '');
            $data = $db->rawQuery($updateQuery, 'update', Model::$modelName);

            return $data;
        }

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

    public function find($id)
    {
        $table = Model::$table;
        $db = new \DB();
        $db->connection('localhost', 'dbprojectlearn', 'root', '');
        $query = 'SELECT * FROM '.$table.' WHERE id = '."'".$id."'".';';
        $data = $db->rawQuery($query, 'select', Model::$modelName);
        //return $data;
        if (isset($data[0]->id)){
            $objFDB = $data[0];
            $modelProps = get_object_vars($this);
            foreach ($modelProps as $propK => $propV){
                $this->$propK = $objFDB->$propK;
            }
            return $this;
        }else{
            return false;
        }
    }

    public function select_where($col, $logic, $val)
    {
        $db = new \DB();
        $db->connection('localhost', 'dbprojectlearn', 'root', '');
        $db->table(strval(self::$table));
        $db->where($col, $logic, "'".$val."'");
        $query = $db->get(true);
        $data = $db->rawQuery($query, 'select', Model::$modelName);
        if (isset($data[0])){
            return $data;
        }else{return false;}

    }



}