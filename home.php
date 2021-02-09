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
    <title>TaxiTimes - Home</title>
</head>

<body>

    <div id="t-container">

    <header>

        <h1> TaxiTimes</h1>

        <nav>
            <ul class="t-nav">
                <li> Home </li>
                <li> <a href="creaChart.php">Chart </a></li>
                <li> <a href="addData.php">Add Data </a></li>
                <li> <a href="vwData.php">View Data </a></li>
            </ul>
        </nav>

    </header>

    <section id="t-body">

        <h1> Home </h1>

        <p> Use the forms below to change your account, or use the heading bar below to use the rest of the program </p>


        <section id="t-content">

            <section id="t-changePass">

                <h2>Change Password</h2>

                <form action="changepassword.php" method="POST">
                    current password:<br>
                    <input type="password" name="cpassword">
                    <br>
                    new password:<br>
                    <input type="password" name="npassword">
                    <br>
                    confirm new password:<br>
                    <input type="password" name="cnpassword">
                    <br><br>
                    <input type="submit" value="Confirm">
                </form>

            </section>
    <?php

            if ($_SESSION["usName"] == "admin"){

                echo"<section id='t-admin'><h2>Admin Section</h2><p>Admins go <a href='adminCreate.php'>here</a></p></section>";
            }

    ?>

        </section>
    </section>
</div>

</body>

</html>