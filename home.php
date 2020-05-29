<?php
    $page="home.php";
    $title="Home";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(!isset($_SESSION['username'])){
        header('Location: index.php');
    }

    if(isset($_GET['status'])){
        if($_GET['status']=="error") {
            include 'includes/errormessage.php';
            sleep(5);
            header('Location: home.php');
        }
    }
    
    $follower_count = $follow->getFollowerCount($_SESSION['username']);
    
?>
<form action="create_tweet.php" method="post">
    <div class="lead shadow-lg p-4 mb-4 bg-white">
    What's happening? <span style="float:right;margin-right: 70px;" id="count"></span>
        <div class="input-group mb-3">
            <textarea class="form-control custom-control" name="body" onkeyup="count(this)" rows="4" aria-label="With textarea"></textarea>
            <div class="input-group-append">
                <input class="btn btn-primary" type="submit" id="button-addon2" value="Tweet" />
            </div>
        </div>
    </div>
</form>
<?php
    if($follower_count['num']<=0){
        include 'includes/startFollowing.php';
    } else {
        $result = $follow->getFollowingTweets($_SESSION['username']);
        while($r = $result->fetch(PDO::FETCH_ASSOC)){
?>
    <div class="card border-primary mb-3">
    <div class="card-body">
        <h5 class="card-title"><?php echo $r['authorName']; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $r['created']; ?></h6>
        <p class="card-text"><?php echo $r['body']; ?></p>
    </div>
    </div>
<script>
    // isse snippet liya
    // https://stackoverflow.com/a/42067564/10292716

    let count = (val) => {
        let len = val.value.length;

        if (len >= 140) {
              val.value = val.value.substring(0, 140);
        } else {
                $('#count').text(140 - len);
        }
    }
</script>
<?php }} require_once 'includes/footer.php'; ?>
