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

        

        $post_author_name=[];
        $num_cmt=[];
        foreach($posts as $key=> $post){
            $stmt=$pdo->prepare("SELECT COUNT(id) FROM comments WHERE post_id=:id");
            $stmt->bindValue(':id',$post['id']);
            $stmt->execute();
            $num_cmt[]=$stmt->fetchAll();

            $post_author_id=$post['author_id'];
            $stmt=$pdo->prepare("SELECT name FROM users WHERE id=$post_author_id");
           
            $stmt->execute();
            $post_author_name[]=$stmt->fetch(PDO::FETCH_ASSOC);
        }
      
?>

<!-- Main content -->
<section class="content-wrapper ml-0">
    <div class="container-fluid my-4">

        <div class="row" style='overflow-x: hidden !important;'>

            <?php 
                foreach($posts as $key=>$post){ ?>
            <div class="col-md-4 py-2 ">
                <!-- Box Comment -->
                <div class="card card-widget border-dark  border border-secondary mb-0 " style='min-height:520px'>
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="../users_profile/admin.jpg" alt="User Image">
                            <span class="username"><a href="#"><?php echo $post_author_name[$key]['name'];?></a></span>
                            <span class="description"> <?php echo $post['created_at'];?></span>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pb-0">
                        <a href="detail.php?id=<?php echo  $post['id']; ?>">
                            <div style='height:270px;'>
                                <img class="img-fluid pad" style='max-height:270px'
                                    src="../post_image/<?php echo $post['image'];?>" alt="Photo">

                            </div>
                            <hr>
                            <p><?php echo $post['title'];?></p>
                        </a>
                    </div>

                    <div class='card-footer shadow mb-2 mr-1 '>
                        <div>
                            <!-- <a href="#" type="button" class="btn btn-primary btn-sm ml-3 mb-2"><i
                                    class="far fa-thumbs-up text-bold"></i>
                                Like</a> -->
                            <span class="float-right text-muted mr-3">
                                <?php echo $num_cmt[$key][0]['COUNT(id)'] ?> comments</span></div>
                    </div>
                </div>
                <!-- /.card -->
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

<!-- <a id="back-to-top" href="#" class="btn btn-primary back-to-top mr-5" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
</a> -->
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
document.querySelector('.nav-card').style.display = 'none';
document.getElementById("mySidenav").style.width = "0";

function openNav() {
    document.querySelector('.nav-card').style.display = 'block';
    document.getElementById("mySidenav").style.width = "250px";

}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.querySelector('.nav-card').style.display = 'none';
    document.getElementById("mySidenav").style.width = "0";


}
</script>
</body>

</html>