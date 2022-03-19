<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\MatchFootRepository;
use App\Repository\LeagueRepository;

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

    /**
     * @Route("/match", name="front_match")
     */
    public function accessFront(Request $request, MatchFootRepository $mfrp, LeagueRepository $lrp): Response
    {
        $matches = $mfrp->findAll();
        $leagues = $lrp->findAll();

        return $this->render('MatchFoot/Front-Office/match.front.html.twig', [
            'controller_name' => 'MatchFootController',
            'matchees' => $matches,
            'leagues' => $leagues
        ]);
    }




    /**
     * @Route("/match/{leagueId}", name="admin_match_by_league")
     */
    public function getMatchesByLeague(MatchFootRepository $mfrp, LeagueRepository $lrp, $leagueId): Response
    {

        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "promosport2";

        // $conn = new \mysqli($servername, $username, $password, $dbname);

        // $sql = "SELECT  FROM match_foot WHERE league_id = ".$leagueId;
        // $matches = $conn->query($sql);

        // $conn->close();


        $matches = $lrp->selectMatchesOfLeague($leagueId);
        $leagues = $lrp->findAll();

        return $this->render('MatchFoot/Front-Office/match.front.html.twig', [
            'controller_name' => 'MatchFootController',
            'matchees' => $matches,
            'leagues' => $leagues
        ]);

    }

}
