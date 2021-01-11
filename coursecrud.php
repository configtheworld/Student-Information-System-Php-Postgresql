<?php
// THIS MODULE SHOW ADD DROP COURSE OPERATIONS FOR STUDENT
//  SHOWS CREATE-DELETE COURSE OPERATIONS FOR ADMIN
session_start();

require 'config.php';

if (isset($_SESSION['studentno'], $_SESSION['password'])) {


 if (isset($_SESSION['studentno']) && $_SESSION['user_type'] == "admin") { 

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

            $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");

            $sql_q1 = "INSERT INTO course (coursename, lecture, department) VALUES ('$coursename','$lecture','$department')";
            // pg_query($conn, $sql_q1);
            pg_prepare($conn, "my_query", $sql_q1);
            pg_execute($conn, "my_query", array());
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

            $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");

            $sql_q2 = "DELETE FROM course WHERE coursename='$coursename' AND lecture='$lecture' AND department='$department' ";
            // pg_query($conn, $sql_q2);
            pg_prepare($conn, "my_query", $sql_q2);
            pg_execute($conn, "my_query", array());
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("location:coursecrud.php");
    }

    // listeleme
    try {

        $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");

        $sql = "SELECT * FROM course";
        foreach ($pdo->query($sql) as $row) {
            

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


    } else if(isset($_SESSION['studentno']) && $_SESSION['user_type'] == "student") {


    // add post request
    if (isset($_POST['enroll'])) {


        $coursename = $_POST['coursename'];
        $studentno = $_POST['studentno'];


        try {

            $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "postgres", "$dbpassword");
            $sql_q1 = "INSERT INTO enrollment (coursename, studentno) VALUES ('$coursename','$studentno')";
            // pg_query($conn, $sql_q1);
            pg_prepare($conn, "my_query", $sql_q1);
            pg_execute($conn, "my_query", array());

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        flashS("successfully added");
        header("location:coursecrud.php");
    }

    // delete course
    if (isset($_POST['drop'])) {
        $coursename = $_POST['coursename'];
        $studentno = $_POST['studentno'];

        try {

            $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "postgres", "$dbpassword");
            $sql_q2 = "DELETE FROM enrollment WHERE coursename='$coursename' AND studentno='$studentno' ";
            // pg_query($conn, $sql_q2);
            pg_prepare($conn, "my_query", $sql_q2);
            pg_execute($conn, "my_query", array());

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        flashS("successfully deleted");
        header("location:coursecrud.php");
    }

    // listeleme
    try {

        $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");
        $sql = "SELECT * FROM course";

        foreach ($pdo->query($sql) as $row) {
            $enrolled = False;

            //ders kontrol
            try {
                $no = $_SESSION['studentno'];
                $coursename = $row['coursename'];

                $pdo1 = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");

                $sql1 = "SELECT * FROM enrollment WHERE studentno='$no' AND coursename='$coursename' ";
                foreach ($pdo1->query($sql1) as $row1) {

                    $enrolled = True;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
?>

            <div>

                <table>

                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Department</th>
                            <th>Lecture</th>
                            <th colspan="2">ADD-DROP ACTIONS</th>
                        </tr>
                    </thead>


                    <tr>
                        <td style="color: black;"><?php echo $row['coursename']; ?></td>
                        <td style="color: green;"><?php echo $row['department']; ?></td>
                        <td style="color: purple;"><?php echo $row['lecture']; ?></td>


                        <td style="color: green;font-size:18px;">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <input type="text" name="coursename" value="<?php echo $row['coursename']; ?>" hidden>
                                <input type="text" name="studentno" value="<?php echo $_SESSION['studentno']; ?>" hidden>

                                <div>
                                    <?php if (!$enrolled) { ?>
                                        <input style="color:white;background-color:green;" type="submit" name="enroll" value="ADD">
                                    <?php } else {
                                        echo 'ENROLLED';
                                    } ?>
                                </div>
                            </form>
                        </td>
                        <td style="color: orange;">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <input type="text" name="coursename" value="<?php echo $row['coursename']; ?>" hidden>
                                <input type="text" name="studentno" value="<?php echo $_SESSION['studentno']; ?>" hidden>

                                <div>
                                    <?php if ($enrolled) { ?>
                                        <input style="color:white;background-color:red;" type="submit" name="drop" value="DROP">
                                    <?php } ?>
                                </div>
                            </form>
                        </td>

                    </tr>

                </table>
            </div>



    <?php }
    } catch (PDOException $e) {
        echo $e->getMessage();
    } ?>

    <div>

        <a href="profile.php"><button style="font-size:25px;">Go back</button></a>
    </div>

<?php

    }// student

    // neither student nor admin can do crud operations login again

} else {
    header("location:index.php");
    exit;
}

unset($_SESSION['prompt']);
pg_close($conn);

?>
