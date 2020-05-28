<?php
    $page="unfollow.php";
    $title="Unfollow user";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(!isset($_SESSION['userId'])){
        header('Location: index.php');
    }
    if(!isset($_GET['id'])){
        header('Location: index.php');
    } 
    
    $result = $follow->unfollow($_GET['id'], $_SESSION['username']);

    if($result){
        header ("Location: userlist.php");
    } else {
        header ("Location: userlist.php");
    }

    require_once 'includes/footer.php';
?>