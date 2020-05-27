<?php
    $page="index.php";
    $title="Login";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(isset($_SESSION['userId'])){
        header('Location: home.php');
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = strtolower(trim($_POST['username']));
        $password = $_POST['password'];

        $new_password = md5($password. $username);

        $result = $user->getUser($username, $new_password);
        $id = $user->getUserID($username, $new_password);
        
        if(!$result){
            echo '<div class="alert alert-danger">Username or Password is incorrect! Please try again later. </div>';
        } else{
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $result['userID'];
        
        header('Location: home.php');
        }
    }
?>

    <h1 class="text-center"><?php echo $title; ?></h1>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"method="post">
        <table class="table table-sm">
            <tr>
                <td><label for="username">Username: *</label></td>
                <td><input type="text" name="username" id="username" class="form-control" value="<?php if($_SERVER['REQUEST_METHOD'] == "POST") echo $_POST['username']; ?>"></td>
            </tr>
            <tr>
                <td><label for="password">Password: *</label></td>
                <td><input type="password" name="password" id="password" class="form-control"></td>
            </tr>
        </table><br><br>
        <input type="submit" value="Login" class="btn btn-primary btn-block"><br>
        <a href="register.php">No account? Register here</a>
        <a href="#" style="float:right;"> Forgot Password</a>
    </form>

<?php require_once 'includes/footer.php'; ?>