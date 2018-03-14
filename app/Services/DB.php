<?php

/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/10/2018
 * Time: 8:07 PM
 */
class DB
{

    private  $table;
    private  $queries = [];
    private  $selectFields = [];
    private  $connectionRecs;


    public function table($tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    public function where($col, $logic, $val)
    {

        array_push($this->queries, "$col $logic $val");

        return $this;
    }

    public function select($arrayOfFields = '*')
    {
        if ($arrayOfFields == '*'){
            array_push($this->selectFields, $arrayOfFields);
        }else{
            foreach ($arrayOfFields as $field)
            {
                array_push($this->selectFields, $field);
            }
        }

        return $this;
    }

    public function get($byModel = false)
    {
        $query = 'SELECT';
        if (count($this->selectFields)>0)
        {
            foreach ($this->selectFields as $selectField){
                $query .= ' '.$selectField.' ';
            }
        }else{
            $query .= ' * ';
        }

        $query .= "FROM ".$this->table.' ';

        if (isset($this->queries) && count($this->queries)>0)
        {
            $count = 0;
            foreach ($this->queries as $que)
            {
                if ($count == 0){
                    $count++;
                    $query .= "WHERE " . $que . ' ';
                }else{
                    $query .=  'AND '.$que.' ';
                }

            }
        }

        $connectObj = $this->connectionRecs;
        $servername = "$connectObj->conn_path";
        $username = "$connectObj->username";
        $password = "$connectObj->pass";
        $dbname = "$connectObj->dbaname";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($byModel === true){
            return "$query";
        }
        $sql = "$query";
        $result = $conn->query($sql);


        $data = array();

        while ($temp = $result->fetch_object()){
            array_push($data, $temp);
        }

        $conn->close();
        return $data;
    }

    public function connection($con_path, $dbname, $username, $pass)
    {
        $connectObj = new stdClass();
        $connectObj->conn_path = $con_path;
        $connectObj->dbaname = $dbname;
        $connectObj->username = $username;
        $connectObj->pass = $pass;
        $this->connectionRecs = $connectObj;
        return $this;
    }

    public function rawQuery($string,$type, $classType = 'stdClass')
    {
        $connectObj = $this->connectionRecs;
        $servername = "$connectObj->conn_path";
        $username = "$connectObj->username";
        $password = "$connectObj->pass";
        $dbname = "$connectObj->dbaname";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if (strcmp($type, 'select') == 0){
            $sql = "$string";
            $result = $conn->query($sql);
            $data = array();
            while ($temp = mysqli_fetch_object($result, $classType)){
                array_push($data, $temp);
            }
            $conn->close();
        }elseif (strcmp($type, 'insert') == 0 || strcmp($type, 'update') == 0){
            $sql = "$string";
            $result = $conn->query($sql);
            $result = ($result != false && strcmp($type, 'update') != 0) ?  $conn->insert_id : $result;
            $result = ($result != false && strcmp($type, 'update') == 0) ?  $conn->affected_rows : $result;
            $conn->close();
            $data = $result;
        }else{
            //TODO delete
            $data = false;
        }
        return $data;
    }


}
<<<<<<< HEAD

function jsonFieldsDB($column, $obj)
{
    $result = $column.'->"$.'.$obj.'"';
    return $result;
}
=======
>>>>>>> 8b481de505237e285d4b14d56745a06d6f0fed61
