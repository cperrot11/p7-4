<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($cpt=1;$cpt<=10;$cpt++){
            $user = new User();
            $user->setName("user".$cpt);
            $user->setEmail("user".$cpt."@gmail.com");
            $rand_customer = rand(1,2);
            $customer = $this->getReference('Customer'.$rand_customer);
            $user->setCustomerId($customer);

            $manager->persist($user);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            CustomerFixtures::class,
        );
    }
}
