<?php

session_start();

require 'config.php';
require 'middleware.php';

if (isset($_SESSION['studentno'], $_SESSION['password'])) {


    // add post request
    if (isset($_POST['enroll'])) {


        $coursename = $_POST['coursename'];
        $studentno = $_POST['studentno'];


        try {
            $pdo = new PDO("pgsql:host=localhost;dbname=STUDENT", "postgres", "$dbpassword");
            $sql_q1 = "INSERT INTO enrollment (coursename, studentno) VALUES ('$coursename','$studentno')";
            pg_query($conn, $sql_q1);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        flashS("successfully added");
        header("location:adddropcrud.php");
    }

    // delete course
    if (isset($_POST['drop'])) {
        $coursename = $_POST['coursename'];
        $studentno = $_POST['studentno'];

        try {
            $pdo = new PDO("pgsql:host=localhost;dbname=STUDENT", "postgres", "$dbpassword");
            $sql_q2 = "DELETE FROM enrollment WHERE coursename='$coursename' AND studentno='$studentno' ";
            pg_query($conn, $sql_q2);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        flashS("successfully deleted");
        header("location:adddropcrud.php");
    }

    // listeleme
    try {
        $pdo = new PDO("pgsql:host=localhost;dbname=STUDENT", "postgres", "$dbpassword");
        $sql = "SELECT * FROM course";
        foreach ($pdo->query($sql) as $row) {
            $enrolled = False;

            //ders kontrol
            try {
                $no = $_SESSION['studentno'];
                $coursename = $row['coursename'];
                $pdo1 = new PDO("pgsql:host=localhost;dbname=STUDENT", "postgres", "$dbpassword");
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

} else {
    header("location:index.php");
    exit;
}
unset($_SESSION['prompt']);
pg_close($conn);

?>