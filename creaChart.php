<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Taxi Times - Create Chart</title>
</head>

<body>

    <div id="t-container">

        <header>

            <h1> TaxiTimes </h1>

            <nav>
                <ul class="t-nav">
                    <li> <a href="home.php"> Home </a></li>
                    <li> Chart </li>
                    <li> <a href="addData.php">Add Data </a></li>
                    <li> <a href="vwData.php">View Data </a></li>
                </ul>
            </nav>

        </header>

        <section id="t-body">

            <h1> Create Chart </h1>

            <p> Fill in the details of the form below to create your chart </p>

            <section id="t-content">

                <form action="chart.php" method="GET">
                    School:<br>

                    <?php
                                    //Assign the connection to a variable
                        $connection = mysqli_connect('localhost', 'root', '', 'taxidb');

                                    //Assign an SQL Query that gets the names of schools that have classes to a variable
                        $sql = "SELECT class.SchoolID, SchoolName FROM `class`,`school` WHERE class.SchoolID = school.SchoolID GROUP BY class.SchoolID";

                                    //Execute the query
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<select name='school'>";

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row["SchoolID"] . "'> " . $row["SchoolName"] . " </option> ";
                            }

                            echo "</select>";
                        } else {
                            echo "<p> No Schools have any classes </p>";
                        }

                        mysqli_close($connection);

                    ?>

                    <br>
                    Course:<br>

                        <?php
                            //Assign the connection to a variable
                            $connection = mysqli_connect('localhost', 'root', '', 'taxidb');

                            //Assign an SQL Query that gets the names of Courses that have classes to a variable
                            $sql = "SELECT class.CourseID, CourseName FROM `class`,`course` WHERE class.CourseID = course.CourseID GROUP BY class.CourseID";

                            //Execute the query
                            $result = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($result) > 0) {
                            echo "<select name='Course'>";

                            $count = 0;

                            while ($row = mysqli_fetch_array($result)) {
                            $count += 1;

                            echo "<option value='" . $row["CourseID"] . "'> " . $row["CourseName"] . " </option> ";
                            }

                            echo "</select>";
                            } else {
                            echo "<p> No Courses have any classes </p>";
                            }

                            mysqli_close($connection);

                        ?>

                    <br>
                    From:
                    <br>
                    <input type="date" name="startdate">
                    <br> To:
                    <br>
                    <input type="date" name="enddate">
                    <br><br>
                    <input type="submit" value="Create Chart">
                </form>

            </section>


        </section>
    </div>

</body>

</html>