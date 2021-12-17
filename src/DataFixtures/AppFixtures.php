<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {
        // To create Professor X (Administrator)
        $admin = new User();
        $admin->setName('Professor X');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        // To create 10 superhero
        for ($i=0; $i<10;$i++) {
            $superHero = new User();
            $superHero->setName('Superhero');
            $superHero->setRoles(['ROLE_SUPER_HERO']);
            $manager->persist($superHero);
        }

        $manager->flush();
    }

}
