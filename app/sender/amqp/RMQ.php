<?php
declare(strict_types=1);

namespace RMQPHP\App\Sender\Amqp;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use RMQPHP\App\Http\Payload;
use RMQPHP\App\Sender\AMQP;


class RMQ implements AMQP
{
    /**
     * @var string  RabbitMQ Host name
     */
    const RMQHOST = 'localhost';

    /**
     * @var int RabbitMQ Port
     */
    const RMQPORT = 5672;

    /**
     * @var string  RabbitMQ User name
     */
    const RMQUSER = 'guest';

    /**
     * @var string  RabbitMQ Password
     */
    const RMQPASSWORD = 'guest';

    /**
     * @var string  RabbitMQ Queue name
     */
    const RMQQUEUE = 'payment_queue';

    /**
     * @var mixed
     */
    private $connection;

    /**
     * @var mixed
     */
    private $channel;

    /**
     * Initialise values
     */
    public function __construct() {
        //code
    }

    /**
     * @return bool
     */
    public function setupConn() : bool {
        $this->setConnection(new AMQPStreamConnection(
            self::RMQHOST,
            self::RMQPORT,
            self::RMQUSER,
            self::RMQPASSWORD
            )
        );

        if(!$this->getConnection()) return false;

        $this->setChannel($this->getConnection()->channel());

        $this->getChannel()->queue_declare(
            self::RMQQUEUE,     #queue - Queue names may be up to 255 bytes of UTF-8 characters
            false,              #passive - can use this to check whether an exchange exists without modifying the server state
            true,               #durable, make sure that RabbitMQ will never lose our queue if a crash occurs
            false,              #exclusive - used by only one connection and the queue will be deleted when that connection closes
            false               #auto delete - queue is deleted when last consumer unsubscribes
        );

        return true;
    }

    /**
     * @param $payload
     * @return AMQPMessage
     */
    public function sendMsg(Payload $payload): AMQPMessage {
        $msg = new AMQPMessage(
            $payload,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT) # make message persistent, so it is not lost if server crashes or quits
        );

        $this->getChannel()->basic_publish(
            $msg,               #message
            '',                 #exchange
            self::RMQQUEUE      #routing key (queue)
        );

        return $msg;
    }

    /**
     * Close connection
     */
    public function closeStream(): void {
        $this->getChannel()->close();
        $this->getConnection()->close();
        $this->setConnection(null);
        $this->setChannel(null);
    }

    /**
     * @return mixed
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection): void {
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getChannel() {
        return $this->channel;
    }

    /**
     * @param mixed $channel
     */
    public function setChannel($channel): void {
        $this->channel = $channel;
    }

    /**
     * @return bool
     */
    public function isListening(): bool {
        return $this->listening;
    }

    /**
     * @param bool $listening
     */
    public function setListening(bool $listening): void {
        $this->listening = $listening;
    }
}