<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\PromosportRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="global")
     */
    public function index(ArticleRepository $repository , PromosportRepository $repo , PaginatorInterface $paginator, Request $request): Response
    {
        $promosport = $repo->findAll();
        $articles = $paginator->paginate(
            $repository->Last_5_articles() ,
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('global/index.html.twig', [
            "articles" => $articles,
            "promosport" => $promosport

        ]);
    }

    /**
     * @Route("/Dashboard", name="Dashboard")
     */
    public function Dashboard(): Response
    {
        return $this->render('global/Dashboard_parts/Dashboard.html.twig', [

        ]);
    }
}
