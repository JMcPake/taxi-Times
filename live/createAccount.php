<?php

function export_txt($mydata)
{
	$myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $mydata);
	fclose($myfile);
}

//Assign the name and email from the form into their own variables
$uName = $_POST['Username'];
$pWord = $_POST['Password'];

//hash the password
$hash = password_hash($pWord, PASSWORD_DEFAULT);

// Assign the connection to a variable
$connection = mysqli_connect('localhost', 'root', '', 'taxidb');

//Run a query to create the account
$sql = "INSERT INTO `account`(`AccountID`, `AccPassword`) VALUES ('$uName','$hash')";

$result = mysqli_query($connection, $sql);

//If the query returns a result, 
if (mysqli_affected_rows($connection) != -1) {
	echo "'$uName' was created";

    //Log the account being created
	include_once('function.php');
	$desc = "$uName had their account created";
	logAction($uName, $desc);

    //Save a txt file of the username and password (This would otherwise be an email)
	$mydata = "\n";
	$mydata = $mydata . $uName . " " . $pWord . "\n";

	export_txt($mydata);

	header("Location: adminCreate.php");
}
//If the insert query fails
else {
	echo "Register Unsuccesful";
};

mysqli_close($connection);

?>