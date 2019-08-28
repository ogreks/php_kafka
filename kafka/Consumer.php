<?php
/**
 * Created By.
 * @describe:
 * @author:Higanbana
 * @Date:2019/8/27
 * @Time:17:36
 */

namespace kafka\Consumer;

use kafka\Kafka;

class Consumer extends Kafka
{
    public $config = [
        'addBrokers' => '127.0.0.1:32768',
        'topIc' => 'test',
        'group.id' => 'ShortMessageService',
    ];

    public function sendConsumer()
    {
        $this->consumer();
    }
}