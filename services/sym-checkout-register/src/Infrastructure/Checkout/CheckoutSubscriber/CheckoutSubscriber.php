<?php

declare(strict_types=1);

namespace App\Infrastructure\Checkout\CheckoutSubscriber;

use App\Infrastructure\Checkout\Consumer\CheckoutConsumer;
use Psr\Log\LoggerInterface;
use StsGamingGroup\KafkaBundle\Event\PostMessageConsumedEvent;
use StsGamingGroup\KafkaBundle\Event\PreMessageConsumedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CheckoutSubscriber implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct( LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            PreMessageConsumedEvent::getEventName(CheckoutConsumer::NAME) => 'onPreMessageConsumed',
            PostMessageConsumedEvent::getEventName(CheckoutConsumer::NAME) => 'onPostMessageConsumed'
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
