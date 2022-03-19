<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/Dashboard/article", name="Dashboard_article")
     */
    public function index_back(ArticleRepository $repository ): Response
    {
        $article = $repository->findAll();
        return $this->render('article/index.html.twig', [
            "article" => $article
        ]);
    }

    /**
     * @Route("/article/{id}", name="single_article")
     */
    public function single_article(Article $article , ArticleRepository $repository , $id): Response
    {
        $article->incrementNbViews();
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        $article = $repository->find($id);
        return $this->render('article/single_article.html.twig', [
            "article" => $article
        ]);
    }

    /**
     * @Route("/Dashboard/article/ajouter", name="ajouter_article")
     * @Route("/Dashboard/article/modifier/{id}", name="modifier_article")
     */
    public function Ajouter_modifier(Article $article = null,Request $request)
    {   $modif = false;
        if(!$article)
        {
            $article = new Article();
            $modif = true;
        }
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $article->setDate(new \DateTime("now"));
            $em->persist($article);
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
            return $this->redirectToRoute('Dashboard_article');
        }
        return $this->render('article/New_Article.html.twig', [
            "article"=>$article,
            "form"=> $form->createView() ,
            "modif" => $modif
        ]);
    }


    /**
     * @Route("/Dashboard/article/supprimer/{id}", name="supprimer_article")
     */
    public function delete(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        $this->addFlash('success',"L'action a ete effectué");
        return $this->redirectToRoute('Dashboard_article');
    }
}
