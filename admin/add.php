<?php
session_start();
require '../config/config.php';
include('header.php');
if(empty($_SESSION['user_id']) && empty( $_SESSION['logged_in'])){
    header('location:login.php');
}

    if($_POST){
        $file='image/'.rand(time(),time()).$_FILES['image']['name'];
        $imagetype=pathinfo($file,PATHINFO_EXTENSION);
        if($imagetype != 'png' && $imagetype != 'jpeg' && $imagetype != 'jpg' ){
        echo '<script>alert("image must be jpg, png or jpeg");</script>';
    }else{
        $title=$_POST['title'];
        $content=$_POST['content'];
        $image=$_FILES['image']["name"];
        move_uploaded_file($_FILES['image']['tmp_name'],$file);
    $stmt=$pdo->prepare('INSERT INTO post(title,content,image,author_id) VALUE (:title,:content,:image,:author_id)');
    $result=$stmt->execute(array(':title'=>$title,':content'=>$content,':image'=>$image,':author_id'=>  $_SESSION['user_id']));
    }if($result){
        echo '<script>alert("successfully update");</script>';
        
    }else{
        echo '<script>alert("cannot update");</script>';
    }
        
    }
?>

<div class="content-wrapper pt-5 pb-2">
    <h1 class='text-center'>Add New Post</h1>
    <div class='col-10 offset-1 '>

        <form action="" method="post" enctype='multipart/form-data'>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name='title' class="form-control" placeholder="Write Post's title" require>
            </div>
            <div class="form-group">
                <label>content</label>
                <textarea style="resize:none;height:300px;" type="text" name='content' class="form-control"
                    placeholder="What's on your mind, <?php echo $_SESSION['user_name'];?>?"></textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name='image' class="form-control-file">
            </div>
            <div class="form-group">

                <input type="submit" class='btn btn-primary' name='' value='submit'>
                <a href="index.php" class='btn btn-warning'>Back</a>
            </div>
        </form>
    </div>
</div>
<?php
include('footer.html');
?>