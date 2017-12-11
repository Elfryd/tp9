<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserCard
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="tp_userCard")
 */
class UserCard{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $actionPoint;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $attack;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $defence;
    /**
     * @var Card
     * @ORM\ManyToOne(targetEntity="Card")
     */
    protected $card;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return int
     */
    public function getActionPoint()
    {
        return $this->actionPoint;
    }

    /**
     * @param int $actionPoint
     */
    public function setActionPoint(int $actionPoint)
    {
        $this->actionPoint = $actionPoint;
    }

    /**
     * @return int
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * @param int $attack
     */
    public function setAttack(int $attack)
    {
        $this->attack = $attack;
    }

    /**
     * @return int
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     */
    public function setDefence(int $defence)
    {
        $this->defence = $defence;
    }

    /**
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param Card $card
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

}