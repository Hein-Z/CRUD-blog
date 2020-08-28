<?php
require '../config/config.php';
$ID=$_GET['id'];
$ROLE=$_GET['role'];
if($ROLE!=1){
$sql = 'DELETE FROM users WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $ID);

        $result=$stmt->execute();
    }else{
        echo '<script>alert("Cannot Delete Admin Role Account");
        window.location.href="user.php";
        </script>';
    }
if(isset($result)){

        echo '<script>alert("Successful Delete");
        window.location.href="user.php";
        </script>';}
?>