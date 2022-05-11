<?php

namespace App\Controller;

use App\Entity\PointeDeVente;
use App\Form\PointVenteType;
use App\Repository\PointeDeVenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointVenteController extends AbstractController
{
    /**
     * @Route("/Dashboard/pointe_vente", name="Dashboard_pv")
     */
    public function index_back(PointeDeVenteRepository $repository ): Response
    {
        $pv = $repository->findAll();
        return $this->render('point_vente/index.html.twig', [
            "pv" => $pv
        ]);
    }

    /**
     * @Route("/Dashboard/pointe_vente/ajouter", name="ajouter_pv")
     * @Route("/Dashboard/pointe_vente/modifier/{id}", name="modifier_pv")
     */
    public function Ajouter_modifier(PointeDeVente $pv = null,Request $request)
    {
        $modif = false;
        if(!$pv)
        {
            $pv = new PointeDeVente();
            $modif = true;
        }
        $form=$this->createForm(PointVenteType::class,$pv);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($pv);
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
            return $this->redirectToRoute('Dashboard_pv');
        }
        return $this->render('point_vente/New_point_vente.html.twig', [
            "pv"=>$pv,
            "form"=> $form->createView() ,
            "modif" => $modif
        ]);
    }

    /**
     * @Route("/Dashboard/pointevente/supprimer/{id}", name="supprimer_pv")
     */
    public function delete(PointeDeVente $pointeDeVente)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pointeDeVente);
        $em->flush();
        $this->addFlash('success',"L'action a ete effectué");
        return $this->redirectToRoute('Dashboard_pv');
    }

    /**
     * @Route("/pointe_vente/json", name="json_pv")
     */
    public function json_pointe(PointeDeVenteRepository $repository ): Response
    {
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            $pv = $repository->findAll();
            if(count($pv)>0)
            {
                $tabpv['pointevente'] = [];
                foreach ($pv as $p)
                {
                $p = [
                    'id'=>$p->getId(),
                    'state'=>$p->getState(),
                    'code'=> $p->getCode(),
                    'client'=>$p->getClient(),
                    'lat'=>$p->getLat(),
                    'lon'=>$p->getLon()
                ];
                $tabpv['pointevente'][] = $p;
                }
            }
            http_response_code(200);

        }
        else
        {
            http_response_code(405);
            echo json_encode(["message"=>"methode non autorise"]);
        }
        return new JsonResponse($tabpv);
    }
}
