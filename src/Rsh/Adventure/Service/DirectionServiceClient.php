<?php
namespace Rsh\Adventure\Service;

use Rsh\Adventure\Thrift\DirectionServiceClient as ThriftDirectionServiceClient;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TSocket;


class DirectionServiceClient
{

    public static function create()
    {

        $socket = new TSocket('djangoscenes_web_1', 9090);

        $transport = new TBufferedTransport($socket, 1024, 1024);
        $protocol = new TBinaryProtocol($transport);
        $client = new ThriftDirectionServiceClient($protocol);

        $transport->open();
        return $client;
    }
}