<?php
session_start(); 
require '../config/config.php';


if(empty($_SESSION['user_id']) && empty( $_SESSION['logged_in'])){
header('location:login.php');}
include('header.php');
 ?>



<!-- <div class="card float-left">
    <h2 style="text-align:center">User Profile Card</h2>
    <img src="/w3images/team2.jpg" alt="John" style="width:100%">
    <h1>John Doe</h1>
    <p class="title">CEO & Founder, Example</p>
    <p>Harvard University</p>
    <div style="margin: 24px 0;">
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
    </div>
    <p><button>Contact</button></p>
</div> -->
<div id="mySidenav" class="sidenav">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="../users_profile/<?php echo $_GET['profile_pic'];?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title text-primary text-bold"><?php echo $_SESSION['user_name'];?>'s profile</h5>

        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Account name: <span><?php echo $_SESSION['user_name'];?></span>
            </li>
            <li class="list-group-item"> Email: <span><?php echo $_GET['email'];?></span>
            </li>
            <li class="list-group-item">Role: <span><?php if($_GET['role']==1) echo 'Admin';else echo 'user';?></span>
            </li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link">Account Setting</a>

        </div>
    </div>
</div>
</body>

</html>