<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>TaxiTimes - Add Data </title>
</head>

<body>

    <div id="t-container">

        <header>

            <h1> TaxiTimes</h1>

            <nav>
                <ul class="t-nav">
                    <li> <a href="home.php"> Home </a></li>
                    <li> <a href="creaChart.php"> Chart </a></li>
                    <li> Add Data </li>
                    <li> <a href="vwData.php"> View Data </a></li>
                </ul>
            </nav>

        </header>

        <section id="t-body">

            <h1> Add Data </h1>

            <p> Use the forms below to create new courses or classes for courses that belong to you </p>


            <section id="t-content">

                <section id="t-creaCourse">

                    <h2>Create Course</h2>

                    <form action="creaCourse.php" method="GET">
                        Course Name:<br>
                        <input type="text" name="courseName">
                        <br> Start Time:<br>
                        <input type="time" name="startTime">
                        <br> End Time:<br>
                        <input type="time" name="endTime">
                        <br><br>
                        <input type="submit" value="Create Course">
                    </form>

                </section>

                <section id="t-creaClass">

                    <h2> Create Class </h2>

                    <form action="creaClass.php" method="GET">
                        School:<br>
                        <?php
                            //Assign the connection to a variable
                            $connection = mysqli_connect('localhost','root','','taxidb');

                            //Assign an SQL Query that gets the names of schools that have classes to a variable
                            $sql = "SELECT SchoolID, SchoolName FROM `school`";

                            //Execute the query
                            $result = mysqli_query($connection,$sql);

                            
                            if (mysqli_num_rows($result)>0) {

                                echo "<select name='school'>";

                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<option value='".$row["SchoolID"]."'> ".$row["SchoolName"]." </option> ";

                                
                                }

                                echo "</select>";

                            }
                            else {
                                echo "<p> No Schools exist </p>";
                            }
                        ?>
                            <br> Course:
                            <br>
                            <?php
                            //Assign the connection to a variable
                            $connection = mysqli_connect('localhost','root','','taxidb');

                            //Assign an SQL Query that gets the names of schools that have classes to a variable
                            $sql = "SELECT `CourseID`,`CourseName` FROM course, account WHERE course.AccountID = account.AccountID AND course.AccountID ='".$_SESSION["usName"]."'";

                            //Execute the query
                            $result = mysqli_query($connection,$sql);

                            
                            if (mysqli_num_rows($result)>0) {

                                echo "<select name='course'>";

                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<option value='".$row["CourseID"]."'> ".$row["CourseName"]." </option> ";

                                }

                                echo "</select>";

                            }
                            else {
                                echo "<p> No Courses exist </p>";
                            }
                        ?>
                                <br> Arrival Time:<br>
                                <input type="time" name="arvTime">
                                <br> Departure Time:<br>
                                <input type="time" name="depTime">
                                <br> Date:
                                <br>
                                <input type="date" name="clsDate">
                                <br><br>
                                <input type="submit" value="Create Class">
                    </form>

                </section>

                <section id="t-creaSchool">

                    <h2> Create School </h2>

                    <form action="creaSchool.php" method="GET">

                        School Name:<br>
                        <input type="text" name="schoolName">
                        <br><br>
                        <input type="submit" value="Create School">

                    </form>

                </section>

            </section>
        </section>
    </div>

</body>

</html>