<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordSubscriber implements EventSubscriberInterface
{
    protected UserPasswordHasherInterface $hasher;
    
    // On injecte le service de hashage de mot de passe
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function onPersist(LifecycleEventArgs $event): void
    {
        /** @var User $entity */
        $entity = $event->getObject();

        if (!$entity instanceof User || empty($entity->getPlainPassword())) {
            return;
        }

        $entity->setPassword(
            $this->hasher->hashPassword($entity, $entity->getPlainPassword())
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist => 'onPersist',
            Events::preUpdate => 'onPersist',
        ];
    }
}
