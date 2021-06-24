<?php

require __DIR__."/bootstrap.php";

$config = include __DIR__.'/config.php';

$worker = new \WorkerManQueue\Worker($config);

$worker->run();
