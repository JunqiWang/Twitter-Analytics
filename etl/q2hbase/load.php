<?php
$GLOBALS ['THRIFT_ROOT'] = '/Users/JunqiWang/CMU/DevelopmentKit/thrift-0.9.1/lib/php';

require_once ($GLOBALS ['THRIFT_ROOT'] . '/src/Thrift.php');

require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Type/TMessageType.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Type/TType.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Exception/TException.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Exception/TTransportException.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Exception/TProtocolException.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Factory/TStringFuncFactory.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/StringFunc/TStringFunc.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/StringFunc/Core.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Transport/TTransport.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Transport/TSocket.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Transport/TBufferedTransport.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Protocol/TProtocol.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/lib/Thrift/Protocol/TBinaryProtocol.php');

require_once ($GLOBALS ['THRIFT_ROOT'] . '/packages/Hbase/Hbase.php');
require_once ($GLOBALS ['THRIFT_ROOT'] . '/packages/Hbase/Types.php');

use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use Thrift\Protocol\TBinaryProtocol;
use Hbase\HbaseClient;
use Hbase\ColumnDescriptor;
use Hbase\Mutation;

$socket = new TSocket ( 'ec2-54-84-13-192.compute-1.amazonaws.com' );
$socket->setSendTimeout ( 10000 ); // Ten seconds (too long for production, but this is just a demo ;)
$socket->setRecvTimeout ( 20000 ); // Twenty seconds
$transport = new TBufferedTransport ( $socket );
$protocol = new TBinaryProtocol ( $transport );
$client = new HbaseClient ( $protocol );
$transport->open ();

$table = 'uidtime2ids';
$filename = '/Users/JunqiWang/CMU/workspace/J2SE/15619/o.o';
$dummy_attributes = array ();
$fh = fopen ( $filename, 'r' );

$cn = 0;
while ( ! feof ( $fh ) ) {
	$line = fgets ( $fh );
	$line = split ( "\t", $line );
	
	$rowResult = $client->get ( $table, $line [0], 'ids', $dummy_attributes );
	$id = sizeof ( $rowResult );
	
	$mutations = array (
			new Mutation ( array (
					'column' => 'ids:id' . $id,
					'value' => $line [1] 
			) ) 
	);
	$client->mutateRow ( $table, $line [0], $mutations, $dummy_attributes );
	
	$cn ++;
	if ($cn % 10000 == 0)
		echo ($cn . "\n");
}

$transport->close ();

?>
