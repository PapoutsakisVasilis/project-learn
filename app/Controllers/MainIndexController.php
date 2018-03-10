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


        return var_dump($data[0]->getProps());



        //return redirect()->to('public/')->with(['status' => $base])->send();//view("indexPage.php", compact('base', 'go'));
    }

}