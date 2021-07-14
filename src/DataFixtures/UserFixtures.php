<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('camile@camile.fr')
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'camile'))
            ->setPseudo('Camile');

        $this->addReference('user1', $user);

        $manager->persist($user);

        for ($i = 2; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@kelmenu.com')
                ->setPassword($this->userPasswordHasher->hashPassword($user, 'password'))
                ->setPseudo($faker->firstname());

            $this->addReference('user' . $i, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
