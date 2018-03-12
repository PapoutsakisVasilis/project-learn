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


 Models
---------
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
 At this example its a basic Model. <br>
 Define the properties that the model will have, but follow the database Schema. <b>
          
 A typical store action for the model at the database is for example <br>
------------------------------------------------------------------------------------
          $userModel = new \Models\User();
          $userModel->username = 'some';
          $userModel->user_nick_name = 'one';
          $userModel->pass = 'someone';
          $userModel->save();
          echo ($userModel->id);
         
---------------------------------------------------------------------------------------
After the saving procedure the $userModel will set the "public $id;".
So the user's model id will be the record id at the table users that it was just created. 
<br>
<br>       

A typical update of model's record at the database
---------------------------------------------------------------------------------------
          $userModel = new \Models\User();
          $userModel->find(1); //retrive the record by the id 1 from users table.
          $userModel->val = 1;
          $result = $userModel->save();
---------------------------------------------------------------------------------------

After the update procedure the $userModel will be updated withe new values to the database.
So "$result" will be set with the integer of the affected rows from the update query else it will return false.
<br>
<br> 
          
          
 A typical retrieve of all records of the model from the database is for example <br>
------------------------------------------------------------------------------------
          $userModel = new \Models\User();
          $usersRecords = $userModel::all();

<br>
<br>
 TODO: extending model's functionalities
 
 
 
  Api Requests
 --------------
 Example Of A POST Request From A controller's Function:
----------------------------------------------------------
          $postReq = new Request(); //create a request instance
          $result = $postReq->create('http://localhost/project-learn/public/valcheck') //set the url
                    ->type() // http or https Default is http
                    ->method('POST') // set the Method
                    ->headers("Content-type: application/x-www-form-urlencoded") set the headers it accepts also array for more
                    ->content(['valMain' => 'some_val']) // the data to be sent
                    ->commit(); //finaly making the http request
                    
                    //the data that will return its a PHP variable ready to be used example: --$result--
                    
                    
          For Example A method that accepts http request:
          
          public function valueCheckTest($request)
          {
                    if (isset($request->valMain)){
                              return Request::response(array('Hello Bill', 1, array('33')));
                    }else{
                              return false;
                    }
          }
          
          
          
          From the Controllers the responces Can be Used Like:
                    return response(array('Hello Bill', 1, array('33'))); // like a function
                  

