<?php
/**
 *
 * @date 2021/6/24 15:07
 */

namespace WorkerManQueue\Handler;

use WorkerManQueue\Job;

abstract class JobHandler
{
    /**
     * 回调执行任务方法
     * @param Job $job 任务
     * @param String $func 执行的方法
     * @param array $data 参数
     * @return void
     */
    public function handler(Job $job, $func, $data)
    {
        try {
            if (method_exists($this, $func)) {
                $this->$func($job, $data);
            } else {
                $job->setForceFailure('method "' . $func . '" does not exist');
            }
        } catch (\Exception $e) {
            $job->setOnceFailure($e->getMessage());
        }
    }


    /**
     * 失败回调方法
     * @param Job $job 任务
     * @param string $func 执行的方法
     * @param array $data 参数
     * @return mixed
     */
    abstract public function failed(Job $job, $func, $data);


    /**
     * 任务成功回调
     * @param Job $job 任务
     * @param string $func 执行的方法
     * @param array $data 参数
     * @return mixed
     */
    abstract public function success(Job $job, $func, $data);


    /**
     * 回调方法
     * @param $job
     * @param $data
     */
    /**
     * public function func($job,$data){}
     */

}