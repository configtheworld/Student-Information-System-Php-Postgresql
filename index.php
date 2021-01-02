<?php
session_start();
require_once "config.php";
require "middleware.php";



$msg = "";

if (isset($_POST['login']) && !empty($_POST['login'])) {
    $studentno = trim_modified($_POST['studentno']);
    $password = md5(trim_modified($_POST['password']));
    $user_type = trim_modified($_POST['user_type']);

    $sql = "SELECT * FROM public.student WHERE studentno='$studentno' AND password='$password' AND user_type='$user_type' ";
    $data = pg_query($conn, $sql);
    $login_check = pg_num_rows($data);
    if ($login_check > 0) {

        session_regenerate_id();
        $_SESSION['studentno'] = $studentno;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['password'] = $password;
        session_write_close();

        echo "login success";
        header("location:profile.php");
        exit;
    } else {
        echo "login failed";
        $_SESSION['errprompt'] = "Wrong username or password.";
        exit;
    }
}
if (!isset($_SESSION['studentno'], $_SESSION['password'])) {
?>



    <div style="font-size: 21px;text-align:center;">

        <h1>Login Form</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div>
                <label>Student Number</label>
                <input type="text" name="studentno" placeholder="student number" required>
            </div>
            <div>
                <label for="usertype">You are a:</label>
                <input type="radio" name="user_type" value="student" required>&nbsp;Student|
                <input type="radio" name="user_type" value="admin" required>&nbsp;Admin
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" placeholder="your password" pattern="(?=.*[a-z])(?=.*[A-Z]).{6,}" maxlength="40" required>
            </div>
            <small><em>Required:At least one small letter, one capital letter and minimum 6 characters</em>
            </small>
            <div>
                <input style="font-size:25px;" type="submit" name="login" value="Login">
            </div>

        </form>
        <p> If you dont have an account register <a href="register.php"><button style="font-size:15px;">Here!</button></a></p>
    </div>






<?php
} else {
    header("location:profile.php");
    exit;
}
unset($_SESSION['prompt']);
unset($_SESSION['errprompt']);
pg_close($conn);

?>