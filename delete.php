<?php
include 'db.php';

$id=isset($_GET['id']);

if (isset($_GET['id'])) {
    $sql=$Conn->prepare("delete from product where id=?");
    $sql->bind_param('i',$_GET['id']);
    $sql->execute();
    header("Location:dashboard.php");
}

?>