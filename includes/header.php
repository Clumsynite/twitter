<?php    include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Twitter lite - <?php echo $title; ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="home.php"><?php if(!isset($_SESSION['username'])){echo "Clumsy's Twitter lite";} else{echo "Hello ".$_SESSION['username'];} ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav1" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="container ">
      <div class=" collapse navbar-collapse" id="nav1">
        <div class="navbar-nav mr-auto">
        <?php if(isset($_SESSION['username'])){?>
          <a class="nav-item nav-link <?php if($page=='home.php'){echo 'active';} ?>" href="index.php">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link <?php if($page=='profile.php'){echo 'active';} ?>" href="profile.php?id=<?php echo $_SESSION['username']; ?>">View Profile<span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link <?php if($page=='userlist.php'){echo 'active';} ?>" href="userlist.php">View Users<span class="sr-only">(current)</span></a>
        <?php } ?>
        </div>
        <div class="navbar-nav ml-auto">
          <?php
            if(!isset($_SESSION['userId'])){ 
          ?>
          <a class="nav-item nav-link  <?php if($page=='index.php'){echo 'active';} ?>" href="index.php">Login <span class="sr-only">(current)</span></a>
          <?php } else { ?>
          <a class="nav-item nav-link" href="logout.php"> Logout <span class="sr-only">(current)</span></a>
          <?php } ?>
        </div>
      </div>
      </div>
    </nav>
    <div class="container">
    <br/>
