<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:26
 */

namespace App\Subscriber;


use App\AppEvent;
use App\Event\userCardEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class userCardSubscriber implements EventSubscriberInterface
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

    public function userCardAdd(userCardEvent $userCardEvent)
    {

    }

    public function userCardEdit(userCardEvent $userCardEvent)
    {

    }

    public function userCardDelete(userCardEvent $userCardEvent)
    {

    }

}