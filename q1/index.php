<?php

$d = new DateTime ();
$d->setTimezone(new DateTimeZone('America/New_York'));
echo "Dynamos,2427-6611-7783\n" . $d->format ( "Y-m-d H:m:s" );

?>
