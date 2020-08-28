<?php
$stmt=$pdo->prepare("SELECT * FROM users WHERE id=:id");

$stmt->execute(array(':id'=> $_SESSION['user_id']));
$user=$stmt->fetch();
?>
<div id="mySidenav" class="sidenav col-md-3 col-5">

    <div class="card nav-card border border-top-0 pb-5  border-left-0 border-primary">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <img class="card-img-top" src="../users_profile/<?php echo $_SESSION['profile_pic'];?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title text-primary text-bold"><?php echo $_SESSION['user_name'];?>'s profile</h5>

        </div>
        <ul class="list-group list-group-flush" style="font-size:20px;">
            <li class="list-group-item">
                Account name: <span><?php echo $user['name'];?></span>
            </li>
            <li class="list-group-item"> Email: <span><?php echo $user['email'];?></span>
            </li>
            <li class="list-group-item">Role:
                <span><?php if($user['role']==1) echo 'Admin';else echo 'user';?></span>
            </li>
        </ul>
        <div class="card-body" style="font-size:20px;">
            <a href="account_setting.php" class="card-link profile_btn btn btn-outline-primary">Account Setting</a>
            <a href="index.php" class="card-link back_btn btn btn-warning ml-0">Back</a>
        </div>
    </div>
</div>