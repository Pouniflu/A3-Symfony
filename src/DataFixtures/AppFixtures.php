<?php

namespace App\DataFixtures;

use App\Client\UserClient;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserClient $userClient, private UserPasswordHasherInterface $userPasswordHasher) {}

    public function load(ObjectManager $manager): void
    {
        // To create Professor X (Administrator)
        $adminAPI = $this->userClient->superHeroes(527);
        $admin = new User();
        $admin->setUserName($adminAPI['name']);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        // To create 10 superhero
        for ($i=0; $i<10;$i++) {
            $randomSuperHero = $this->userClient->superHeroes($i+1);
            $superHero = new User();
            $superHero->setUserName($randomSuperHero['name']);
            $superHero->setRoles(['ROLE_SUPER_HERO']);
            $superHero->setPassword($this->userPasswordHasher->hashPassword($superHero, 'password'));
            $manager->persist($superHero);
        }

        $manager->flush();
    }

}
