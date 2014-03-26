<?php
$rowkey = $_GET ["userid"] . $_GET ["tweet_time"];

$rowkey = str_replace ( " ", "+", $rowkey );
// change the addr
$uri = "http://54.85.217.9:8080/uidtime2ids/" . $rowkey . "/ids";

$ch = curl_init ( $uri );

curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
		"Accept: application/json" 
) );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );

$data = json_decode ( curl_exec ( $ch ), TRUE );
$cols = $data ["Row"] [0] ["Cell"];

echo ("Dynamos,2427-6611-7783\n");
foreach ( $cols as $col ) {
	echo base64_decode ( $col ["$"] );
}

curl_close ( $ch );

?>
