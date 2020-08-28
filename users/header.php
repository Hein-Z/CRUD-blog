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

    .profile_btn {
        display: block;
    }

    .back_btn {


        display: none;

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

    <?php include('profile.php');?>
    <div class="wrapper">

        <nav
            class="main-header navbar navbar-expand navbar-white navbar-light border-bottom border-secondary  m-0 p-0 py-2">
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
                <li class="nav-item d-sm-inline-block">
                    <a class="nav-link text-primary  p-1 px-3" href='index.php' style='cursor:pointer;'>
                        Home</a>
                </li>

                <li class="nav-item d-inline-block">
                    <button type="button" class="btn btn-default">Categories</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">War News</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?category=IT news">IT News</a>
                        <a class="dropdown-item" href="index.php?category=Art news">Art News</a>
                        <a class="dropdown-item" href="index.php?category=Entertainments">Entertainments</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?category=Non categorized">non categorized</a>
                    </div>
                </li>

            </ul>


            <ul class='ml-auto navbar-nav mr-lg-5 '>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href='logout.php' class='btn btn-danger float-right'>Logout</a>
                <li>
            </ul>
        </nav>
        <!-- /.navbar -->