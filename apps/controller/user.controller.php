<?php
require_once("../model/user.model.php");
require_once("../include/logs/log.php");
require_once("../include/validation/validation.php");
require_once("../include/auth/Hash.php");


$log = new Log;
$validation = new Validation;
$callFunction = "loginAccounts";



class User extends UserModel{

    public $pathLog =  "../../log.log";

    public function __construct(Log $log, Hash $hash)
    {
        $this->log = $log;
        $this->hash = $hash;
    }

    public function loginAccounts(){
        return $this->loginAccount();
    }

    public function createAccounts(){
        return "success createAccounts here";
    }
}

?>