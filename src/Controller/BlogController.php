<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
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
    #[Route('/blog/new', name: 'blogcreate')]
    #[Route('/blog/{id}/edit', name: 'blogedit')]

    public function form(Article $article = null, Request $request, ManagerRegistry $manager): Response
    {
        if(!$article){
            $article = new Article();
        }
        // 

        // $article->setTitle("Titre d'exemple")
        //         ->setContent("Le contenu de l'article");

        // $form = $this->createFormBuilder($article)
        //             ->add("title")
        //             ->add('content', TextType::class)
        //             ->add("image")
        //             ->getForm();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);           
                    
       if ($form ->isSubmitted() && $form->isValid()) {
        if($article->getId()){
            $article->setCreatedAt( new \DateTimeImmutable());

        }
        $article->setCreatedAt(new \DateTimeImmutable());
        $manager->getManager()->persist($article);
        $manager->getManager()->flush();

        return $this->redirectToRoute('blogshow', ['id' => $article->getId()]);


        
       }


        return $this->render('blog/create.html.twig', [
        'formArticle' => $form->createView(),
        'editMode' => $article->getId() !== null
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
