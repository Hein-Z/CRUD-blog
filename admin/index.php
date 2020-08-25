<?php
require '../config/config.php';
session_start(); 
if(empty($_SESSION['user_id']) && empty( $_SESSION['logged_in'])){
header('location:login.php');
}
include('header.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Home page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <br>
        <a href='add.php' class="btn btn-success">New Blog Post</a>

    </div>
    <?php
    
if(!empty($_GET)){
        $page_no=$_GET['page_no'];
    }
    else{
        $page_no=1;
    }
    $num_of_regs=2;
    $offset=($page_no - 1)*$num_of_regs;

    if(!empty($_POST['search']))
    $search_key=$_POST['search'];
    
    if(empty($search_key)){
  
            $stmt=$pdo->prepare("SELECT * FROM post  ORDER BY id DESC");
           
            $stmt->execute();
            $raw_result=$stmt->fetchAll();
            $total_page=ceil(count($raw_result)/$num_of_regs);

            $stmt=$pdo->prepare("SELECT * FROM post  ORDER BY id DESC LIMIT $offset, $num_of_regs");
           
            $stmt->execute();
            $posts=$stmt->fetchAll();}
            else{
               
                $stmt=$pdo->prepare("SELECT * FROM post WHERE title LIKE '%$search_key%'  ORDER BY id DESC");
           
            $stmt->execute();
            $raw_result=$stmt->fetchAll();
            $total_page=ceil(count($raw_result)/$num_of_regs);

            $stmt=$pdo->prepare("SELECT * FROM post WHERE title LIKE '%$search_key%' ORDER BY id DESC LIMIT $offset, $num_of_regs");
           
            $stmt->execute();
            $posts=$stmt->fetchAll();
            }
            ?>
    <!-- Main content -->
    <?php if(count($posts)){ ?>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th style="width: 40px">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php $id=0;
                
                foreach($posts as $post){ $id++;?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $post['title'];  ?></td>
                    <td>
                        <?php echo substr($post['content'],0,125).'...'; ?>
                    </td>
                    <td><a href='edit.php?id=<?php echo $post['id']; ?>'
                            class="btn btn-primary btn-sm mb-1 w-100">Edit</a>
                        <a href='delete.php?id=<?php echo $post['id']; ?>'
                            onclick="return confirm('Are you sure you want to delete this item?');"
                            class="btn btn-outline-warning btn-sm w-100">Delete</a>
                    </td>
                </tr>
                <?php }?>

            </tbody>
        </table>
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
        <?php } else{?>
        <h1>There is no post match with '<?php echo $_POST['search']; ?>'</h1>
        <?php }?>


    </div>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.html');?>