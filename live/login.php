<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>TaxiTimes - Login</title>
</head>

<body>

    <div id="t-container">

    <header>

        <h1> TaxiTimes </h1>

        <p> Use the forms below to sign in and request an account </p>

    </header>

    <section id="t-content">
    <?php

    //Assign the form variables to PHP Variables
    $uName = $_POST['username'];
    $pWord = $_POST['password'];

      if ($uName != null and $pWord != null) {
          //Assign the connection to a variable
        $connection = mysqli_connect('localhost','root','','taxidb');

        //Assign an SQL Query that gets the username's hashed password from the database to a variable
        $sql = "SELECT AccPassword FROM account WHERE AccountID = '$uName';";

        //Execute the variable
        $result = mysqli_query($connection,$sql);

        //convert the result to an array
        $row = mysqli_fetch_assoc($result);

        //If the hash of the password is the same as the hash stored in the database,
        if (password_verify($pWord,$row["AccPassword"])) {
            session_start();
            //Log that the user logged in
            include_once('function.php');
            $desc = "$uName logged in";
            logAction($uName,$desc);

            $_SESSION["usName"] = $uName;
            $_SESSION["psWord"] = $row["AccPassword"];

            //execute the code to let the user in
            header("Location: home.php");
        } else {
            //Prompt the user that the account dosen't exist
            echo "Sorry, your account details seem to be incorrect. Enter your details again";
        }

        mysqli_close($connection);

      } else {
        echo "You can't leave the form empty";
      }

    ?>

    </section>
    </div>
</body>
</html>