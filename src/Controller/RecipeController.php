<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe", name="recipe_index")
     */
    public function index(RecipeRepository $recipeRepository): Response
    {        
        return $this->render('recipe/index.html.twig', [
            'nav' => "recipe_index",
            'recipes' =>$recipeRepository->findAll()
        ]);
    }

    /**
     * @Route("/recipe/{id<[0-9]+>}", name="recipe_show")
     */
    public function show(Recipe $recipe): Response
    {        
        return $this->render('recipe/show.html.twig', [
            'nav' => "recipe_index",
            'recipe' =>$recipe
        ]);
    }
}
