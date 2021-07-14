<?php

namespace App\Controller;

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
}
