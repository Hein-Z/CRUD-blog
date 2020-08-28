<?php 
session_start();
require '../config/config.php';
include('header.php');
if(empty($_SESSION['user_id']) && empty( $_SESSION['logged_in'])){
    header('location:login.php');
}if($_SESSION['role']==0){
    header('location:login.php');
    }
$stmt=$pdo->prepare("SELECT * FROM posts WHERE id=:id");
$stmt->bindValue(':id',$_GET['id']);
$stmt->execute();
$edit_post=$stmt->fetch(PDO::FETCH_ASSOC);

if($_POST){
    $title=$_POST['title'];
    $content=$_POST['content'];
        
   
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
    $ran_name=rand(time(),time());
        $file='../post_image/'.$ran_name.$_FILES['image']['name'];
        $imagetype=pathinfo($file,PATHINFO_EXTENSION);
        if($imagetype != 'png' && $imagetype != 'jpeg' && $imagetype != 'jpg' ){
        echo '<script>alert("image must be jpg, png or jpeg");</script>';
        }
        else{
        
        $image=$ran_name.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$file);
        $stmt=$pdo->prepare('UPDATE posts SET title=:title, content=:content, image=:image WHERE id=:id');
        $result=$stmt->execute(array(':title'=>$title,':content'=>$content,':image'=>$image,':id'=> $_GET['id'] ));}
    }else{
        
        $stmt=$pdo->prepare('UPDATE posts SET title=:title, content=:content WHERE id=:id');
            $result=$stmt->execute(array(':title'=>$title,':content'=>$content,':id'=> $_GET['id'] ));
    }
    if(isset($result)){
        echo '<script>alert("successfully edited");window.location.href="index.php";</script>';
        
        }else{
        echo '<script>alert("cannot edited");</script>';
        }
}
   
    ?>
<div class="content-wrapper pt-5 pb-2">
    <h1 class='text-center'>Add New Post</h1>
    <div class='col-10 offset-1 '>
        <?php echo  !empty($_FILES) ;?>

        <form action="" method="post" enctype='multipart/form-data'>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name='title' class="form-control" placeholder="Write Post's title"
                    value='<?php echo  $edit_post["title"];?>' require>
            </div>
            <div class="form-group">
                <label>content</label>
                <textarea style="resize:none;height:300px;" type="text" name='content' class="form-control"
                    placeholder="What's on your mind, <?php echo $_SESSION['user_name'];?>?"><?php echo  $edit_post["content"];?></textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name='image' class="form-control-file">
            </div>
            <div class="col-5">
                <img class='img-fluid mb-2  img-thumbnail' src="../post_image/<?php echo $edit_post['image']; ?>"
                    alt="image/<?php echo $edit_post['image']; ?>">
            </div>
            <div class="form-group">

                <input type="submit" class='btn btn-primary' name='' value='submit'>
                <a href="index.php" class='btn btn-warning'><svg width="2em" height="1.5em" viewBox="0 0 16 16"
                        class="bi bi-arrow-left-square-fill " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.354 10.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z" />
                    </svg> Back</a>
            </div>
        </form>
    </div>
</div>
<?php include('footer.html');?>