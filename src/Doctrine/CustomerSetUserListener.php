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
        dump('test');
        die();
    }

    public function prePersist(User $user)
    {
        if ($user->getCustomerId()) {
            return;
        }

        if ($this->security->getUser()) {
            $user->setCustomerId($this->security->getUser());
        }
    }
}
