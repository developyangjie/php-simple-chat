<?php
use Workerman\Worker;
require_once '../../Workerman/Autoloader.php';

// ����һ��Worker����2346�˿ڣ�ʹ��websocketЭ��ͨѶ
$ws_worker = new Worker("websocket://127.0.0.1:2346");

// ����4�����̶����ṩ����
$ws_worker->count = 4;

// ���յ��ͻ��˷��������ݺ󷵻�hello $data���ͻ���
$ws_worker->onMessage = function($connection, $data)
{
	if($data == 1){
		// ��ͻ��˷���hello $data
    $connection->send('fuck u');
	}else{
		$connection->send($data);
	}
    
};

// ����worker
Worker::runAll();