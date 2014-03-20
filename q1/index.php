<?php
date_default_timezone_set ( "GMT" );
$d = new DateTime ();
echo "Dynamos,0000-0000-0000\n" . $d->format ( "Y-m-d H:m:s" ) . "\n";
?>
