<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	Dynamos,1234-5678-9012
	<br>
	<?php
		//deal with get parameter
		$userid = $_GET['userid'];
		$time = $_GET['tweet_time'];
		$formatedTime = date("Y-m-d-h-i-s", strtotime($time));
		$user_time = $userid . '-' . $formatedTime;

		//connect to sql
		$con = mysqli_connect("localhost","","", "test");

		// Check connection
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}

		$query = "SELECT * FROM tweet Where user_time = \"" . $user_time . "\";";
		$result = mysqli_query($con,$query);
		if(!$result){
			printf("Error: %s\n", mysqli_error($con));
    		exit();
		}

		while($row = mysqli_fetch_array($result)){
  			echo $row['tweet'] . "<br>";
  		}

mysqli_close($con);
?>
</body>
</html>