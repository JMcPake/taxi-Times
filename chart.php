<!doctype html>
<html>

<head>
    <title>TaxiTimes - Chart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="scripts/Chart.min.js"></script>
    <script src="scripts/utils.js"></script>
    <style>
        canvas {
        		-moz-user-select: none;
        		-webkit-user-select: none;
        		-ms-user-select: none;
        	}
    </style>
</head>

<body>

    <header>

        <h1> TaxiTimes </h1>

        <nav>
            <ul class="t-nav">
                <li> <a href="home.php"> Home </a></li>
                <li> Chart </li>
                <li> <a href="addData.php">Add Data </a></li>
                <li> <a href="vwData.php">View Data </a></li>
            </ul>
        </nav>

    </header>

    <section id="t-body">

        <h1> Chart </h1>

        <div id="container" style="width: 75%;">
            <canvas id="canvas"></canvas>
        </div>

    </section>

    <script>
		<?php
					//Initialise variables and assign form variables to PHP variables
			$schID = $_GET["school"];
			$crsID = $_GET["Course"];
			$strDt = $_GET["startdate"];
			$endDt = $_GET["enddate"];
			$labels = "";
			$numbers = "";

					//Assign the connection to a variable
			$connection = mysqli_connect('localhost', 'root', '', 'taxidb');

			$sql = "SELECT (EXTRACT(HOUR FROM TIMEDIFF(StartTime, ArrivalTime)) * 60) + (EXTRACT(MINUTE FROM TIMEDIFF(StartTime, ArrivalTime))) + ((EXTRACT(HOUR FROM TIMEDIFF(EndTime, DepartureTime)) * -60) + (EXTRACT(MINUTE FROM TIMEDIFF(EndTime, DepartureTime) * -1))) as TimeLostMin, ClassDate		FROM class, course		WHERE class.CourseID = course.CourseID AND		`SchoolID` = " . $schID . "  AND		class.`CourseID` = " . $crsID . " AND		`ClassDate` BETWEEN CAST('" . $strDt . "' AS DATE) AND CAST('" . $endDt . "' AS DATE)";

					//Execute the query
			$result = mysqli_query($connection, $sql);

					//echo the start  of the chart js code
			echo "var color = Chart.helpers.color;		var horizontalBarChartData = {			labels: [";
							
						//echo the date
						//Format goes 'value','next value'...
			if (mysqli_num_rows($result) > 0) {
				$count = 0;

				while ($row = mysqli_fetch_array($result)) {
					if ($count < sizeof($row)) {
						$labels .= "'" . $row["ClassDate"] . "',";
					} else {
						$labels .= "'" . $row["ClassDate"] . "'";
					}

					$count += 1;
				}

				echo $labels;
			} else {
				echo "Your criteria does not match any classes";
			}

						//echo the next part of the chart js code
			echo "],			datasets: [{				label: '',				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),				borderColor: window.chartColors.red,				borderWidth: 1,				data: [";

			$result = mysqli_query($connection, $sql);
						
						//echo the timelost
						//Format goes value, next value... and they must be integers
			if (mysqli_num_rows($result) > 0) {
				$count = 0;

				while ($row = mysqli_fetch_array($result)) {
					if ($count < sizeof($row)) {
						$numbers .= "'" . $row["TimeLostMin"] . "',";
					} else {
						$numbers .= "'" . $row["TimeLostMin"] . "'";
					}

					$count += 1;
				}

				echo $numbers;
			} else {
				echo "</script> Your criteria does not match any classes <script>";
			}

			echo "]			}]		};";

			mysqli_close($connection);


		?>

        window.onload = function() {
        			var ctx = document.getElementById('canvas').getContext('2d');
        			window.myHorizontalBar = new Chart(ctx, {
        				type: 'horizontalBar',
        				data: horizontalBarChartData,
        				options: {
        					// Elements options apply to all of the options unless overridden in a dataset
        					// In this case, we are setting the border of each horizontal bar to be 2px wide
        					elements: {
        						rectangle: {
        							borderWidth: 1,
        						}
        					},
        					responsive: true,
        					legend: {
								display:false,
        						position: 'right',
        						text: 'Minutes Lost'
        					},
        					title: {
        						display: true,
        						text: 'Total Class Time Lost'
        					}
        				}
        			});
        
        		};
    </script>


</body>

</html>