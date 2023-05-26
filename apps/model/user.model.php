<?php
session_start();
require("../database/connection.php");

class UserModel extends DB {

    private $email;
    private $fullname;
    private $password;
    private $role;
    private $department;

    protected $log;
    protected $hash;

    protected function loginAccount(){

        try{
            $current_time = date('Y-m-d H:i');
            $new_time = date('Y-m-d H:i', strtotime($current_time . ' +3 minutes'));
            
            $email = mysqli_real_escape_string($this->DBconnection(), $this->getEmail());
            $password = mysqli_real_escape_string($this->DBconnection(), $this->getPassword());

            $usersSQL = "SELECT users.* , attempts.* FROM users INNER JOIN attempts ON users.userID = attempts.userID WHERE  users.userEmail = '$email' ";
            $userResult = $this->DBconnection()->query($usersSQL);

            if($userResult->num_rows > 0){
                $users = $userResult->fetch_assoc();

                $attempt =  $users['attempt'];
                if($this->hash->customDehash($password ,  $users['userPassword'] )){

                    if($attempt != 0){

                        $_SESSION['fullname'] = $users['userFullname'];
                        $_SESSION['email'] = $users['userEmail'] ;
                        $_SESSION['password'] = $users['userPassword'] ;
                        $_SESSION['role'] = $users['userRole'] ;
                        $_SESSION['department'] = $users['userDepartment'] ;
                        $reset = $this->update('attempts', array("attempt"=>3),  array("userID"=>$users['userID']));
                        
                        switch($users['userRole']){
                            case 1:{
                                $output = json_encode(array("status"=>true,  "location"=>"./dean/dashboard.php"));
                                break;
                            }
                            case 2:{
                                $output = json_encode(array("status"=>true,  "location"=>"./superadmin/dashboard.php"));
                                break;
                            }
                            default:{
                                $output = json_encode(array("status"=>true,  "location"=>"./admin/dashboard.php"));
                                break;
                            }
                        }
                    }
                    else{
                        if(strtotime($current_time) >= strtotime($users['attempt_date'])){
                            $_SESSION['fullname'] = $users['userFullname'];
                            $_SESSION['email'] = $users['userEmail'] ;
                            $_SESSION['password'] = $users['userPassword'] ;
                            $_SESSION['role'] = $users['userRole'] ;
                            $_SESSION['department'] = $users['userDepartment'] ;
                            $reset = $this->update('attempts', array("attempt"=>3),  array("userID"=>$users['userID']));
                            
                            switch($users['userRole']){
                                case 1:{
                                    $output = json_encode(array("status"=>true,  "location"=>"./dean/dashboard.php"));
                                    break;
                                }
                                case 2:{
                                    $output = json_encode(array("status"=>true,  "location"=>"./superadmin/dashboard.php"));
                                    break;
                                }
                                default:{
                                    $output = json_encode(array("status"=>true,  "location"=>"./admin/dashboard.php"));
                                    break;
                                }
                            }
                        }
                        else{
                            $output = json_encode(array("status"=>false, "error"=>"global" , "message"=>"Please ty again , ".date("h:i A", strtotime($users['attempt_date']))));
                        }
                    } 
                }   
                else{
                    
                    if($attempt != 0){
                        $newValue = $attempt - 1;
                        $updateAttempt = $this->update('attempts', array("attempt"=>$newValue, "attempt_date"=>$new_time), array("userID"=>$users['userID']));
                        if($updateAttempt){
                            $output = json_encode(array("status"=>false, "error"=>"password" , "message"=>"Password not matched. $newValue attempt left"));
                        }
                    }
                    else{
                        if(strtotime($current_time) >= strtotime($users['attempt_date'])){
                            $reset = $this->update('attempts', array("attempt"=>2),  array("userID"=>$users['userID']));
                            if($reset){
                                $output = json_encode(array("status"=>false, "error"=>"password" , "message"=>"Password not matched. 2 attempt left"));
                            }
                        }
                        else{
                            $output = json_encode(array("status"=>false, "error"=>"global" , "message"=>"Please try again , ".date("h:i A", strtotime($users['attempt_date']))));
                        }
                    }

                }  
            }
            else{
                $output = json_encode(array("status"=>false, "error"=>"email" , "message"=>"Please double check you email"));
            }

        }
        catch(mysqli_sql_exception $mysqli_error){
            $this->log->saveLog("../../log.log", $mysqli_error);
            die("system error");
        }

        $this->DBclose($this->DBconnection());
        return $output;
    }

    protected function createAccounts(){
        
    }

    public function setEmail($email):void{
        $this->email = $email;
    } 

    protected function getEmail():string{
        return $this->email;
    }

    public function setFullname($fullname):void{
        $this->fullname = $fullname;
    } 

    protected function getFullname():string{
        return $this->fullname;
    }

    public function setPassword($password):void{
        $this->password = $password;
    } 

    protected function getPassword():string{
        return $this->password;
    }

    public function setRole($role):void{
        $this->role = $role;
    } 

    protected function getRole():string{
        return $this->role;
    }

    public function setDepartment($department):void{
        $this->department = $department;
    } 

    protected function getDepartment():string{
        return $this->department;
    }
}

?>

