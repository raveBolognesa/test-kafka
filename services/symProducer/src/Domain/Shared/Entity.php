<?php
declare(strict_types=1);
namespace App\Domain\Shared;

use App\Domain\Checkout\Entity\Checkout;
use App\Domain\Checkout\Model\CheckoutModel;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;
use StsGamingGroup\KafkaBundle\Client\Producer\ProducerClient;

class Entity
{

    public function __construct( private LoggerInterface $logger, private ProducerClient $client)
    {
    }

    // the listener methods receive an argument which gives you access to
    // both the entity object of the event and the entity manager itself
    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logger->info('Testing*************\n');
        $this->logger->info('Testing*************\n');
        $this->logger->info('Testing*************\n');
        $this->logger->info('Testing*************\n');

        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Checkout) {
            return;
        }

        $this->logger->info('Testing');

        $this
            ->client
            ->produce( CheckoutModel::fromEntity($entity))
            ->flush();


    }
}