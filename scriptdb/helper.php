<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "GreenHouse";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM sensor_current_value";
	$result = $conn->query($sql);
	$json = array();
	
	while($row = mysqli_fetch_array($result))     
	{
		$details = array(
			'title' => $row['title'],
			'value' => $row['value'],
			'good_value' => $row['good_value'],
			'good_tollerance' => $row['good_tollerance'],
			'min_value' => $row['min_value'],
			'max_value' => $row['max_value'],
			'measure' => $row['measure'],
			);
						
		array_push($json, $details);
	}

	echo json_encode($json);
	
	$conn->close();
?>