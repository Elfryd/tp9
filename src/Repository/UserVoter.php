<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 13/12/17
 * Time: 11:15
 */

namespace App\Repository;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const USER_CAN_VIEW = 'user_can_view';

    protected function supports($attribute, $subject)
    {
        if(!$subject instanceof User) {
            return false;
        }
        if(!$attribute !== self::USER_CAN_VIEW){
            return false;
        }
        return true;
        // TODO: Implement supports() method.
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // TODO: Implement voteOnAttribute() method.
    }

}