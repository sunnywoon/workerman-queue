<?php
/**
 *
 * @date 2021/6/24 15:55
 */

namespace WorkerManQueue;


use Workerman\Timer;
use WorkerManQueue\Helpers\LoadConfig;

class Worker
{
    use LoadConfig;

    protected $config = [];

    /**
     * Worker constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function run()
    {
        $worker        = new \Workerman\Worker();
        $worker->count = 10;
        $worker->name  = 'queue';

        $queueName = $worker->name;
        $config    = $this->config;

        $worker->onWorkerStart = function () use ($config, $queueName) {
            Load::Queue($config);
            $queue   = Queue::getInstance();
            $attempt = 2;

            $queue->setHandler(function (Job $job, $queueName) use ($queue, $attempt) {
                // 执行任务
                $job->execute();

                // 判断任务是否执行成功
                if ($job->isExec()) {
                    //任务成功，触发回调
                    $job->success();
                } else {
                    // 是否需要重试该任务
                    if ($job->isRetry($attempt)) {
                        // 需要重试，则重新将任务放入队尾
                        $job->reTry($queue, $queueName);
                    } else {
                        // 不需要重试，则任务失败，触发回调
                        $job->failed();
                    }
                }
            });

            Timer::add(0.1, function () use ($queue, $queueName) {
                // 消费一次队列任务
                $queue->popRun($queueName);
            });
        };

        \Workerman\Worker::runAll();
    }
}