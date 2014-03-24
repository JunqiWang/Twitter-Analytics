<?php
$TEAM_ID = "Dynamos";
$AWS_ACC_ID = "9392-2385-3384";
$url = $_GET['url'];

function startsWith($haystack, $needle) {
  return $needle === "" || strpos($haystack, $needle) === 0;
}

/* All Q1 code goes here */
if ($url == "q1") {
  $date = new DateTime();
  $date_string = $date->format("Y-m-d H:i:s");
  echo "$TEAM_ID,$AWS_ACC_ID\n$date_string";
}

/* All Q2 code goes here */
else if (startsWith($url, "q2")) {
  echo "q2";
}

?>
