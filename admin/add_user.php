<?php
session_start();
require '../config/config.php';
include('header.php');

    if($_POST){
        $file='../users_profile/'.rand(time(),time()).$_FILES['profile_pic']['name'];
        $profile_pictype=pathinfo($file,PATHINFO_EXTENSION);
        if($profile_pictype != 'png' && $profile_pictype != 'jpeg' && $profile_pictype != 'jpg' ){
        echo '<script>alert("profile_pic must be jpg, png or jpeg");</script>';
    }else{
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
       
        $profile_pic=rand(time(),time()).$_FILES['profile_pic']['name'];


        move_uploaded_file($_FILES['profile_pic']['tmp_name'],$file); 
    $stmt=$pdo->prepare('INSERT INTO users(name,email,password,profile_pic) VALUE (:name,:email,:password,:profile_pic)');
    $result=$stmt->execute(array(':name'=>$name,':email'=>$email,':password'=>$password,':profile_pic'=>$profile_pic));
    if($result){
        echo '<script>alert("successfully added");window.location.href="user.php"</script>';
    }else{
        echo '<script>alert("cannot add");window.location.href="user.php"</script>';

    }

    } 
   
    }
   
?>

<div class="content-wrapper pt-5 pb-2">
    <h1 class='text-center'>Add New user</h1>
    <div class='col-10 offset-1 '>

        <form action="" method="post" enctype='multipart/form-data'>
            <div class="form-group">
                <label><svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-file-person-fill mr-1 mb-1"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2 3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm6 7a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 11.825 10.623 11 8 11s-4.146.826-5 1.755V13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z" />
                    </svg> Name</label>
                <input type="text" name='name' class="form-control" placeholder="Write user's name" require>
            </div>
            <div class="form-group">
                <label><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope-open-fill mr-1 mr-1"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.941.435a2 2 0 0 0-1.882 0l-6 3.2A2 2 0 0 0 0 5.4v.313l6.709 3.933L8 8.928l1.291.717L16 5.715V5.4a2 2 0 0 0-1.059-1.765l-6-3.2zM16 6.873l-5.693 3.337L16 13.372v-6.5zm-.059 7.611L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516zM0 13.373l5.693-3.163L0 6.873v6.5z" />
                    </svg> Email</label>
                <input type="text" name='email' class="form-control" placeholder="Write user's email">
            </div>
            <div class="form-group">
                <label><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-lock mr-1 mb-1"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                    </svg> Password</label>
                <input type="password" name='password' class="form-control" placeholder="Write User's Password"
                    class="form-control-file" require>
            </div>
            <div class="form-group">
                <label><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-bounding-box mr-1 mb-1"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                        <path fill-rule="evenodd"
                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg> Profile Picture</label>
                <input type="file" name='profile_pic' class="form-control-file" require>
            </div>
            <div class="form-group">

                <input type="submit" class='btn btn-primary' name='' value='submit'>
                <a href="user.php" class='btn btn-warning '><svg width="2em" height="1.5em" viewBox="0 0 16 16"
                        class="bi bi-arrow-left-square-fill " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.354 10.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z" />
                    </svg> Back</a>
            </div>
        </form>
    </div>
</div>
<?php
include('footer.html');
?>