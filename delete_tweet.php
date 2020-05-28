<?php
    $page="delete_tweet.php";
    $title="Delete Tweet";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(!isset($_GET['id'])){
        exit;
    }

    $id = $_GET['id'];
    
    $result = $crud->deleteTweet($id);

    if($result) {
        header ('Location: profile.php?id='.$_SESSION['username']);
    } else {
        header ('Location: profile.php?status=error');
    }

    
?>