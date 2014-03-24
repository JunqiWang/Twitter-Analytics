<?php

// deal with get parameter
$userid = $_GET ['userid'];
$time = $_GET ['tweet_time'];
$formatedTime = date ( "Y-m-d-h-i-s", strtotime ( $time ) );
$user_time = $userid . '-' . $formatedTime;

// connect to sql
$con = mysqli_connect ( "localhost", "", "", "test" );

$query = "SELECT * FROM tweet WHERE user_time = \"" . $user_time . "\";";
$result = mysqli_query ( $con, $query );

echo ("Dynamos,1234-5678-9012\n");
while ( $row = mysqli_fetch_array ( $result ) ) {
	echo $row ['tweet'] . "\n";
}

mysqli_close ( $con );
?>
