<?php
    $page="userlist.php";
    $title="List of Users";
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    
    if(!isset($_SESSION['userId']) && !isset($_SESSION['username'])){
        header('Location: index.php');
    }

    $result = $user->getUsers($_SESSION['username']);

?>

<h1 class="text-center"><?php echo $title; ?></h1>
<div class="table table-responsive">
        <table class="table table-bordered table-hover table-xl table-responsive-xl text-center">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($r = $result->fetch()){ ?>
                    <tr>
                        <td><?php echo $r['username']; ?></td>
                        <td >
                            <a href="profile.php?id=<?php echo $r['username']; ?>" class="btn btn-primary">Visit Profile</a>
                            <?php
                                $followState = $follow->checkFollowState($r['username'], $_SESSION['username']); 
                                if (!$followState){
                            ?>
                                <a href="following.php?id=<?php echo $r['username']; ?>" class="btn btn-success">Follow</a>
                            <?php } else {?>
                                <a href="unfollow.php?id=<?php echo $r['username']; ?>" class="btn btn-danger">Unfollow</a>
                            <?php }  ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php require_once 'includes/footer.php'; ?>