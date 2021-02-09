<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>TaxiTimes - Admin</title>
</head>

<body>

    <div id="t-container">

        <header>

            <h1> TaxiTimes - Create Account </h1>

            <nav>
                <ul class="t-nav">
                    <li> <a href="home.php"> Home </a></li>
                    <li> <a href="creaChart.php">Chart </a></li>
                    <li> <a href="addData.php">Add Data </a></li>
                    <li> <a href="vwData.php">View Data </a></li>
                </ul>
            </nav>

        </header>

        <section id="t-body">

            <h1> Create Account </h1>

            <p> Use the list on your left to see the applicants, and create their accounts on the right </p>


            <section id="t-content">

                <section id="t-a-rlist">

                    <h2>Applicant List</h2>

                    <form method="POST" action="adminDelApplicant.php">
            <?php

                                //Assign the connection to a variable
                $connection = mysqli_connect('localhost', 'root', '', 'taxidb');

                                //Assign an SQL Query that gets the username's hashed password from the database to a variable
                $sql = "SELECT * FROM applicant";

                                //Execute the query
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {

                    echo "<table> <tr> <th> Name </th> <th> Email </th> <th> Delete </th> </tr>";

                    $count = 0;

                    while ($row = mysqli_fetch_array($result)) {
                    $count += 1;

                    echo "<tr> <td>" . $row["applicantName"] . "</td> <td>" . $row["email"] . "</td> <td> <input type='checkbox' name='apply[]' value='" . $row["applicantID"] . "'> </td> </tr>";

                }

                    echo "</table>";

                    echo "<input type='hidden' name='count' value='" . $count . "'>";

                } else {

                    echo "<p> There are no applicants </p>";

                }

                mysqli_close($connection);

            ?>
                        <input type="submit" value="Delete">

                    </form>

                </section>

                <section id="t-a-rform">

                    <h2> Create Account </h2>

                    <form action="createAccount.php" method="POST">

                        AccountID:
                        <input type="text" name="Username">

                        <br>
                        <br> Password:
                        <input type="text" name="Password">

                        <br>
                        <br>

                        <input type="submit" name="Submit">

                    </form>

                </section>
            </section>
        </section>
    </div>
</body>