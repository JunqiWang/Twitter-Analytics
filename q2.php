<?php

$rowkey = $_GET ["userid"] . $_GET ["tweet_time"];

$rowkey = str_replace(" ", "+", $rowkey);
$uri = "http://54.85.217.9:8080/uidtime2ids/" . $rowkey . "/ids";

$ch = curl_init($uri);

curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$data = json_decode(curl_exec($ch), TRUE);
$cols = $data["Row"][0]["Cell"];

echo ("Dynamos,2427-6611-7783\n");
foreach ($cols as $col) {
	echo base64_decode($col["$"]);
}

curl_close($ch);

// $GLOBALS ["THRIFT_ROOT"] = $_SERVER ["DOCUMENT_ROOT"] . "/lib/thriftphp";

// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Type/TMessageType.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Type/TType.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Exception/TException.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Factory/TStringFuncFactory.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/StringFunc/TStringFunc.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/StringFunc/Core.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Transport/TTransport.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Transport/TSocket.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Transport/TBufferedTransport.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Protocol/TProtocol.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Protocol/TBinaryProtocol.php");

// require_once ($GLOBALS ["THRIFT_ROOT"] . "/packages/Hbase/Hbase.php");
// require_once ($GLOBALS ["THRIFT_ROOT"] . "/packages/Hbase/Types.php");

// use Thrift\Transport\TSocket;
// use Thrift\Transport\TBufferedTransport;
// use Thrift\Protocol\TBinaryProtocol;
// use Hbase\HbaseClient;

// $socket = new TSocket ( "54.85.217.9" );
// $transport = new TBufferedTransport ( $socket );
// $protocol = new TBinaryProtocol ( $transport );
// $client = new HbaseClient ( $protocol );

// $transport->open ();

// $rowkey = $_GET ["userid"] . $_GET ["tweet_time"];

// $rowResult = $client->get ( "uidtime2ids", $rowkey, "ids", array () );

// echo ("Dynamos,2427-6611-7783\n");
// asort($rowResult);
// foreach ( $rowResult as $rs ) {
// 	echo ("$rs->value");
// }

// $transport->close ();

?>
