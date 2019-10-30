<?php

namespace App\Doctrine;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class CustomerSetUserListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(User $user)
    {
        if ($user->getCustomerId()) {
            return;
        }
        /* Filed the Customer logged */
        if ($this->security->getUser()) {
            $user->setCustomerId($this->security->getUser());
        }
    }
}
