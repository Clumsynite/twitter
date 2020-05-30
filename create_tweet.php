<?php
    $page="create_tweet.php";
    $title="Create Tweet";
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    date_default_timezone_set('Asia/Kolkata');
    if(!isset($_POST['body'])){
        exit;
    }

    $id = $_SESSION['userId'];
    $username = $_SESSION['username'];
    $body = $_POST['body'];
    $date = date('Y-m-d H:i:s');
    
    $result = $crud->createTweet($id, $username, $body, $date);

    if($result) {
        header ('Location: home.php');
    } else {
        header ('Location: home.php?status=error');
    }  
?>