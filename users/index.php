<?php
session_start(); 
require '../config/config.php';


if(empty($_SESSION['user_id']) && empty( $_SESSION['logged_in'])){
header('location:login.php');
}
if(isset($_POST['search'])) {
    setcookie('search',$_POST['search'], time() + (86400 * 30), "/");
    }

  
?>

<?php include('header.php'); ?>

<?php   
        $stmt=$pdo->prepare("SELECT * FROM posts  ORDER BY id DESC");
         $stmt->execute();
         $posts=$stmt->fetchAll();       
?>
<!-- Main content -->
<section class="content-wrapper ml-0">
    <div class="container-fluid my-4">

        <div class="row" style='overflow-x: hidden !important;'>

            <?php 
                foreach($posts as $post){ ?>
            <div class="col-md-4 py-2">
                <!-- Box Comment -->
                <div class="card card-widget border-dark mb-0" style='min-height:450px'>
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="../users_profile/admin.jpg" alt="User Image">
                            <span class="username"><a href="#">Admin</a></span>
                            <span class="description"> 7:30 PM Today</span>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pb-0">
                        <div style='height:270px;'>
                            <img class="img-fluid pad" style='max-height:270px'
                                src="../post_image/<?php echo $post['image'];?>" alt="Photo">

                        </div>
                        <hr>
                        <p><?php echo $post['title'];?></p>
                    </div>

                    <a href="detail.php?id=<?php echo  $post['id']; ?>" class="stretched-link"></a>
                </div>
                <!-- /.card -->
                <div class='card'>
                    <div> <a href="detail.php" type="button" class="btn btn-primary btn-sm ml-3 mb-2"><i
                                class="far fa-thumbs-up text-bold"></i>
                            Like</a>
                        <span class="float-right text-muted mr-3">127 likes - 3 comments</span></div>
                </div>
            </div>

            <?php }?>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<a id="back-to-top" href="#" class="btn btn-primary back-to-top mr-5" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
</a>
</div>
<!-- /.content-wrapper -->

<footer class="main-footer ml-0 px-0">
    <strong class='ml-5'>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
</footer>


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