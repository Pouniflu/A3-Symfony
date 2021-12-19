<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MissionFixtures extends Fixture
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(User::class)->findAll();

        // To create 5 missions
        for ($i = 0; $i < 5; $i++) {

            $mission = new Mission();

            $mission->setName('Mission ' . $i);
            $mission->setDescription('Quae dum ita struuntur, indicatum est apud Tyrum indumentum regale textum occulte, incertum quo locante vel cuius usibus apparatum. ideoque rector provinciae tunc pater Apollinaris eiusdem nominis ut conscius ductus est aliique congregati sunt ex diversis civitatibus multi, qui atrocium criminum ponderibus urgebantur.');
            $mission->setPriority('medium');
            $mission->setCompletionDate(new \DateTime());
            $mission->setStatus('In progress');
            $mission->addSuperHero($users[rand(0, count($users) - 1)]);

            $manager->persist($mission);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }

}
