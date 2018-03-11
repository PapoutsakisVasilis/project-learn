<?php

/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/1/2018
 * Time: 8:06 PM
 */



$auto = new Autoload();
$auto->loadViewHandler();
$auto->loadRedirections();
$auto->loadDB();
$auto->loadModels();
$auto->loadRequests();



class MainIndexController
{

    public function index()
    {
        $base = 'hello World !!!';
        $go = "2018";
        return view("indexPage.php", compact('base', 'go'));
    }

    public function indexPost($request)
    {
        $base = 'hello World !!!';
        $go = "2018";
        if (isset($request) && isset($request->greets)){
            $base = $request->greets;
        }

        return redirect()->to('public/')->with(['status' => $base])->send();//view("indexPage.php", compact('base', 'go'));
    }

    public function callDB()
    {

        $db = new DB();
        $db->connection('localhost', 'dbprojectlearn', 'root', '');
        $data = $db->table('users')
            ->select()
            ->where('id','>','0')
            ->get();

        $da = new \Models\User();
        $data = $da::all();

        $postReq = new Request();
        $result = $postReq->create('http://localhost/project-learn/public/valcheck')
            ->type()
            ->method('POST')
            ->headers("Content-type: application/x-www-form-urlencoded")
            ->content(['valMain' => 'some_val'])
            ->commit();
        $base = ($result != false)? $result : 'oops';
        return redirect()->to('public/')->with(['status' => $base])->send();//view("indexPage.php", compact('base', 'go'));
    }

    public function valueCheckTest($request)
    {
        if (isset($request->valMain)){
            return Request::response(' Hello '.$request->valMain);
        }else{
            return false;
        }
    }

}