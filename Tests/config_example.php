<?php

return [
    'log' => [
        'logRoot'  => __DIR__ . '/../runtime/log',
        'fileName' => '\q\u\e\u\e_Y-m-d.\l\o\g',
    ],

    'connectList' => [
        'Redis' => [
            'class'  => '\\WorkerManQueue\\Connection\\Redis\\Redis',
            'config' => [
                'popTimeout'  => 3,               // pop阻塞的超时时长 s
                'host'        => '127.0.0.1',     // 数据库地址
                'port'        => 6379,            // 数据库端口
                'db'          => 0,               // 库
                'password'    => null,            // 密码
                'connTimeout' => 1,               // 链接超时
            ],
        ]
    ],

    'currentConnect' => 'Redis',
];