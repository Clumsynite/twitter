<?php
    $page="followers.php";
    $title="My Followers";
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    
    if(!isset($_SESSION['userId']) && !isset($_SESSION['username'])){
        header('Location: index.php');
    }

    $result = $follow->getFollowers($_SESSION['username']);
    
?>

<h1 class="text-center"><?php echo $title; ?></h1>
<div class="table">
        <table class="table table-bordered table-hover table-xl  text-center">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($r = $result->fetch()){ ?>
                    <tr>
                        <td><?php echo $r['follower']; ?></td>
                        <td >
                            <a href="profile.php?id=<?php echo $r['follower']; ?>" class="btn btn-primary">Visit Profile</a>
                            <?php
                                $followState = $follow->checkFollowerState($r['follower'], $_SESSION['username']); 
                                if (!$followState){
                            ?>
                                <a href="following.php?id=<?php echo $r['follower']; ?>" class="btn btn-success">Follow</a>
                            <?php } else { }?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php require_once 'includes/footer.php'; ?>