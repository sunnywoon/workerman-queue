<?php
/**
 *
 * @date 2021/6/24 16:40
 */

namespace Tests;

class TestHandler extends \WorkerManQueue\Handler\JobHandler
{
    /**
     * 失败回调方法
     * @param \WorkerManQueue\Job $job 任务
     * @param string $func 执行的方法
     * @param array $data 参数
     * @return mixed
     */
    public function failed(\WorkerManQueue\Job $job, $func, $data)
    {
        \WorkerManQueue\Helpers\Log::info('failed run handler -- func: ' . $func . ' -- params: ' . json_encode($data));
    }

    /**
     * 任务成功回调
     * @param \WorkerManQueue\Job $job 任务
     * @param string $func 执行的方法
     * @param array $data 参数
     * @return mixed
     */
    public function success(\WorkerManQueue\Job $job, $func, $data)
    {
        \WorkerManQueue\Helpers\Log::info('success run handler -- func: ' . $func . ' -- params: ' . json_encode($data));
    }


    public function test(\WorkerManQueue\Job $job, $data)
    {
        $res = 'success';
        \WorkerManQueue\Helpers\Log::info('run handler -- func: test -- params: ' . json_encode($data) . '; result : ' . var_export($res, true));
    }
}