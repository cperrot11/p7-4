<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setName("Phone House");
        $customer->setEmail("cperrot11@gmail.com");
        $customer->setPassword($this->encoder->encodePassword($customer, '123456'));
        $this->addReference('Customer1',$customer);
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName("Fnac");
        $customer->setEmail("fnac@gmail.com");
        $customer->setPassword($this->encoder->encodePassword($customer, '123456'));
        $this->addReference('Customer2',$customer);
        $manager->persist($customer);

        $manager->flush();
    }
}
