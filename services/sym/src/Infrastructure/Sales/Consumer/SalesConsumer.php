<?php

declare(strict_types=1);

namespace App\Infrastructure\Sales\Consumer;

use Psr\Log\LoggerInterface;
use StsGamingGroup\KafkaBundle\Client\Consumer\Exception\NullMessageException;
use StsGamingGroup\KafkaBundle\Client\Consumer\Message;
use StsGamingGroup\KafkaBundle\Client\Contract\ConsumerInterface;
use StsGamingGroup\KafkaBundle\RdKafka\Context;

class SalesConsumer implements ConsumerInterface
{
    public const NAME = 'sales_consumer';

    public function __construct( private LoggerInterface $logger)
    {
    }

    public function consume(Message $message, Context $context): void
    {
        $time = $message->getData();

        $this->logger->notice(sprintf('Consumer: got message with time %s', $time));
    }

    public function handleException(\Exception $exception, Context $context): void
    {
        if ($exception instanceof NullMessageException) {
            $this->logger->info('Consumer: no more messages available. Let\'s produce one.');


            return;
        }

        $this->logger->emergency($exception->getMessage());
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
