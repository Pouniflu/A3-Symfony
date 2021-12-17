<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // To create 5 missions
        for ($i=0; $i<5;$i++) {

            $mission = new Mission();

            $mission->setTitle('Mission ' . $i);
            $mission->setDescription('Quae dum ita struuntur, indicatum est apud Tyrum indumentum regale textum occulte, incertum quo locante vel cuius usibus apparatum. ideoque rector provinciae tunc pater Apollinaris eiusdem nominis ut conscius ductus est aliique congregati sunt ex diversis civitatibus multi, qui atrocium criminum ponderibus urgebantur.');
            $mission->setPriority('medium');
            $mission->setCompletionDate(new \DateTime());
            $mission->setStatus('In progress');

            $manager->persist($mission);
        }

        $manager->flush();
    }
}
