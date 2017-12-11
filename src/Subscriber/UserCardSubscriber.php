<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:26
 */

namespace App\Subscriber;


use App\AppEvent;
use App\Event\UserCardEvent;
use App\Entity\UserCard;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCardSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * userCardSubscriber constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::USER_CARD_ADD => 'userCardAdd',
            AppEvent::USER_CARD_EDIT => 'userCardEdit',
            AppEvent::USER_CARD_DELETE => 'userCardDelete',
        );

        // TODO: Implement getSubscribedEvents() method.
    }

    public function userCardAdd(UserCardEvent $userCardEvent)
    {
        $userCard = $userCardEvent->getUserCard();
        $userCard->setUser();
    }

    public function userCardEdit(UserCardEvent $userCardEvent)
    {

    }

    public function userCardDelete(UserCardEvent $userCardEvent)
    {

    }

}