<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Times - Create Class</title>
</head>

<body>

    <script>
        function success()
        {
        alert("Class Created!"); // this is the message in ""
        }
        function failure()
        {
        alert("Class creation unsuccessful"); // this is the message in ""
        }
    </script>

    <?php

      // Assign the connection to a variable
      $connection = mysqli_connect('localhost', 'root', '', 'taxidb');

      $sql = "INSERT INTO `class`(`CourseID`, `SchoolID`, `ArrivalTime`, `DepartureTime`, `ClassDate`) VALUES ('" . $_GET["course"] . "','" . $_GET["school"] . "','" . $_GET["arvTime"] . "','" . $_GET["depTime"] . "','" . $_GET["clsDate"] . "')";

      $result = mysqli_query($connection, $sql);

      //If the query returns a result, 
      if (mysqli_affected_rows($connection) != -1) {
      echo '<script>success()</script>';
      }
      //If the insert query fails
      else {
      echo '<script>failure()</script>';
      };

      mysqli_close($connection);

    ?>

</body>

</html>