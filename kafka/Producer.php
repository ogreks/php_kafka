<?php
/**
 * Created By.
 * @describe:
 * @author:Higanbana
 * @Date:2019/8/27
 * @Time:16:26
 */
namespace Kafka\Producer;

use Kafka\Kafka;

class Producer extends Kafka
{
    public $config = [
        'addBrokers' => '127.0.0.1:32768',
        'topIc' => 'test',
        'group.id' => 'ShortMessageService',
    ];

    /**
     * 暂定
     * 写入用户手机号
     * @type $data json
     */
    public function sendProducer($data)
    {
        $this->producer(RD_KAFKA_PARTITION_UA, 0, $data);
    }

}