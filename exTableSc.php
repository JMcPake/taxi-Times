<?php

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

session_start();

//Assign the connection to a variable
$connection = mysqli_connect('localhost','root','','taxidb');

//Assign an SQL Query that gets the username's hashed password from the database to a variable
$sql = "SELECT * FROM school";

//Execute the query
$result = mysqli_query($connection,$sql);

                
if (mysqli_num_rows($result)>0) {

    download_send_headers("data_export_schools" . date("Y-m-d") . ".csv");

    $csvDt = "SchoolID,SchoolName\n";

    while ($row = mysqli_fetch_array($result)) {

        $csvDt .= $row["SchoolID"].",".$row["SchoolName"]."\n";

    }

    echo $csvDt;

    

}
else {

    echo "There are no schools";

}

mysqli_close($connection);

?>