<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{
protected function supports($attribute, $subject)
{
return in_array($attribute, ['POST','VIEW', 'DELET'])
&& $subject instanceof User;
}

protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
{
$user = $token->getUser();
if (!$user instanceof UserInterface) {
return false;
}

if($user->getRoles()[0] === 'ROLE_SUP_ADMIN' && 
       ($subject->getRoles()[0] != 'ROLE_SUP_ADMIN'))
        {
           return true;
        }

switch ($attribute) {
case 'POST':
     // var_dump($subject->getRole()->getLibellel());die();
     if($user->getRoles()[0] === 'ROLE_ADMIN' && 
     ($subject->getRoles()[0] === 'ROLE_CAISSIER'||
     $subject->getRoles()[0] === 'ROLE_PARTENAIRE'))
      {
        return true;
      }elseif($user->getRoles()[0] === 'ROLE_CAISSIER')
      {
        return false;
      }
      if($user->getRoles()[0] === 'ROLE_PARTENAIRE' && 
      ($subject->getRoles()[0] === 'ROLE_ADMIN_PARTENAIRE'||
      $subject->getRoles()[0] === 'ROLE_USER_PARTENAIRE'))
       {
         return true;
       }
break;
case 'VIEW':
    if($user->getRoles()[0] === 'ROLE_CAISSIER')
    {
      return false;
    }
break;
}

return false;
}
}