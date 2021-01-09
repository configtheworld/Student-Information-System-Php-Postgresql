<?php
// İNDEX FILE CONTAINS LOGIN AND REGISTRATION PROPERTIES


session_start();
require "config.php";

// registration page pop up
$flag = false;
if (isset($_POST['click'])) {
    $flag = true;
}
if (isset($_POST['click1'])) {
    $flag = false;
}

$msg = "";
$randomNum = "181" . substr(str_shuffle("0123456789"), 0, 6);

if (!isset($_SESSION['studentno'], $_SESSION['password'])) {

    // login post

    if (isset($_POST['login']) && !empty($_POST['login'])) {
        $studentno = trim_modified($_POST['studentno']);
        $password = md5(trim_modified($_POST['password']));
        $user_type = trim_modified($_POST['user_type']);

        $sql = "SELECT * FROM public.student WHERE studentno='$studentno' AND password='$password' AND user_type='$user_type' ";

        // $data = pg_query($conn, $sql);
        $user = pg_prepare($conn, "my_query", $sql);
        $data = pg_execute($conn, "my_query", array());

        $login_check = pg_num_rows($data);
        if ($login_check > 0) {

            session_regenerate_id();
            $_SESSION['studentno'] = $studentno;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['password'] = $password;
            session_write_close();


            header("location:profile.php");
            exit;
        } else {
            $msg = "Wrong username or password";
            $_SESSION['errprompt'] = "Wrong username or password.";
        }
    }

    // register pop up
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {





        $studentNo = trim_modified($_POST['studentNo']);
        $fullname = trim_modified($_POST['fullname']);
        $user_type = trim_modified($_POST['user_type']);
        $password = md5(trim_modified($_POST['password']));
        $department = trim_modified($_POST['department']);
        $year = trim_modified($_POST['year']);


        $query = "";
        $query .= "('$fullname','$department', '$year','$password', '$studentNo','$user_type')";

        $sql = "INSERT INTO public.student(fullname, department, year, password,studentno, user_type)VALUES" . $query;


        // $ret = pg_query($conn, $sql);
        $user = pg_prepare($conn, "my_query", $sql);
        $ret = pg_execute($conn, "my_query", array());
        if ($ret) {

            $_SESSION['prompt'] = "Account registered. You can now log in.";
            // echo "Account registered. You can now log in.";
            header("location:index.php");
            exit;
        } else {


            echo "Something Went Wrong";
        }
    } else {

        $_SESSION['errprompt'] = "That student number already exists.";
    }



?>



    <div style="font-size: 21px;text-align:center;">

        <h1>Login Form</h1>
        <div>
            <h5><?= $msg ?></h5>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div>

                <label>User Number</label>
                <input type="number" name="studentno" placeholder="student number" required>

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

        <p> If you dont have an account register

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <button name="click" style="font-size:15px;">Here!</button>
        </form>

        </p>

    </div>

    <?php
    if ($flag == true) {
    ?>


        <div style="font-size: 21px;text-align:center;">
            <h1>Registration Form</h1>

            <p> 
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <button name="click1" style="font-size:15px;">Close registration form</button>
    </form>
        </p>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div>
                    <label>User Number(Copy it, do not forget)</label>

                    <input type="text" name="studentNo" value='<?= $randomNum ?>' readonly>
                </div>
                <div>
                    <label>Full Name</label>
                    <input type="text" name="fullname" placeholder="ex. Maurice Ravel" required>
                </div>
                <div>
                    <label for="department">Choose a department:</label>
                    <select id="department" name="department" required>
                        <option value="Computer Engineering">Computer Engineering</option>
                        <option value="Civil Engineering">Civil Engineering</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                        <option value="Electrical Engineering">Electrical Engineering</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label for="usertype">You are a:</label>
                    <input type="radio" name="user_type" value="student" required>&nbsp;Student|
                    <input type="radio" name="user_type" value="admin" required>&nbsp;Admin
                </div>
                <div>
                    <label for="year">First registered year:</label>
                    <select id="year" name="year" required>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="your password" pattern="(?=.*[a-z])(?=.*[A-Z]).{6,}" maxlength="40" required>
                    <br>
                    <small><em>Required:At least one small letter, one capital letter and minimum 6 characters</em>
                    </small>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </form>

        </div>

    <?php
    } else {
    ?>

        <div></div>

    <?php
    }

    ?>




<?php
} else {
    header("location:profile.php");
    exit;
}
unset($_SESSION['prompt']);
unset($_SESSION['errprompt']);
pg_close($conn);

?>