<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    /** @var UserPasswordHasherInterface */
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // To create Professor X (Administrator)
        $admin = new User();
        $admin->setUserName('Professor X');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        // To create 10 superhero
        for ($i=0; $i<10;$i++) {
            $superHero = new User();
            $superHero->setUserName('Superhero ' . $i);
            $superHero->setRoles(['ROLE_SUPER_HERO']);
            $superHero->setPassword($this->userPasswordHasher->hashPassword($superHero, 'password'));
            $manager->persist($superHero);
        }

        $manager->flush();
    }

}
