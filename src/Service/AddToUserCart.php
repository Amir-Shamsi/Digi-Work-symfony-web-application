<?php


namespace App\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AddToUserCart
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function addToCart(EntityManagerInterface $manager, string $productSerial)
    {
        dd($this->user);
    }
}