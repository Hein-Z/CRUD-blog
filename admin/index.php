<?php
require '../config/config.php';
session_start(); 
if(empty($_SESSION['user_id']) && empty( $_SESSION['logged_in'])){
header('location:login.php');
}
include('header.php');
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>


</nav>
<!-- /.navbar -->


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
            $stmt=$pdo->prepare("SELECT * FROM post");
           
            $stmt->execute();
            $posts=$stmt->fetchAll();
            
            ?>
    <!-- Main content -->
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
                <?php $id=0; foreach($posts as $post){ $id++;?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $post['title'];  ?></td>
                    <td>
                        <?php echo substr($post['content'],0,125).'...'; ?>
                    </td>
                    <td><a href='edit.php?=<?php echo $post['id']; ?>'
                            class="btn btn-primary btn-sm mb-1 w-100">Edit</a>
                        <a href='delete.php?=<?php echo $post['id']; ?>'
                            class="btn btn-outline-warning btn-sm w-100">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.html');?>