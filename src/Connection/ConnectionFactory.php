<?php
/**
 *
 * @date 2021/6/24 15:12
 */

namespace WorkerManQueue\Connection;


use WorkerManQueue\Helpers\Log;

class ConnectionFactory
{
    /**
     * @var array 链接配置列表
     * example:
     *
     */
    public static $connectList = [
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
    ];

    /**
     * @var string 当前默认使用的链接
     */
    public static $currentConnect = 'Redis';

    /**
     * 获取链接对象
     * @param string $currentName 当前链接方式
     * @return Connection
     */
    public static function getInstance($currentName)
    {
        $connect = isset(self::$connectList[$currentName]) ? self::$connectList[$currentName] : [];
        if (empty($connect) || !isset($connect['class']) || empty($connect['class'])) {
            Log::error('There is no connection available type');
            return null;
        } else {
            $class  = $connect['class'];
            $config = isset($connect['config']) ? $connect['config'] : [];
            return $class::getInstance($config);
        }
    }
}