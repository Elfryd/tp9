<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:26
 */

namespace App\Subscriber;


use App\AppEvent;
use App\Entity\Card;
use App\Event\UserCardEvent;
use App\Entity\UserCard;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

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
        $userCard->setCard($this->em->getRepository(Card::class)->find($userCardEvent->getCard()));
        $this->em->persist($userCard);
        $this->em->flush();
    }

    public function userCardEdit(UserCardEvent $userCardEvent)
    {
        $userCard = $userCardEvent->getUserCard();
        $this->em->persist($userCard);
        $this->em->flush();
    }

    public function userCardDelete(UserCardEvent $userCardEvent)
    {
        $userCard = $userCardEvent->getUserCard();
        $this->em->remove($userCard);
        $this->em->flush();
    }

}