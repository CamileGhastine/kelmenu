<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Recipe;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 1; $i <= 10; $i++) {
            $recipe = new Recipe();
            $recipe->setname($faker->words(rand(3, 8), true))
                ->setDescription($faker->paragraph(rand(3, 8), true))
                ->setUser($this->getReference('camile'))
                ->setPhoto('img/kelmenuLogo.jpeg')
                ;

            $this->addReference('recipe' . $i, $recipe);

            $manager->persist($recipe);
        }




        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
