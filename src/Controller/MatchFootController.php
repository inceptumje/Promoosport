<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\MatchFootRepository;

use App\Entity\MatchFoot;
use App\Form\MatchFootType;

class MatchFootController extends AbstractController
{
    /**
     * @Route("/admin/match", name="admin_match")
     */
    public function index(Request $request, MatchFootRepository $mfrp): Response
    {
        $matches = $mfrp->findAll();
        $match = new MatchFoot();
        $form = $this->createForm(MatchFootType::class,$match);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('admin_match');
        }
        return $this->render('MatchFoot/Back-Office/index.html.twig', [
            'controller_name' => 'MatchFootController',
            'form' => $form->createView(),
            'matchees' => $matches
        ]);
    }
}
