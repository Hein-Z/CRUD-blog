<?php
require '../config/config.php';
$ID=$_GET['id'];
$sql = 'DELETE FROM posts WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $ID);

        $result=$stmt->execute();
if(isset($result)){

        echo '<script>alert("Successful Delete");
        window.location.href="index.php";
        </script>';}
?>