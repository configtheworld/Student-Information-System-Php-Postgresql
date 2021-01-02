<?php

session_start();

require 'config.php';
require 'middleware.php';

if (isset($_SESSION['studentno'], $_SESSION['password'])) {

    //$pg_sq = new pg_query('')
    //$result = pg_query($conn,"SELECT * FROM course")or die($pg_query->error);

    // session check
    if (isset($_SESSION['studentno']) && $_SESSION['user_type'] == "student") {
        header("location:index.php");
    }

    // add post request
    if (isset($_POST['addcourse'])) {


        $coursename = $_POST['coursename'];
        $lecture = $_POST['lecture'];
        $department = $_POST['department'];



        try {
            $pdo = new PDO("pgsql:host=localhost;dbname=STUDENT", "postgres", "$dbpassword");
            $sql_q1 = "INSERT INTO course (coursename, lecture, department) VALUES ('$coursename','$lecture','$department')";
            pg_query($conn, $sql_q1);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        header("location:coursecrud.php");
    }

    // delete course
    if (isset($_POST['deletecourse'])) {
        $coursename = $_POST['coursename'];
        $lecture = $_POST['lecture'];
        $department = $_POST['department'];

        try {
            $pdo = new PDO("pgsql:host=localhost;dbname=STUDENT", "postgres", "$dbpassword");
            $sql_q2 = "DELETE FROM course WHERE coursename='$coursename' AND lecture='$lecture' AND department='$department' ";
            pg_query($conn, $sql_q2);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("location:coursecrud.php");
    }

    // listeleme
    try {
        $pdo = new PDO("pgsql:host=localhost;dbname=STUDENT", "postgres", "$dbpassword");
        $sql = "SELECT * FROM course";
        foreach ($pdo->query($sql) as $row) {
            // print "<br>";
            // print $row['coursename'].'-'.$row['lecturer'].'-'.$row['department'].'<br>';

?>


            <div>

                <table style="border: 1px solid black;">

                    <thead style="border: 1px solid black;">
                        <tr>
                            <th>Course Name</th>
                            <th>Department</th>
                            <th>Lecture</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>


                    <tr style="border: 1px solid black;text-align:center;">
                        <td style="color: black;border: 1px solid black;"><?php echo $row['coursename']; ?></td>
                        <td style="color: green;border: 1px solid black;"><?php echo $row['department']; ?></td>
                        <td style="color: purple;border: 1px solid black;"><?php echo $row['lecture']; ?></td>
                        <td style="color: blue;">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <input type="text" name="coursename" value="<?php echo $row['coursename']; ?>" hidden>
                                <input type="text" name="department" value="<?php echo $row['department']; ?>" hidden>
                                <input type="text" name="lecture" value="<?php echo $row['lecture']; ?>" hidden>
                                <input style="color:white;background-color:red;" type="submit" name="deletecourse" value="DELETE">
                            </form>
                        </td>
                    </tr>

                </table>
            </div>

        <?php   } ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div>
                <input type="text" name="coursename" placeholder="course name">
            </div>
            <div>
                <input type="text" name="lecture" placeholder="lecturer">
            </div>
            <div>
                <input type="text" name="department" placeholder="department">
            </div>
            <div>
                <input style="color:white;background-color:green;" type="submit" name="addcourse" value="ADD">
            </div>
        </form>


<?php 

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

 ?>

<div>

    <a href="profile.php"><button style="font-size:25px;">Go back</button></a>
</div>

<?php
} else {
    header("location:index.php");
    exit;
}
unset($_SESSION['prompt']);
pg_close($conn);

?>