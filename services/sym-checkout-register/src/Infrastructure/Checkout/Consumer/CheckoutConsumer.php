<?php

declare(strict_types=1);

namespace App\Infrastructure\Checkout\Consumer;

use App\Application\Checkout\Service\CreateCheckoutInvoiceOnCheckoutService;
use Psr\Log\LoggerInterface;
use StsGamingGroup\KafkaBundle\Client\Consumer\Message;
use StsGamingGroup\KafkaBundle\Client\Contract\ConsumerInterface;
use StsGamingGroup\KafkaBundle\RdKafka\Context;

class CheckoutConsumer implements ConsumerInterface
{
    public const NAME = 'checkout_consumer';

    public function __construct(
        private LoggerInterface $logger,
        private CreateCheckoutInvoiceOnCheckoutService $checkoutService
    )
    {
    }

    public function consume(Message $message, Context $context): void
    {
        $data = $message->getData();

        $this->logger->notice(sprintf('Consumer: got message with value %s', $data));
        if (str_starts_with($data,'item:')) {
            $this->logger->notice(sprintf('Consumer item data --> %s', $data));

            $this->checkoutService->createCheckoutInvoice($data);
        }
    }

    public function handleException(\Exception $exception, Context $context): void
    {
        $this->logger->emergency($exception->getMessage());
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
