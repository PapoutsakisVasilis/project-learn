# project-learn


-----------------------------------------------------------------------
Freedom.php is made as View files Generator For now.

cmd execute php Freedom.php --description of commands will be given.

Routing System
------------------------------------------------------------------------
path: app/Routes/web.php

Declare the routes that you want to use and difine the method. <br>
example: 
---------------------------------------------------------------------------
          Route::get("project-learn/public/","MainIndexController","index");
            |     |             |                      |              | 
          Route method        path                 Controller   action-method

Controllers Example:
---------------------
    public function index()
    {
        $base = 'hello World !!!';
        $go = " 2018";
        return view("indexPage.php", compact('base', 'go'));
    }

At this example the index action at the MainIndexController will, <br>
return a view with the variables $base, $go available to the view file.

Controllers Example -2-:
-------------------------
    public function indexPost($request)
    {
        $base = 'hello World !!!';
        $go = "2018 ";
        if (isset($request) && isset($request->greets)){
            $base = $request->greets;
        }
        return redirect()->to('public/')->with(['status' => $base])->send();
    }
    
At this example the indexPost action at the MainIndexController will, <br>
redirect to public/ and at the session will be available the status -key with the value of $base var.   


Controllers And DB functionality Example -3-:
---------------------------
    public function callDB()
    {

        $db = new DB();
        $db->connection('localhost', 'dbprojectlearn', 'root', '');
        $data = $db->table('users')
            ->select()
            ->where('id','=','1')
            ->get();
        return redirect()->to('public/')->with(['status' => $data])->send();
    }

At this example the callDB action at the MainIndexController will, <br>
redirect to public/ and at the session will be available the status -key with the value of $data var, <b>
that haves all the retrieved records from the database at the table users that the id equals to 1.
