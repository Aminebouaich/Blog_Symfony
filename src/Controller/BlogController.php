<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Article;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ManagerRegistry $doctrine): Response
    {
    $repo = $doctrine->getRepository(Article::class);
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
        
    }
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        
        return $this->render('blog/home.html.twig', [
            'title' => "Bienvenue ici les amis !",
            'age' => 20
        ]);
    }

    #[Route('/blog/{id}', name: 'blogshow')]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $repo = $doctrine->getRepository(Article::class);
        $article = $repo->find($id);

        return $this->render('blog/show.html.twig',[
            'article'=>$article
        ]);
    }


}
