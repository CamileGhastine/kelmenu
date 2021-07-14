<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 20; $i++) {
            $ingredient = new Ingredient;
            $ingredient->setName($faker->word(1));

            $this->addReference('ingredient' . $i, $ingredient);

            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
