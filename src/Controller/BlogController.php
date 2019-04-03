<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Form\ArticleType;

class BlogController extends AbstractController
{
    /**
     * Get All Articles
     *
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * Show Home page
     *
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * Create New Article
     *
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */
    public function formArticle(Article $article = null, Request $request, ObjectManager $manager)
    {
        if(!$article)
            $article = new Article();

        // $article->setTitle('title')->setContent('content');

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId())
                $article->setCreatedAt(new \DateTime());
            
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * Get Specific Article (using ParamConverter)
     *
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
            'controller_name' => 'BlogController',
            'article' => $article
        ]);
    }
}
