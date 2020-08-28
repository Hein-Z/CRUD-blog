<?php
session_start();
require '../config/config.php';
include('header.php');

    if($_POST){
        $file='../post_image/'.rand(time(),time()).$_FILES['image']['name'];
        $imagetype=pathinfo($file,PATHINFO_EXTENSION);
        if($imagetype != 'png' && $imagetype != 'jpeg' && $imagetype != 'jpg' ){
        echo '<script>alert("image must be jpg, png or jpeg");</script>';
    }else{
        $title=$_POST['title'];
        $content=$_POST['content'];
       $category=$_POST['category'] ;
        $image=rand(time(),time()).$_FILES['image']['name'];

if($category){
        move_uploaded_file($_FILES['image']['tmp_name'],$file); 
    $stmt=$pdo->prepare('INSERT INTO posts(title,content,image,author_id,category) VALUE (:title,:content,:image,:author_id,:category)');
    $result=$stmt->execute(array(':title'=>$title,':content'=>$content,':image'=>$image,':author_id'=> $_SESSION['user_id'],':category'=> $category));
    if($result){
        echo '<script>alert("successfully added");window.location.href="index.php"</script>';
    }else{
        echo '<script>alert("cannot add");window.location.href="index.php"</script>';

    }
}else{
        echo '<script>alert("cannot add");</script>';
    }
    } 
   
    }
   
?>

<div class="content-wrapper pt-5 pb-2">
    <h1 class='text-center'><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-plus-fill"
            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M12 1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zM8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z" />
        </svg> Add New Post</h1>
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

                <label for="category">Category:</label>

                <select name="category">
                    <option value="Art news">Art news</option>
                    <option value="IT news">IT news</option>
                    <option value="Entertainments">Entertainments</option>
                    <option value="Non categorized" selected>Non categorized</option>
                </select>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name='image' class="form-control-file" require>
            </div>
            <div class="form-group">

                <input type="submit" class='btn btn-primary' name='' value='submit'>
                <a href="index.php" class='btn btn-warning'><svg width="2em" height="1.5em" viewBox="0 0 16 16"
                        class="bi bi-arrow-left-square-fill " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.354 10.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z" />
                    </svg> Back</a> Back</a>
            </div>
        </form>
    </div>
</div>
<?php
include('footer.html');
?>