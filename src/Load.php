<?php
/**
 *
 * @date 2021/6/24 15:35
 */

namespace WorkerManQueue;


use WorkerManQueue\Connection\ConnectionFactory;
use WorkerManQueue\Helpers\Log;

class Load
{
    /**
     * 加载queue模块依赖的配置
     * @param array $config
     */
    public static function Queue(array $config)
    {
        // 加载log
        if (isset($config['log'])) {
            Log::getInstance()->setConfig($config['log']);
        }

        // 加载链接列表
        if (isset($config['connectList'])) {
            ConnectionFactory::$connectList = $config['connectList'];
        }

        // 加载当前链接
        if (isset($config['currentConnect'])) {
            ConnectionFactory::$currentConnect = $config['currentConnect'];
        }
    }
}