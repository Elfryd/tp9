<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:31
 */

namespace App\Event;


use App\Entity\UserCard;
use Symfony\Component\EventDispatcher\Event;

class UserCardEvent extends Event
{
    /**
     * @var UserCard
     */
    private $userCard;
    private $card;

    /**
     * @return UserCard
     */
    public function getUserCard(): UserCard
    {
        return $this->userCard;
    }

    /**
     * @param UserCard $userCard
     */
    public function setUserCard(UserCard $userCard)
    {
        $this->userCard = $userCard;
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param mixed $card
     */
    public function setCard($card)
    {
        $this->card = $card;
    }

}