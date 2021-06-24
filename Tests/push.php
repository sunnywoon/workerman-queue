<?php
require __DIR__ . "/bootstrap.php";
require __DIR__ . "/TestHandler.php";

$config = include __DIR__ . '/config.php';

$queue = \WorkerManQueue\Queue::getInstance('Redis', $config);

use Tests\TestHandler;

$r = $queue->pushOn(new TestHandler(), 'test', ['test' => 'test'], 'queue');