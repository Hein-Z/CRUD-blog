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
if(!empty($_GET['page_no'])){
    $page_no=$_GET['page_no'];
}
else{
    $page_no=1;
}
$num_of_regs=3;
$offset=($page_no - 1)*$num_of_regs;

     
        $stmt=$pdo->prepare("SELECT * FROM posts  ORDER BY id DESC");
           
        $stmt->execute();
        $raw_result=$stmt->fetchAll();
        $total_page=ceil(count($raw_result)/$num_of_regs);

        $stmt=$pdo->prepare("SELECT * FROM posts  ORDER BY id DESC LIMIT $offset, $num_of_regs");
       
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
                    <div> <a href="#" type="button" class="btn btn-primary btn-sm ml-3 mb-2"><i
                                class="far fa-thumbs-up text-bold"></i>
                            Like</a>
                        <span class="float-right text-muted mr-3">127 likes - 3 comments</span></div>
                </div>
            </div>

            <?php }?>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <div class='float-right mt-2 mr-5'>
        <ul class="pagination">
            <li class="page-item <?php if($page_no==1){echo 'disabled';} ?>">
                <a class="page-link" href="?page_no=<?php  if($page_no<=1){echo $page_no;}
                        else {echo $page_no-1;}?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item <?php if($page_no==1){echo 'disabled';} ?>"><a class="page-link"
                    href="?page_no=1">First page</a></li>
            <li class="page-item <?php if($page_no==1){echo 'disabled';} ?>"><a class="page-link" href="?page_no=<?php  if($page_no<=1){echo $page_no;}
                        else {echo $page_no-1;}?>">Previous Page</a></li>
            <li class="page-item">
                <a class="page-link text-bold" href="#"><?php echo $page_no?>
                </a>
            </li>
            <li class="page-item <?php if($page_no==$total_page){echo 'disabled';} ?>"><a class="page-link" href="?page_no=<?php if($page_no<$total_page){echo $page_no+1;}
                        else {echo $page_no;}?>">Next Page</a>
            </li>
            <li class="page-item <?php if($page_no==$total_page){echo 'disabled';} ?>"><a class="page-link"
                    href="?page_no=<?php echo $total_page?>">Last Page</a></li>
            <li class="page-item  <?php if($page_no==$total_page){echo 'disabled';} ?>">
                <a class="page-link" href="?page_no=<?php echo $total_page?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </div>

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
<script>
function openNav() {
    document.querySelector('.nav-card').style.display = 'block';
    document.getElementById("mySidenav").style.width = "250px";
    console.log('hello');
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.querySelector('.nav-card').style.display = 'none';
    document.getElementById("mySidenav").style.width = "0";
    console.log('hello');

}
</script>
</body>

</html>