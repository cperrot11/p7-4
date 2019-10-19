<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($cpt=1;$cpt<=10;$cpt++){
            $phone = new Phone();
            $phone->setCreatedAt(new \DateTime());
            $phone->setDescription("description ".$cpt);
            $marque = array("Apple","Samsung","Nokia","Pixel","Xioami","Honor");
            $choixMarque = array_rand($marque);
            $phone->setMarque($marque[$choixMarque]);
            $phone->setName($marque[$choixMarque].$cpt);
            $phone->setPrice(rand(50,1000));
            $manager->persist($phone);
        }
        $manager->flush();
    }
}
