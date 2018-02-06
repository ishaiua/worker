<?php

use Workerman\Worker;
use \Workerman\Lib\Timer;
define('IS_WIN',strstr(PHP_OS, 'WIN') ? 1 : 0 );
define('IS_CLI',PHP_SAPI=='cli'? 1   :   0);

if (! IS_CLI) die('请使用 CLI 模式运行……');
if(IS_WIN){
	require_once __DIR__ . '/Workerman-windows/Autoloader.php';
}else{
	require_once __DIR__ . '/Workerman-linux/Autoloader.php';
}


$task = new Worker();

$task ->count =10;

$task->onWorkerStart = function($task)
{
	$args=[];
    Timer::add(1,'echoTime',$args,true);
};

function echoTime($args=[])
{
	echo time()."\n";
}

// 运行worker
Worker::runAll();