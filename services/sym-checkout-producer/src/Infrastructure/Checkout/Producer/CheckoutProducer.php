<?php

declare(strict_types=1);

namespace App\Infrastructure\Checkout\Producer;

use App\Domain\Checkout\Entity\Checkout;
use Psr\Log\LoggerInterface;
use StsGamingGroup\KafkaBundle\Client\Contract\CallableInterface;
use StsGamingGroup\KafkaBundle\Client\Contract\ProducerInterface;
use StsGamingGroup\KafkaBundle\Client\Producer\Message;

class CheckoutProducer implements ProducerInterface, CallableInterface
{
    use LoggableCallbacks;

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function produce($data): Message
    {
        /** @var $data Checkout */
        return new Message('item:'.$data->getItem(), null);
    }

    public function supports($data): bool
    {
        return $data instanceof Checkout;
    }

    protected function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}
