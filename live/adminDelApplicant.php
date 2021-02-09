<?php
  $applicants = $_POST['apply'];
  if (empty($applicants)) {
    header("location: adminCreate.php");
  } else {
    $N = count($applicants);
  
    $labels = "";
  
    for ($i = 0; $i < $N; $i++) {
      if ($i + 1 < $N) {
        $labels .= "`applicantID` = " . $applicants[$i] . " OR ";
      } else {
        $labels .= "`applicantID` = " . $applicants[$i];
      }
    }
  
      // Assign the connection to a variable
    $connection = mysqli_connect('localhost', 'root', '', 'taxidb');
  
    $sql = "DELETE FROM `applicant` WHERE " . $labels;
  
    $result = mysqli_query($connection, $sql);

    mysqli_close($connection);
  
    header("location: adminCreate.php");
  }
?>