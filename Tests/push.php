<?php
require __DIR__ . "/bootstrap.php";
require __DIR__ . "/TestHandler.php";

$config = include __DIR__ . '/config.php';

$queue = \WorkerManQueue\Queue::getInstance('Redis', $config);

use Tests\TestHandler;

for ($i = 0; $i <= 100; $i++) {
    $r = $queue->pushOn(new TestHandler(), 'test', ['test' => $i], 'queue');
}
