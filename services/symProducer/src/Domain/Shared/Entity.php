<?php
declare(strict_types=1);
namespace App\Domain\Shared;

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

        $entity = $args->getObject();

        $this->logger->info('Post-persisting Entity: '.$entity::class);
        try {

            $this
                ->client
                ->produce($entity)
                ->flush();
        } catch (\Exception $exception) {
            $this->logger->alert($exception->getMessage());
        }


    }
}