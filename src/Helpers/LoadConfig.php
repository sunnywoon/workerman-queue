<?php
/**
 *
 * @date 2021/6/24 15:14
 */

namespace WorkerManQueue\Helpers;

trait LoadConfig
{
    /**
     * 允许配置的变量名
     * @var array
     */
    protected $configNameList = [];

    /**
     * 加载配置
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        foreach ($config as $k => $v) {
            if (in_array($k, $this->configNameList)) {
                if (!is_null($v)) {
                    $this->$k = $v;
                }
            }
        }
        return $this;
    }
}