<?php
/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/10/2018
 * Time: 10:14 PM
 */

namespace Models;


class User extends Model
{
    public static $table = 'users';
    public $id;
    public $username;
    public $pass;
    public $user_nick_name;



    public function __construct()
    {
        parent::$table = self::$table;
        parent::$modelName = self::class;
        return $this;
    }

    public function getProps(){
        return get_object_vars($this);
    }


}