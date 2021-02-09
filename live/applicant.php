<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>TaxiTimes - Apply</title>
</head>


<body>

<header>

        <h1> TaxiTimes </h1>

        <p> Apply for an account with our admin  </p>

    </header>

    <section id="t-content">

        <?php
            //Assign the name and email from the form into their own variables
            $uName = $_POST['Name'];
            $email = $_POST['Email'];

            if ($uName != null and $email != null) {

                // Assign the connection to a variable
                $connection = mysqli_connect('localhost', 'root', '', 'taxidb');

                //Assign the insert query into a varaible
                $sql = "INSERT INTO `applicant`(`applicantName`, `email`) VALUES ('$uName','$email')";

                $result = mysqli_query($connection, $sql);
                
                //If the query returns a result, 
                if (mysqli_affected_rows($connection) != -1) {
                    echo "You have requested your account, '$uName'";

                    include_once('function.php');
                    $desc = "$uName sent an application for an acount";
                    logAction($uName, $desc);
                }
                //If the insert query fails
                else {
                    echo "Register Unsuccesful";
                };

                mysqli_close($connection);
                
            } else {
                echo "You can't leave the form empty";
            };
        ?>

    </section>

</body>

</html>