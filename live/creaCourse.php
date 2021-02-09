<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Times - Create Course</title>
</head>

<body>

    <script>
        function success()
        {
        alert("Course Created!"); // this is the message in ""
        }
        function failure()
        {
        alert("Course creation unsuccessful"); // this is the message in ""
        }
    </script>

    <?php

          // Assign the connection to a variable
      $connection = mysqli_connect('localhost', 'root', '', 'taxidb');

      $sql = "INSERT INTO `course`( `AccountID`, `CourseName`, `StartTime`, `EndTime`) VALUES ('" . $_SESSION["usName"] . "','" . $_GET["courseName"] . "','" . $_GET["startTime"] . "','" . $_GET["endTime"] . "')";

      $result = mysqli_query($connection, $sql);

      //If the query returns a result, 
      if (mysqli_affected_rows($connection) != -1) {
        echo '<script>success()</script>';

      }
      //If the insert query fails
      else {
        echo '<script>failure()</script>';
      }

      mysqli_close($connection);

    ?>

</body>

</html>