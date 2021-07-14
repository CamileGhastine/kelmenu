<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('camile@camile.fr')
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'camile'))
            ->setPseudo('Camile');

        $this->addReference('camile', $user);

        $manager->persist($user);

        $manager->flush();
    }
}
