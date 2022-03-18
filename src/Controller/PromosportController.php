<?php

namespace App\Controller;

use App\Entity\Promosport;
use App\Form\PromosportType;
use App\Repository\PromosportRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromosportController extends AbstractController
{
    /**
     * @Route("/Dashboard/promosport", name="Dashboard_promosport")
     */
    public function index_back(PromosportRepository $repository ): Response
    {
        $promosport = $repository->findAll();
        return $this->render('promosport/index.html.twig', [
            "promosport" => $promosport
        ]);
    }

    /**
     * @Route("/Dashboard/promosport/ajouter", name="ajouter_promosport")
     * @Route("/Dashboard/modifier/{id}", name="modifier_promosport")
     */
    public function Ajouter_modifier(Promosport $promosport = null,Request $request)
    {
        $modif = false;
        if(!$promosport)
        {
            $promosport = new Promosport();
            $modif = true;
        }
        $form=$this->createForm(PromosportType::class,$promosport);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $promosport->setCreatedAt(new \DateTime("now"));
            $em->persist($promosport);
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
            return $this->redirectToRoute('Dashboard_promosport');
        }
        return $this->render('promosport/New_Promosport.html.twig', [
            "promosport"=>$promosport,
            "form"=> $form->createView() ,
            "modif" => $modif
        ]);
    }

    /**
     * @Route("/Dashboard/promosport/supprimer/{id}", name="supprimer_promosport")
     */
    public function delete(Promosport $promosport)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($promosport);
        $em->flush();
        $this->addFlash('success',"L'action a ete effectué");
        return $this->redirectToRoute('Dashboard_promosport');
    }




}
