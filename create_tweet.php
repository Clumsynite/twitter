<?php
    $page="create_tweet.php";
    $title="Create Tweet";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(!isset($_POST['body'])){
        exit;
    }

    $id = $_SESSION['userId'];
    $username = $_SESSION['username'];
    $body = $_POST['body'];
    
    $result = $crud->createTweet($id, $username, $body);

    if($result) {
        header ('Location: home.php');
    } else {
        header ('Location: home.php?status=error');
    }  
?>