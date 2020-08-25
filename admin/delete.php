<?php
require '../config/config.php';
$ID=$_GET['id'];
$sql = 'DELETE FROM post WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $ID);

        $stmt->execute();

        echo '<script>alert("Successful Delete");
        window.location.href="index.php";
        </script>';
?>