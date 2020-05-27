<?php
    $page="register.php";
    $title="Signup";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(isset($_SESSION['userId'])){
        header('Location: home.php');
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = strtolower(trim($_POST['username']));
        $password = $_POST['password'];

        $result = $user->insertUser($username, $password);
        if(!$result){
            echo '<div class="alert alert-danger">Username already occupied. Please try another username. </div>';
        } else{
        //  $_SESSION['username'] = $username;
        //  $_SESSION['userId'] = $get['id'];
            header('Location: index.php');
        }
    }
?>

    <h1 class="text-center"><?php echo $title;?></h1>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"method="post">
        <table class="table table-sm">
            <tr>
                <td><label for="username">Username: *</label></td>
                <td><input type="text" name="username" id="username" class="form-control" value="<?php if($_SERVER['REQUEST_METHOD'] == "POST") echo $_POST['username']; ?>"></td>
            </tr>
            <tr>
                <td><label for="password">Password: *</label></td>
                <td><input type="password" name="password" id="password" class="form-control" ></td>
            </tr>
        </table><br><br>
        <input type="submit" value="Signup" class="btn btn-primary btn-block"><br>
        <a href="index.php">Already have an account? Login here</a>
    </form>

<?php require_once 'includes/footer.php'; ?>