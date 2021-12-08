<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $articleRepository->findAll();
        $pagination = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            5
        );
        
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $pagination
        ]);
    }

    /**
     * @Route("/article/{id}", name="article.show")
     */
    public function show(int $id, ArticleRepository $articleRepository){
        $article=$articleRepository->find($id);
        if (!$article){
            throw $this->createNotFoundException('The article does not exist');
        }else{
            return $this->render('article/show.html.twig',[
                'controller_name' => 'ArticleController',
                'article' => $article
            ]);
        }
    }
}
