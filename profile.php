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


    $result = $crud->getTweetByAuthor($_GET['id']);
    while($r = $result->fetch(PDO::FETCH_ASSOC)){
?>
    <div class="card border-primary mb-3">
    <div class="card-body">
        <h5 class="card-title"><?php echo $r['authorName']; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $r['created']; ?></h6>
        <p class="card-text"><?php echo $r['body']; ?></p>
    </div>
    </div>
<?php } require_once 'includes/footer.php'; ?>