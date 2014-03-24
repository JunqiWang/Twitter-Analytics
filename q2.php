<?php
$GLOBALS ["THRIFT_ROOT"] = $_SERVER ["DOCUMENT_ROOT"] . "/lib/thriftphp";

require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Type/TMessageType.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Type/TType.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Exception/TException.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Factory/TStringFuncFactory.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/StringFunc/TStringFunc.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/StringFunc/Core.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Transport/TTransport.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Transport/TSocket.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Transport/TBufferedTransport.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Protocol/TProtocol.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/lib/Thrift/Protocol/TBinaryProtocol.php");

require_once ($GLOBALS ["THRIFT_ROOT"] . "/packages/Hbase/Hbase.php");
require_once ($GLOBALS ["THRIFT_ROOT"] . "/packages/Hbase/Types.php");

use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use Thrift\Protocol\TBinaryProtocol;
use Hbase\HbaseClient;

$socket = new TSocket ( "54.85.132.133" );
$transport = new TBufferedTransport ( $socket );
$protocol = new TBinaryProtocol ( $transport );
$client = new HbaseClient ( $protocol );

$transport->open ();

$rowkey = $_GET ["userid"] . $_GET ["tweet_time"];

$rowResult = $client->get ( "uidtime2ids", $rowkey, "ids", array () );

echo ("Dynamos,2427-6611-7783\n");
asort($rowResult);
foreach ( $rowResult as $rs ) {
	echo ("$rs->value\n");
}

$transport->close ();

?>
