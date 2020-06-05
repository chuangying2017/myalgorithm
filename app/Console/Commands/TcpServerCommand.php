<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TcpServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:tcp_server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'swoole tcp test connect';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //创建Server对象，监听 127.0.0.1:9501端口
        $serv = new \Swoole\Server('0.0.0.0','9501');
        //监听连接进入事件
        $serv->on('Connect', function($server,$fd){
            echo "Client Connect .\n ".$fd;
        });
        //监听数据接收事件
        $serv->on('Receive', function($serv, $fd, $from_id, $data){
            $serv->send($fd, "hello, i m send message :-".$data);
        });
        //监听连接关闭事件
        $serv->on('Close', function($serv, $fd){
            echo "Server:close ". $fd;
        });
        //启动服务器
        $serv->start();
    }
}
