<?php

namespace App\DataFixtures;

use App\Entity\Pantry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PantryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $unities = ['g', 'kg', 'L', 'mL', 'cuil. à café', 'cuil. à soupe'];

        $ingredientsReferences =[];
        for ($i=1; $i<=20; $i++) {
            $ingredientsReferences [] = $this->getReference('ingredient' . $i);
        }

        for($i=1; $i<=10; $i++) {
            $recipe = $this->getReference('recipe' . $i);

            $keys = array_rand($ingredientsReferences, rand(3, 10));

            foreach ($keys as $key) {
                $pantry = new Pantry;
                $pantry->setRecipe($recipe)
                ->setIngredient($ingredientsReferences[$key])
                ->setQuantity(rand(1, 9))
                ->setUnity($unities[rand(0,5)])
                ;
                
                $manager->persist($pantry);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            IngredientFixtures::class,
            RecipeFixtures::class
        ];
    }
}
