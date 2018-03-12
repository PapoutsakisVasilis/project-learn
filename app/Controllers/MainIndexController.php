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
        $go = " 2018";
        return view("indexPage.php", compact('base', 'go'));
    }

    public function indexPost($request)
    {
        $base = 'hello World !!!';
        $go = "2018";
        if (isset($request) && isset($request->greets)){
            $base = $request->greets;
        }

        return redirect()->to('public/')->with(['status' => $base])->send();
    }

    public function callDB()
    {

        $db = new DB();
        $db->connection('localhost', 'dbprojectlearn', 'root', '');
        $data = $db->table('users')
            ->select()
            ->where('id','>','0')
            ->get();

        //$da = new \Models\User();
        /*$data = $da::all();
        return var_dump($data[0]->getProps());*/
        /*$da->username = 'some';
        $da->user_nick_name = 'one';
        $da->pass = 'go';
        $da->val = 2;
        $da->save();*/
        /*$da = new \Models\User();
        $da->find(1);

        $da->val = 1;
        $res = $da->save();

        return var_dump($res);*/

        $da = new \Models\User();
        $results = $da->select_where('user_nick_name','=','Freedom');
        return var_dump($results);

        $postReq = new Request();
        $result = $postReq->create('http://localhost/project-learn/public/valcheck')
            ->type()
            ->method('POST')
            ->headers("Content-type: application/x-www-form-urlencoded")
            ->content(['valMain' => 'some_val'])
            ->commit();
        $base = ($result != false)? $result : 'oops';
        return redirect()->to('public/')->with(['status' => $base])->send();
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