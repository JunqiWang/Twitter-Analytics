<?php
$GLOBALS["THRIFT_ROOT"] = "thriftphp";
require_once ($GLOBALS["THRIFT_ROOT"] . "/src/Thrift.php");

require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Type/TMessageType.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Type/TType.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Exception/TException.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Exception/TTransportException.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Exception/TProtocolException.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Factory/TStringFuncFactory.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/StringFunc/TStringFunc.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/StringFunc/Core.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Transport/TTransport.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Transport/TSocket.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Transport/TBufferedTransport.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Protocol/TProtocol.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/lib/Thrift/Protocol/TBinaryProtocol.php");

require_once ($GLOBALS["THRIFT_ROOT"] . "/packages/Hbase/Hbase.php");
require_once ($GLOBALS["THRIFT_ROOT"] . "/packages/Hbase/Types.php");

use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Exception;
use Hbase\HbaseClient;
use Hbase\ColumnDescriptor;
use Hbase\Mutation;

    public static $table = "uidtime2ids";

    public static $dummy_attributes = array();

    private $tee;

        
        $socket = new TSocket("localhost");
        $socket->setSendTimeout(2000);
        $socket->setRecvTimeout(4000);
        $transport = new TBufferedTransport($socket);
        $protocol = new TBinaryProtocol($transport);
        $client = new HbaseClient($protocol);
        
        $transport->open();
        
        $rowkey = $this->_request->getParam("userid") . $this->_request->getParam("tweettime");
        $rowResult = $client->get(self::$table, $rowkey, "ids", self::$dummy_attributes);
        $this->printBack($rowResult);
        
        $transport->close();
    }

    private function printBack($rowresult)
    {
        echo ("Dynamos,0000-0000-0000\n");
        foreach ($rowresult as $rs) {
            echo ("$rs->value\n");
        }
    }
}
?>
