<?php

function logAction ($accID,$desc) {
    
    //create a connection to the taxidb
    $connection = mysqli_connect('localhost','root','','taxidb');

    //Store the current date and time into a variable
    $time = date("Y-m-d H:i:s");
    //Insert the account ID and time, as well as the description of the event into the log table
    $sql = "INSERT INTO `log`( `AccountID`, `logTime`, `description`) VALUES ('$accID','$time','$desc')";

    //Execute the query
    $result = mysqli_query($connection,$sql);

    //Close the connection
    mysqli_close($connection);

}

?>