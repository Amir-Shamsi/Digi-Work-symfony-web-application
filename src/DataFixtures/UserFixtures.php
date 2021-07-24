<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $user = new User();
         $user->setUsername('amir');
        $user->setFirstName('am');
        $user->setLastName('am');
        $user->setEmail('dede');
        $user->setPassword('1234');
        $manager->persist($user);
        $manager->flush();
    }
}
