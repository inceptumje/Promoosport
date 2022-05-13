<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\TeamRepository;

use App\Entity\Team;
use App\Form\TeamType;

class TeamController extends AbstractController
{
    /**
     * @Route("/admin/team", name="admin_team")
     */
    public function index(Request $request, TeamRepository $trp): Response
    {
        $teams = $trp->findAll();
        $team = new Team();
        $form = $this->createForm(TeamType::class,$team);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('admin_team');
        }

        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
            "form" => $form->createView(),
            "teams" => $teams
        ]);
    }
}