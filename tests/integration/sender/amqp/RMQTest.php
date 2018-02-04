<?php
declare(strict_types=1);

namespace RMQPHP\Tests\Integration\Sender\Amqp;

use PHPUnit\Framework\TestCase;
use RMQPHP\App\Sender\Amqp\RMQ;

class RMQTest extends TestCase {

    /**
     * @test
     */
    public function setupConn_whenConnSuccessfullySetup_thenReturnTrue() : void {
        // given
        $rmq = new RMQ();

        // when
        $resp = $rmq->setupConn();

        // then
        $this->assertTrue($resp);
        $this->assertNotNull($rmq->getConnection());
        $this->assertNotNull($rmq->getChannel());
    }

    /**
     * @test
     */
    public function closeStream_whenClosedConn_thenResetConnAndChannel() : void {
        // given
        $rmq = new RMQ();

        $rmq->setupConn();

        // when
        $rmq->closeStream();

        // then
        $this->assertNull($rmq->getConnection());
        $this->assertNull($rmq->getChannel());
    }
}