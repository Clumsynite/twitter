<?php
    $page="profile.php";
    $title="Profile";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(!isset($_SESSION['userId'])){
        header('Location: index.php');
    }
    if(!isset($_GET['id'])){
        header('Location: index.php');
    }  
    if(isset($_GET['status'])){
        if($_GET['status']=="error") {
            include 'includes/errormessage.php';
            sleep(3);
            header('Location: profile.php');
        }
    }

    $id = $_GET['id'];
    $count = $crud->getTweetCount($id);
    if ($id == $_SESSION['username']){
        include 'includes/startPosting.php';
    }else if ($count['num']<1){
        include 'includes/banner.php';
    } else {
    $result = $crud->getTweetByAuthor($_GET['id']);
    while($r = $result->fetch(PDO::FETCH_ASSOC)){
?>
    <div class="card border-primary mb-3">
    <div class="card-body">
        <h5 class="card-title"><?php echo $r['authorName']; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $r['created']; ?></h6>
        <p class="card-text"><?php echo $r['body']; ?><br/>
        <?php if($id == $_SESSION['username']) { ?>
            <a href="delete_tweet.php?id=<?php echo $r['tweetID']; ?>" class="btn btn-danger" style="float:right;">Delete tweet</a>
        <?php } ?>
        </p>
    </div>
    </div>
<?php } } require_once 'includes/footer.php'; ?>