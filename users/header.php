<?php
$stmt=$pdo->prepare("SELECT * FROM users WHERE id=:id");

$stmt->execute(array(':id'=> $_SESSION['user_id']));
$user=$stmt->fetch();
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Hein'Z blog</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .sidenav {
        position: absolute !important;
        top: 60px;
        left: 0;
        font-size: 36px;
        margin-left: 0px;
        width: 250px;
        transition: 0.5s;
        z-index: 1000;
    }

    .closebtn {
        position: absolute !important;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
        z-index: 1000;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }
    </style>
</head>

<body class="hold-transition sidebar-mini" style='overflow-x: hidden;'>
    <div id="mySidenav" class="sidenav">

        <div class="card nav-card">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <img class="card-img-top" src="../users_profile/<?php echo $user['profile_pic'];?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title text-primary text-bold"><?php echo $_SESSION['user_name'];?>'s profile</h5>

            </div>
            <ul class="list-group list-group-flush" style="font-size:20px;">
                <li class="list-group-item">
                    Account name: <span><?php echo $_SESSION['user_name'];?></span>
                </li>
                <li class="list-group-item"> Email: <span><?php echo $user['email'];?></span>
                </li>
                <li class="list-group-item">Role:
                    <span><?php if($user['role']==1) echo 'Admin';else echo 'user';?></span>
                </li>
            </ul>
            <div class="card-body" style="font-size:20px;">
                <a href="profile.php" class="card-link">Account Setting</a>

            </div>
        </div>
    </div>
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light  m-0 p-0 py-2">
            <!-- Left navbar links -->
            <ul class="navbar-nav ml-lg-5">
                <li class="nav-item d-sm-inline-block">
                    <div class="user-block">

                        <img class="img-circle" src="../users_profile/<?php echo $user['profile_pic'];?>"
                            alt="User Image">
                    </div>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a onclick="openNav()" class="nav-link text-primary text-bold p-1" style='cursor:pointer;'>
                        <?php echo  $_SESSION['user_name'];?></a>
                </li>

            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3" action='index.php' method='post'>
                <div class="input-group input-group-sm">
                    <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class='ml-auto navbar-nav mr-lg-5 '>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href='logout.php' class='btn btn-danger float-right'>Logout</a>
                <li>
            </ul>
        </nav>
        <!-- /.navbar -->