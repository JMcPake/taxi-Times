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

        <section id="t-content">

<?php

session_start();

$currP = $_POST["cpassword"];
$newP = $_POST["npassword"];
$newPConf = $_POST["cnpassword"];
//and $currP != null and $newP!= null and $newPConf != null
if (password_verify($currP, $_SESSION["psWord"]) and $newP == $newPConf) {

        //Assign the connection to a variable
	$connection = mysqli_connect('localhost', 'root', '', 'taxidb');

	$sql = "UPDATE account SET AccPassword = '" . password_hash($newP, PASSWORD_DEFAULT) . "' WHERE AccountID = '" . $_SESSION["usName"] . "';";

	echo $sql;

        //Execute the variable
	$result = mysqli_query($connection, $sql);

	mysqli_close($connection);

        //Assign the connection to a variable
	$connection = mysqli_connect('localhost', 'root', '', 'taxidb');
        
        //Assign an SQL Query that gets the username's hashed password from the database to a variable
	$sql = "SELECT AccPassword FROM account WHERE AccountID = '" . $_SESSION["usName"] . "';";

        //Execute the variable
	$result = mysqli_query($connection, $sql);

        //convert the result to an array
	$row = mysqli_fetch_assoc($result);

	$_SESSION["psWord"] = password_hash($newP, PASSWORD_DEFAULT);

	echo $_SESSION["psWord"];

	mysqli_close($connection);

	header("Location: home.php");
}else {
	//echo "Please do not leave the fields empty";
};

?>

		</section>
	</section>
	</div>
	
</body>
</html>