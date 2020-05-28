<?php
    // Test Connection
    /* $host = '127.0.0.1';
    $db = 'twitterlite';
    $user = 'root';
    $pass = 'clumz';
    $charset = 'utf8mb4'; */
 
    // Development Connection
    $host = 'remotemysql.com';
    $db = '24RU2T4oF2';
    $user = '24RU2T4oF2';
    $pass = '0vnosfhjC5';
    $charset = 'utf8mb4';
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        throw $e->getMessage();
    }

    require_once 'crud.php';
    require_once 'user.php';
    require_once 'follow.php';
    $crud = new crud($pdo);
    $user = new user($pdo);
    $follow = new follow($pdo);

    $user->insertUser("admin","password");
?>