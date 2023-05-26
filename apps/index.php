<?php
include_once("./include/session/checkSession.php");
if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['role']) && isset($_SESSION['department'])) {
    $session = new mySession($_SESSION['email'], $_SESSION['password'], $_SESSION['role'], $_SESSION['department']);
    $session->checkSession();
}

print_r($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="../assets/css/login-styles.css">
    <title>Schedlr | login</title>
</head>
<body>
    <section class="login-section " >
        <div class="login-center-box position-relative ">
            <div class="left">
                <span class="yellow"></span>
                <span class="orange" ></span>
                <span class="blue" ></span>
            </div>
            <div class="right">
                <span class="yellow"></span>
                <span class="orange" ></span>
                <div class="white">
                    <form id="login-form" method="POST" action="../apps/view/user.view.php">
                        <div class="text-center mb-2">
                            <img src="../assets/images/icon.gif" class=" rounded-circle "  alt="">
                            <h6 class="text-uppercase fw-bold" >ADMINISTRATOR</h6><hr>
                        </div>
                        <div class="d-none alert alert-danger text-center error errorGlobal"></div>
                        <div class="form-group">
                            <div class="input-group mt-3">
                                <input id="login-email" type="text" class="input form-control" placeholder="Email Address" >
                                <span class="input-group-text" id="basic-addon2"> <i class="fa fa-envelope text-muted"></i> </span>
                            </div>
                            <small class="error error-email text-danger" ></small>
                        </div>
                        <div class="form-group">
                            <div class="input-group mt-3">
                                <input type="password" id="login-password"  class="input form-control" id="password-login" placeholder="Password" >
                                <span class="input-group-text" id="basic-addon2"> <i class="text-muted fa fa-eye " id="password-icon" onclick="passwordShow('login-password','password-icon')" ></i> </span>
                            </div>
                            <small class="error error-password text-danger" ></small>
                        </div>
                        <div class="text-center mt-3">
                            <button id="login-form-submit" type="button" class="btn btn-primary w-100" ><span><strong>Login </strong><i class="fa fa-arrow-right" ></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="../assets/js/jquery-3.6.4.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/interactions.js"></script>
    <script src="../assets/js/custom.js"></script>
</body>
</html>