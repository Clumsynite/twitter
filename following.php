<?php
    $page="following.php";
    $title="Follow user";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(!isset($_SESSION['userId'])){
        header('Location: index.php');
    }
    if(!isset($_GET['id'])){
        header('Location: index.php');
    } 
    
    $result = $follow->startFollowing($_GET['id'], $_SESSION['username']);

    if ($_GET['page']=="flrs"){
        if($result){
            header ("Location: followers.php");
        } else {
            header ("Location: followers.php");
        }
    } else if ($_GET['page']=="flwing"){
        if($result){
            header ("Location: iFollow.php");
        } else {
            header ("Location: iFollow.php");
        }
    } else{
        if($result){
            header ("Location: userlist.php");
        } else {
            header ("Location: userlist.php");
        }
    }

    require_once 'includes/footer.php';
?>