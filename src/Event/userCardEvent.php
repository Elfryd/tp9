<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:31
 */

namespace App\Event;


use App\Entity\UserCard;

class userCardEvent
{
    /**
     * @var UserCard
     */
    private $userCard;

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
}