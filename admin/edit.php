<?php 
session_start();
require '../config/config.php';
include('header.php');

$stmt=$pdo->prepare("SELECT * FROM post WHERE id=:id");
$stmt->bindValue(':id',$_GET['id']);
$stmt->execute();
$edit_post=$stmt->fetch(PDO::FETCH_ASSOC);

if($_POST){
    $title=$_POST['title'];
    $content=$_POST['content'];
        
    $ran_name=rand(time(),time());
   
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        $file='image/'.$ran_name.$_FILES['image']['name'];
        $imagetype=pathinfo($file,PATHINFO_EXTENSION);
        if($imagetype != 'png' && $imagetype != 'jpeg' && $imagetype != 'jpg' ){
        echo '<script>alert("image must be jpg, png or jpeg");</script>';
        }
        else{
        
        $image=$ran_name.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$file);
        $stmt=$pdo->prepare('UPDATE post SET title=:title, content=:content, image=:image WHERE id=:id');
        $result=$stmt->execute(array(':title'=>$title,':content'=>$content,':image'=>$image,':id'=> $_GET['id'] ));}
    }else{
        
        $stmt=$pdo->prepare('UPDATE post SET title=:title, content=:content WHERE id=:id');
            $result=$stmt->execute(array(':title'=>$title,':content'=>$content,':id'=> $_GET['id'] ));
    }
    if($result){
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
                <img class='img-fluid mb-2  img-thumbnail' src="image/<?php echo $edit_post['image']; ?>"
                    alt="image/<?php echo $edit_post['image']; ?>">
            </div>
            <div class="form-group">

                <input type="submit" class='btn btn-primary' name='' value='submit'>
                <a href="index.php" class='btn btn-warning'>Back</a>
            </div>
        </form>
    </div>
</div>
<?php include('footer.html');?>