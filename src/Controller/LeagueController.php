<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Repository\LeagueRepository;

use App\Entity\League;
use App\Form\LeagueType;

class LeagueController extends AbstractController
{

    /**
     * @Route("/admin/league", name="admin_league")
     */
    public function index(Request $request, LeagueRepository $lrp): Response
    {
        $leagues = $lrp->findAll();
        $league = new League();
        $form = $this->createForm(LeagueType::class,$league);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            /*$file = $form['logo']->getData();
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $filename = $this->generateUniqueFileName().'.'.$extension;
            $file->move($this->getParameter('/img/league'), rand(1, 99999).'.'.$extension);*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($league);
            $em->flush();
            return $this->redirectToRoute('admin_league');
        }
        return $this->render('League/Back-Office/index.html.twig', [
            'controller_name' => 'LeagueController',
            "form" => $form->createView(),
            "leagues" => $leagues
        ]);
    }


    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}
