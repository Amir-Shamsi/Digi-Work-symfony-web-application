<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder= $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
//         $user = new User();
//         $user->setUsername('amir');
//        $user->setFirstName('am');
//        $user->setLastName('am');
//        $user->setEmail('dede');
//
//        $user->setCreatedAt(new \DateTimeImmutable());
//        $user->setRoles(['USER_ROLE']);
//        $user->setPhone("12895946644");
//        $manager->persist($user);
//        $manager->flush();
    }
}
