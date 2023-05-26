<?php
    include_once("../include/session/loggedSession.php");
    $session = new mySession($_SESSION['email'], $_SESSION['password'], $_SESSION['role'], $_SESSION['department']);
    $session->loggedSessionDean();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="../../assets/css/dean.css">
    <title>Schedlr | login</title>
</head>
<body id="body" >
    <span class="blue-float" ></span>
    <section class="section-dean min-vh-100 " >
        <div class="sidebar vh-100 position-relative">
            <div class="blue-float-extension w-100">
                <div class="navbar p-2">
                    <h4 class="mt-2 text-uppercase text-white" >Schedlr</h4>
                    <i class="fa fa-bars sidebar-bars text-white" ></i>
                </div>
                <div class="mt-1 text-center">
                    <img src="../../assets/images/user-big.png" alt=""><br>
                    <strong class="text-white text-uppercase fw-thin" ><?php echo $_SESSION['fullname']; ?></strong><br>
                    <small class="fw-thin text-white text-uppercase" ><?php echo $_SESSION['department'] ?></small>
                </div>
            </div>
            <div class="w-100 p-2">
                <div class="mt-3 sidebar-links sidebar-active" >
                    <i class="fa fa-home" ></i>
                    <strong>&nbsp;Home</strong>
                </div>
                <div class="mt-3 sidebar-links sidebar-unactive " >
                    <i class="fa fa-tasks" ></i>
                    <strong>&nbsp;Set Up</strong>
                </div>
                <div class="mt-3 sidebar-links sidebar-unactive " >
                    <i class="fa fa-users" ></i>
                    <strong>&nbsp;Professors</strong>
                </div>
                <div class="mt-3 sidebar-links sidebar-unactive " >
                    <i class="fa fa-building" ></i>
                    <strong>&nbsp;Classroom</strong>
                </div>
                <div class="mt-3 sidebar-links sidebar-unactive " >
                    <i class="fa fa-user" ></i>
                    <strong>&nbsp;Account</strong>
                </div>
            </div>
            <div class="position-absolute bottom-0 w-100 mb-5">
                <div class="p-2">
                    <div class=" sidebar-links sidebar-unactive " >
                        <i class="fa fa-cogs" ></i>
                        <strong>&nbsp;Setting</strong>
                    </div>
                    <a href="../logout.php" class=" text-decoration-none sidebar-links sidebar-unactive " >
                        <i class="fa fa-sign-out text-dark" ></i>
                        <strong class="text-dark" >&nbsp;Log Out</strong>
                    </a>
                </div>
            </div>
        </div>
        <div class="content vh-100 overflow-auto container-fluid ">
            <div class="vh-100 overflow-auto ">
                <h1 class="" >sdsds</h1>
            </div>
            <div class="vh-100 overflow-auto "></div>
        </div>
    </section>
    <script src="../../assets/js/jquery-3.6.4.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="../../assets/js/interactions.js"></script>
    <script src="../../assets/js/dean-customs.js"></script>
</body>
</html>