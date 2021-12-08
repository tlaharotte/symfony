<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category.index")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/{id}", name="category.show")
     */
    public function show(int $id, CategoryRepository $categoryRepository)
    {
        $category=$categoryRepository->find($id);
        if (!$category){
            throw $this->createNotFoundException('The category does not exist');
        }else{
            return $this->render('category/show.html.twig',[
                'controller_name' => 'CategoryController',
                'category' => $category
            ]);
        }
    }
}