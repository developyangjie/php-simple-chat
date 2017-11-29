<?php
use \Workerman\Worker;
use \Workerman\WebServer;
use \Workerman\Autoloader;


// �Զ�������
require_once __DIR__ . '/../../Workerman/Autoloader.php';
Autoloader::setRootPath(__DIR__);

// WebServer
$web = new WebServer("http://127.0.0.1:55151");
// WebServer����
$web->count = 2;
// ����վ���Ŀ¼
$web->addRoot('www.your_domain.com', __DIR__.'/Web');

// ��������ڸ�Ŀ¼������������runAll����
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

