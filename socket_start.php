<?php
use Workerman\Worker;
use Workerman\WebServer;
use Workerman\Autoloader;
use PHPSocketIO\SocketIO;
require_once join(DIRECTORY_SEPARATOR, array(__DIR__, "vendor", "autoload.php"));

$io = new SocketIO(3000);
$io->on('connection', function($socket) use ($io){

    $socket->on('send message', function($msg) use ($io){
        $io->emit('tiempo real', $msg);
    });
});

Worker::runAll();
