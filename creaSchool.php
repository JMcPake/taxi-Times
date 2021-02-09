<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Times - Create School</title>
</head>

<body>

    <script>
        function success()
        {
        alert("School Created!"); // this is the message in ""
        }
        function failure()
        {
        alert("School creation unsuccessful"); // this is the message in ""
        }
    </script>

    <?php

      if ($_GET["schoolName"] != null) {

          //Assign the connection to a variable
        $connection = mysqli_connect('localhost', 'root', '', 'taxidb');

        $sql = "INSERT INTO `school`(`SchoolName`) VALUES ('" . $_GET["schoolName"] . "')";

        $result = mysqli_query($connection, $sql);

        //If the query returns a result, 
        if (mysqli_affected_rows($connection) != -1) {
          echo '<script>success()</script>';

        }

        //If the insert query fails
        else {
          echo '<script>failure()</script>';
        };

      } else {
        echo '<script>failure()</script>';
      }
      
    ?>

</body>

</html>