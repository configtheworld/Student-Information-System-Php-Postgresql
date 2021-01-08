<?php
// PROFILE MODULE CONTAINS STUDENT VIEW AND ADMIN VIEW PROFILE DASHBOARD

session_start();

require 'config.php';


if (isset($_SESSION['studentno'], $_SESSION['password'])) {

   

        if (isset($_POST['logout'])) {
            session_destroy();
            header("location:index.php");
            exit;
        }
    

?>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
    </head>

    <body>


        <div style="font-size: 18px;text-align:center;">

            <div style="margin-top:0px;width:100%;">
                <?php if (isset($_SESSION['studentno'], $_SESSION['password'])) { ?>

                <div style="margin-top:0px;width:100%;">
                    <form method="POST">
                        <?php if (isset($_SESSION['studentno'], $_SESSION['password'])) { ?>
                         <!-- <input type="submit" name="logout" class="btn btn-primary" value="Log Out"> -->
                        <p>User View (logged in)<button style="font-size:25px;" type="submit" name="logout">LogOut</button></p>
                        <?php } ?>
                    </form>
                </div>




                <?php } else { ?>

                    <p> Guest view, In order to make operations please login </p>

                <?php } ?>
            </div>



            <?php if (isset($_SESSION['studentno']) && $_SESSION['user_type'] == "student") { ?>
                <div>
                    <h1>Profile</h1>
                    <div>
                        <h3>
                            Student Number is <?= $_SESSION['studentno'] ?>
                        </h3>
                    </div>
                </div>
                <div>
                    <h1>Add-Drop Courses(student)</h1>

                    <!--YOUR COURSES-->
                    <div style="border: 1px solid black;">
                        <h1>Your Courses</h1>

                        <!--ENROLLED COURSES LISTED-->
                        <div style="font-size: 18px;align-items:center;">
                            <table style="font-size: 18px;text-align:center;">
                                <thead style="border: 1px solid black;">
                                    <tr style="border: 1px solid black;">
                                        <th>You Enrolled These Courses</th>
                                    </tr>
                                </thead>

                                <?php
                                // listeleme
                                try {
                                    $no = $_SESSION['studentno'];
                                    $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");
                                    $sql = "SELECT * FROM enrollment WHERE studentno='$no'";
                                    foreach ($pdo->query($sql) as $row) {
                                ?>

                                        <tr style="border: 1px solid black;text-align:center;">
                                            <td style="color: black;border: 1px solid black;"><?php echo $row['coursename']; ?></td>
                                        </tr>


                                <?php
                                    }
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                }
                                ?>
                            </table>
                        </div>

                    </div>


                    <div style="border: 1px solid black;">
                        <h1>Available Courses</h1>
                        <table>

                            <thead style="border: 1px solid black;">
                                <tr style="border: 1px solid black;">
                                    <th>Course Name</th>
                                    <th>Department</th>
                                    <th>Lecture</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>


                            <?php
                            // listeleme
                            try {
                                $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");
                                $sql = "SELECT * FROM course";
                                foreach ($pdo->query($sql) as $row) {
                            ?>

                                    <tr style="border: 1px solid black;text-align:center;">
                                        <td style="color: black;border: 1px solid black;"><?php echo $row['coursename']; ?></td>
                                        <td style="color: green;border: 1px solid black;"><?php echo $row['department']; ?></td>
                                        <td style="color: purple;border: 1px solid black;"><?php echo $row['lecture']; ?></td>

                                    </tr>


                            <?php
                                }
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                            ?>
                        </table>
                        <a href="coursecrud.php"><button style="font-size:25px;">Add - Drop</button></a>
                    </div>

                </div>



            <?php } else if (isset($_SESSION['studentno']) && $_SESSION['user_type'] == "admin") { ?>

                <!--admin -->
                <div>
                    <h1>Profile</h1>
                    <div>
                        <h3>
                            Admin Number is <?= $_SESSION['studentno'] ?>
                        </h3>
                    </div>
                </div>

                <div style="border: 1px solid black;">

                    <h1>Create-Delete-Edit Courses(Admin)</h1>
                    <table>
                        <thead style="border: 1px solid black;">
                            <tr style="border: 1px solid black;">
                                <th>Course Name</th>
                                <th>Department</th>
                                <th>Lecture</th>
                            </tr>
                        </thead>


                        <?php
                        // listeleme
                        try {
                            $pdo = new PDO("pgsql:host=localhost;dbname=$dbname", "$user", "$dbpassword");
                            $sql = "SELECT * FROM course";
                            foreach ($pdo->query($sql) as $row) {
                        ?>

                                <tr style="border: 1px solid black;text-align:center;">
                                    <td style="color: black;border: 1px solid black;"><?php echo $row['coursename']; ?></td>
                                    <td style="color: green;border: 1px solid black;"><?php echo $row['department']; ?></td>
                                    <td style="color: purple;border: 1px solid black;"><?php echo $row['lecture']; ?></td>

                                </tr>


                        <?php
                            }
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                        }
                        ?>
                    </table>


                    <a href="coursecrud.php"><button style="font-size:25px;">Manage Courses</button></a>

                </div>
            <?php } else {
                echo ("how did u passed the auth");
            }
            ?>

        </div>




    </body>

    </html>

<?php


} else {
    header("location:index.php");
    exit;
}
unset($_SESSION['prompt']);
pg_close($conn);


?>