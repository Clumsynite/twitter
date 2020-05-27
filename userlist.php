<?php
    $page="userlist.php";
    $title="List of Users";
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    
    if(!isset($_SESSION['userId']) && !isset($_SESSION['username'])){
        header('Location: index.php');
    }

    if (isset($_GET['status'])){
        if($_GET['status']=="error"){
            include 'includes/errormessage.php';
        } else  if ($_GET['status']=="flw") {
            include 'includes/successmessage.php';
        }
    }

    $result = $user->getUsers();

?>

<h1 class="text-center"><?php echo $title; ?></h1>
<div class="table-responsive-xl">
        <table class="table table-bordered table-hover table-xl">

            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php while($r = $result->fetch()){ ?>
                <tr>
                    <td><?php echo $r['userID']; ?></td>
                    <td><?php echo $r['username']; ?></td>
                    <td>
                        <a href="profile.php?id=<?php echo $r['username']; ?>" class="btn btn-primary">Visit Profile</a>
                        <a href="following.php?id=<?php echo $r['username']; ?>" class="btn btn-warning">Follow</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

<?php require_once 'includes/footer.php'; ?>