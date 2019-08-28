<?php

namespace Kafka;

class Kafka
{
    private $config = [
        'addBrokers' => '127.0.0.1:9092',
        'topIc' => 'test',
        'group.id' => 'myConsumerGroup',
    ];
    // kafkaconf 实例
    public $conf;
    // topicConf 实例
    public $topicConf;
    // 订阅
    public $topic;
    // 消息偏移量
    private $smallest;
    // 消费者
    public $consumer;

    public function setSmallest(string $number)
    {
        $this->smallest = $number;
        return $this;
    }
    /**
     * 设置订阅
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;
        return $this;
    }
    /**
     * kafka 是 使用类
     */
    public function __construct($config)
    {
        $this->config = array_merge($this->config,$config);
        // 初始化配置
    }

    /**
     * 生产者
     */
    public function producer($partition, $msgflags, $payload, $key = null)
    {
        $producer = new RdKafka\Producer();
        $producer->addBrokers($this->config['addBrokers']);
        $topic = $producer->newTopic($this->config['topIc']);
        $topic->produce($partition, $msgflags, $payload, $key);
        return $this;
    }

    public function producerv($partition, $msgflags, $payload, $key = null)
    {
        $producer = new RdKafka\Producer();
        $producer->addBrokers($this->config['addBrokers']);
        $topic = $producer->newTopic($this->config['topIc']);
        $topic->producev($partition, $msgflags, $payload, $key);
    }

    /**
     * 消费者
     */
    public function consumer()
    {
        // 消费者实例
        $consumer = new RdKafka\KafkaConsumer($this->conf);
        $consumer->subscribe($this->topic);
        $this->consumer = $consumer;
        return $this;
    }

    /**
     * topic 配置
     */
    public function TopicConf()
    {
        $topicConf = new RdKafka\TopicConf();
        $topicConf->set('auto.offset.reset',$this->smallest);
    }

    /**
     * rdkafka conf 配置实例
     */
    public function Conf()
    {
        $conf = new RdKafka\Conf();
        $conf->setRebalanceCb(function (RdKafka\KafkaConsumer $kafka, $err, array $partitions = null){
            switch ($err) {
                case RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS:
                    echo "Assign:";
                    var_dump($partitions);
                    $kafka->assign($partitions);
                    break;
                case RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS:
                    echo "Revoke:";
                    var_dump($partitions);
                    $kafka->assign(NUll);
                    break;
                default:
                    throw new \Exception("未知错误".$err);
                break;
            }
        });

        $conf->set('group.id',$this->config['group.id']);
        $conf->set('metadata.broker.list',$this->config['addBrokers']);
        $conf->setDefaultTopicConf($this->topicConf);
        $this->conf = $conf;
        return $this;
    }


}