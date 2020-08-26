<?php
session_start(); 
require '../config/config.php';

if(empty($_SESSION['user_id']) && empty( $_SESSION['logged_in'])){
header('location:login.php');
}
  
?>

<?php include('header.php');
 ?>

<?php 
$post_id=$_GET['id'];
$author_id=$_SESSION['user_id'];

$stmt=$pdo->prepare("SELECT * FROM posts WHERE id=:id");
$stmt->bindValue(':id',$_GET['id']);
$stmt->execute();
$post=$stmt->fetch(PDO::FETCH_ASSOC);

    $stmt=$pdo->prepare("SELECT * FROM users");
    $stmt->bindValue(':author_id',$author_id);
    $stmt->execute();
    $users=$stmt->fetchAll();
    
    $stmt=$pdo->prepare("SELECT * FROM comments WHERE post_id=:id");
    $stmt->bindValue(':id',$post_id);
    $stmt->execute();
    $cmt=$stmt->fetchAll();
    
if(isset($_POST['comment'])){

    $stmt=$pdo->prepare("SELECT * FROM comments WHERE post_id=:id");
    $stmt->bindValue(':id',$post_id);
    $stmt->execute();
    $cmt=$stmt->fetchAll();
    
$stmt=$pdo->prepare('INSERT INTO comments(content,author_name,author_id,post_id) VALUE (:comment,:author_name,:author_id,:post_id)');
$result=$stmt->execute(array(':comment'=>$_POST['comment'],'author_name'=>$_SESSION['user_name'],':author_id'=>$author_id,':post_id'=> $post_id));

if($result){
    
    header("location:detail.php?id= $post_id");
    
}

}


?>

<!-- Main content -->
<section class="content mt-5">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-10 offset-md-1 col-12">
                <!-- Box Comment -->
                <div class="card card-widget">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="../users_profile/admin.jpg" alt="User Image">
                            <span class="username"><a
                                    href="#"><?php foreach($users as $user){if ($user['id']==$post['author_id'])echo $user['name'];} ?></a></span>
                            <span class="description">Upload at- <?php echo $post['created_at']; ?></span>
                        </div>
                        <a href="index.php" class='btn btn-warning float-right'>back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <img class="img-fluid pad" src="../post_image/<?php echo $post['image'];?>" alt="Photo">
                        <h1 class='text-center pt-2 text-bold'><?php echo $post['title']; ?></h1>
                        <p style='text-indent: 50px;line-height:1.8em;'><?php echo $post['content'];?></p>

                        <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i>
                            Like</button>
                        <span class="float-right text-muted"><?php echo count($cmt).' comments';?></span>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer card-comments">
                        <?php if(isset($cmt)){ foreach($cmt as $comment){ ?>
                        <div class="card-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm"
                                src="../users_profile/<?php foreach($users as $user){ if($comment['author_id']==$user['id']){echo $user['profile_pic'];}}?>"
                                alt="User Image">


                            <div class="comment-text">
                                <span class="username">
                                    <?php echo $comment['author_name'];?>

                                    <span class="text-muted float-right"><?php
                                    foreach($users as $user){ if($comment['author_id']==$user['id']){echo $user['profile_pic'];}}
                                    echo $comment['created_at'];?></span>
                                </span><!-- /.username -->
                                <?php 
                                
                                echo $comment['content'];?>
                            </div>
                            <?php
                         } }?>
                            <!-- /.comment-text -->
                        </div>
                    </div>
                    <!-- /.card-footer -->
                    <div class="card-footer">

                        <form action="" method="post">
                            <img class="img-fluid img-circle img-sm"
                                src="../users_profile/<?php foreach($users as $user){if ($user['id']==$_SESSION['user_id'])echo $user['profile_pic'];} ?>"
                                alt="Alt Text">
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push">
                                <input type="text" name='comment' class="form-control form-control-sm"
                                    placeholder="Press enter to post comment">
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
</a>
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>

</html>