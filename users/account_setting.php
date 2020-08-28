<?php
session_start(); 
require '../config/config.php';
$stmt=$pdo->prepare("SELECT * FROM users WHERE id=:id");

$stmt->execute(array(':id'=> $_SESSION['user_id']));
$user=$stmt->fetch();


if($_POST){
    // set profile pic
    $new_profile=$_SESSION['profile_pic'];
    
    
    if($_FILES['image']['name']!=NULL){
    $ran_name=rand(time(),time());
    $file='../users_profile/'.$ran_name.$_FILES['image']['name'];
    $imagetype=pathinfo($file,PATHINFO_EXTENSION);
    if($imagetype != 'png' && $imagetype != 'jpeg' && $imagetype != 'jpg' ){
        $new_profile=$_SESSION['profile_pic'];
    echo "<script>alert('image must be jpg, png or jpeg');</script>";
    }
    else{
        

    $new_profile=$ran_name.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],$file);
    // stmt=pdo->prepare('UPDATE posts SET title=:title, content=:content, image=:image WHERE id=:id');
    // result=stmt->execute(array(':title'=>title,':content'=>content,':image'=>image,':id'=> _GET['id'] ));}
    }}
    // set new name
    if($_POST['name']!=NULL){
        $new_name=$_POST['name'];
        
    }else{
        $new_name=$_SESSION['user_name'];
    }

    // set new email
    if($_POST['email']!=NULL){                                    //check if email set::email set
        if($_POST['password']==NULL){                               //check if password set::password NOT set
        $new_email=$user['email'];                                          //do not set email
            echo '<script>alert("Enter your password to change Email!");</script>'; 
        }else{                                                       //check if password set::password  set
        if($_POST['email']!=$user['email']){                 //check if previous email::NOT previous email
                    $stmt=$pdo->prepare("SELECT email FROM users WHERE email=:email");
                    $stmt->bindValue(':email',$_POST['email']);
                    $stmt->execute();
                    $user_email=$stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if($user_email){  
                $new_email=$user['email'];                                  //set previous email     
                        echo '<script>alert("Email duplicated!");</script>'; //check if email duplicated::email duplicated
                    }else{                                                  //check if email duplicated::email NOT duplicated
                    $new_email=$_POST['email'];                     //passes all condition::set new email
                    
                     }
            }else{                                                      //check if previous email::previous email
                $new_email=$user['email'];                          //set previous email
            }
                                                                                   
    }
    }else{                                                              //check if email set::email NOT set
        $new_email=$user['email'];                                      //do not set email
    }

    // set new password
    if($_POST['password']!=NULL){
    
    
    
        if($_POST['new_password']!=NULL && $_POST['confirm_password']!=NULL){
            if($_POST['new_password']== $_POST['confirm_password']){   
                    $new_password=$_POST['new_password'];
                            //pass all condition ::set new password           
        }else{
        echo '<script>alert("Do not match password!");</script>'; 
            $new_password=$user['password'];
        }
       }else{
        $new_password=$user['password'];
       }
    }else {
        if($_POST['new_password']!=null && $_POST['confirm_password']!=null){
        echo '<script>alert("Type your old password to change new password!");</script>'; 
        }
        $new_password=$user['password'];
        echo '<script>alert("do not set password!");</script>'; 
    }
    
    if($_POST['password']==$user['password']){               //check if password correct::password correct

    $stmt=$pdo->prepare('UPDATE users SET name=:name, email=:email, password=:password,profile_pic=:image WHERE id=:id');
    $result=$stmt->execute(array(':name'=>$new_name,':email'=>$new_email,'password'=>$new_password,':image'=>$new_profile,':id'=> $_SESSION['user_id'] ));
    if(isset($result)){
        $_SESSION['user_name']=$new_name;
        $_SESSION['profile_pic']=$new_profile;
        echo '<script>alert("Completely Updated!");</script>'; 

    }
    }else{
        $new_password=$user['password'];
        echo '<script>alert("Wrong Password!");</script>'; 
           }

}
    
 



// $name=$_POST['name'];
// $email=$_POST['email'];
// $password=$_POST['password'];
// $stmt=$pdo->prepare('INSERT INTO users(name,email,password) VALUE (:name,:email,:password)');
// $result=$stmt->execute(array(':name'=>$name,':email'=>$email,':password'=>  $password));

// if($result){
//     echo '<script>alert("Successfully Registered, Please Login!");window.location.href="login.php";</script>';
//     }else{
//         echo '<script>alert("Cannot Registered");</script>';
//     }

// }else{
//     echo '<script>alert("Confirm match password!");</script>';
// }

?>

<!DOCTYPE html>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
    .sidenav {
        height: 100vh !important;
        top: 0px;
        left: 0;
        font-size: 36px;
        margin-left: 0px;
        width: 250px;
        transition: 0.5s;
        z-index: 1000;
        margin-bottom: 0px;
        margin-right: 0 !important;
        position: fixed;
    }

    .nav-card {
        margin-bottom: 0;
        height: 100vh;
    }

    .card-img-top {
        padding: 30px 0 !important;
    }

    .closebtn {
        display: none;
    }

    .profile_btn {
        display: none;
    }

    .back_btn {


        display: block;

    }

    input {
        font-family: 'Helvetica', FontAwesome, sans-serif;
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
    <script>
    var check = function() {

        if (document.getElementById('new_password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }

    }
    </script>
</head>

<body style='overflow-x:hidden'>
    <div class="row">
        <?php 
        include('profile.php'); ?>
        <div class="col-9 offset-3 col-lg-10 offset-lg-2 pt-5 pb-2">

            <h1 class='text-center'>Account Setting</h1>
            <div class='row'>
                <div class='offset-1 col-10'>
                    <form action="" method="post" enctype='multipart/form-data' enctype='multipart/form-data'>
                        <div class="form-group">
                            <label>New Account Name
                                <span class=' text-success'> (If you do not want to change, blank it)</span>

                            </label>
                            <input type="text" name='name' class="form-control"
                                placeholder="&#xf2bb; Write New Account Name" value=''>
                        </div>
                        <div class="form-group">
                            <label>New Email
                                <span class='text-success'> (If you do not want to change, blank it)</span>

                            </label>
                            <input type="email" name='email' class="form-control" placeholder="&#xf0e0; Write New Email"
                                value=''>
                        </div>


                        <div class="form-group ">
                            <label>New Password
                                <span class='text-success'> (If you do not want to change, blank it)</span>
                            </label>

                            <input name="new_password" class="form-control password"
                                placeholder="&#xf084; Write New Password" id="new_password" type="password"
                                onkeyup='check();' />


                        </div>
                        <div class="form-group mb-0">
                            <label>Retype Password
                                <span class='text-success'> (If you do not want to change, blank it)</span>

                            </label>

                            <input type="password" class="form-control " name="confirm_password"
                                placeholder="&#xf084; Retype password" id="confirm_password" onkeyup='check();' />



                        </div>
                        <div style='display:block;'>
                            <span id='message'></span>
                        </div>

                        <div class="form-group mt-3">
                            <label class='file'>Change Profile Picture</label>
                            <input type="file" id="file" name='image' class="form-control-file">
                            <span class="file-custom"></span>

                        </div>
                        <div class="form-group mt-5">
                            <label class='text-primary text-bold'>Password
                                <span class='text-success'> (Required)</span>
                            </label>

                            <input name="password" class="form-control password" placeholder="&#xf13e; Write Password"
                                id="password" type="password" require />


                        </div>

                        <div class="form-group ">

                            <input type="submit" class='btn btn-primary' name='submit' value='update'>
                            <a href="index.php" class='btn btn-warning'>Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer ">
        <strong class='ml-5'>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All
        rights
        reserved.
    </footer>

</body>

</html>