<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchFootController extends AbstractController
{
    /**
     * @Route("/admin/match", name="app_match_foot")
     */
    public function index(): Response
    {
        return $this->render('MatchFoot/Back-Office/index.html.twig', [
            'controller_name' => 'MatchFootController',
        ]);
    }
}
