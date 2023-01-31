<?php

declare(strict_types=1);

namespace App\Infrastructure\Sales\SalesSubscriber;

use App\Domain\Sale\Entity\Sale;
use App\Infrastructure\Sales\Consumer\SalesConsumer;
use Psr\Log\LoggerInterface;
use StsGamingGroup\KafkaBundle\Client\Producer\ProducerClient;
use StsGamingGroup\KafkaBundle\Event\PostMessageConsumedEvent;
use StsGamingGroup\KafkaBundle\Event\PreMessageConsumedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SalesSubscriber implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct( LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            PreMessageConsumedEvent::getEventName(SalesConsumer::NAME) => 'onPreMessageConsumed',
            PostMessageConsumedEvent::getEventName(SalesConsumer::NAME) => 'onPostMessageConsumed'
        ];
    }

    public function onPreMessageConsumed(PreMessageConsumedEvent $event): void
    {
        $this->logger->info('Pre message count: ' . $event->getConsumedMessages());
        $this->logger->info('Pre time ms: ' . $event->getConsumptionTimeMs());
    }

    public function onPostMessageConsumed(PostMessageConsumedEvent $event): void
    {
        $this->logger->info('Post message count: ' . $event->getConsumedMessages());
        $this->logger->info('Post time ms: ' . $event->getConsumptionTimeMs());
    }
}
