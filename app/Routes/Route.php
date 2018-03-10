<?php

/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 2/28/2018
 * Time: 9:34 PM
 */
namespace app\Routes {

    include_once "web.php";

    $auto = new \Autoload();
    $auto->loadControllers();

    final class Route
    {
        static $postRules = array();
        static $getRules = array();
        static $apiPostRules = array();

        public static function Instance()
        {
            static $inst = null;
            if ($inst === null) {
                $inst = new Route();
            }
            return $inst;
        }

        public static function get($path, $controller, $action)
        {
            $getRule = new \stdClass();
            $getRule->path = $path;
            $getRule->controller = $controller;
            $getRule->action = $action;
            array_push(Route::$getRules, $getRule);
        }

        public static function post($path, $controller, $action)
        {

            $postRule = new \stdClass();
            $postRule->path = $path;
            $postRule->controller = $controller;
            $postRule->action = $action;
            array_push(Route::$postRules, $postRule);

        }

        public static function postAPI()
        {

        }

        public static function checkTheURI($uri, $params)
        {
            switch ($params)
            {
                case "GET":

                    foreach (Route::$getRules as $rule){
                        if(strcmp($rule->path, $uri) == 0) {
                            $controlName = $rule->controller;
                            $controller = new $controlName();
                            $method = $rule->action;
                            return $controller->$method();
                        }
                    }
                    return require ($_SERVER['DOCUMENT_ROOT']."/project-learn/app/Views/DefaultPages/ErrorPage.php");
                    break;

                case "POST":
                    //TODO CHECK
                    foreach (Route::$postRules as $rule){
                        if(strcmp($rule->path, $uri) == 0){
                            $controlName = $rule->controller;
                            $controller = new $controlName();
                            $method = $rule->action;
                            if (isset($_POST) && count($_POST) > 0)
                            {
                                $request = (object)$_POST;
                                unset($_POST);
                            }else{$request = false;}
                            return $controller->$method($request);
                        }


                    }
                    return require ($_SERVER['DOCUMENT_ROOT']."/project-learn/app/Views/DefaultPages/ErrorPage.php");
                    break;
            }

        }

        public function checkTheUriPost()
        {

        }

        private function __construct()
        {

        }
    }
}