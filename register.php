<?php
session_start();
require_once "config.php";
require "middleware.php";


$randomNum = "181" . substr(str_shuffle("0123456789"), 0, 6);



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

    $ret = pg_query($conn, $sql);
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


if (!isset($_SESSION['studentno'], $_SESSION['password'])) {
?>


    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
    </head>

    <body>


        <div style="font-size: 21px;text-align:center;">
            <h1>Registration Form</h1>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div>
                    <label>Student Number</label>
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


    </body>

    </html>


<?php
} else {
    header("location:profile.php");
    exit;
}
unset($_SESSION['errprompt']);
pg_close($conn);

?>