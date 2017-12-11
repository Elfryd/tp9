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
}