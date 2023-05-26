<?php
require_once("../model/user.model.php");
require_once("../include/auth/Hash.php");
require_once("../include/logs/log.php");
require_once("../include/validation/validation.php");

$validation = new Validation;
$log = new Log;

class UserView extends UserModel {

    public $pathLog = "../../log.log";

    public function __construct(Hash $hash, Log $log )
    {
        $this->hash = $hash;
        $this->log = $log;
    }

    public function loginAccounts(){
        return $this->loginAccount();
    }

}

$actionKey = $_POST['action-key'];
$key = array("2e8b348babede40bb697381a22d01f07");

if(!empty($actionKey) && in_array($actionKey, $key)){

    $view = new UserView(new Hash , new Log);

    switch($actionKey){
        case "2e8b348babede40bb697381a22d01f07":{

            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!empty($email)){
                if(!empty($_POST['password'])){
                    if($validation->email($email)!= false){
                        if(strlen($password) >= 8){
                            $view->setEmail($email);
                            $view->setPassword($password);
                            echo $view->loginAccounts();
                        }
                        else{
                            echo json_encode(array("status"=>false, "error"=>"password", "message"=>"Password must be atleast 8 charaters."));
                        }
                    }
                    else{
                        echo json_encode(array("status"=>false, "error"=>"email" , "message"=>"Please input valid email address." ));
                    }
                }
                else{
                    echo json_encode(array("status"=>false, "error"=>"password" , "message"=>"This field is required." ));
                }
            }
            else{
                echo json_encode(array("status"=>false, "error"=>"email" , "message"=>"This field is required." ));
            } 

            break;

        }
        default: {
            $log->saveLog($view->pathLog, "Action-key not found!");
            die("action key not found");
        }
    }
}
else{
    $log->saveLog($view->pathLog, "Action-key not found!");
    die("action key not found");
}





?>