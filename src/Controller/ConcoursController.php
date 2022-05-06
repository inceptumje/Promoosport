<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Concours;
use App\Form\CommentaireType;
use App\Form\ConcoursType;
use App\Repository\CommentaireRepository;
use App\Repository\ConcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcoursController extends AbstractController
{
    /**
     * @Route("/Dashboard/concours", name="Dashboard_concours")
     */
    public function index_back(ConcoursRepository $repository): Response
    {
        $concours = $repository->findAll();
        return $this->render('concours/index.html.twig', [
            "concours" => $concours
        ]);
    }

    /**
     * @Route("/Dashboard/concours/ajouter", name="ajouter_concours")
     * @Route("/Dashboard/concours/modifier/{id}", name="modifier_concours")
     */
    public function Ajouter_modifier(Concours $concours = null, Request $request)
    {
        $modif = false;
        if (!$concours) {
            $concours = new Concours();
            $modif = true;
        }
        $form = $this->createForm(ConcoursType::class, $concours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $concours->setDate(new \DateTime("now"));
            $em->persist($concours);
            $em->flush();
            $this->addFlash('success', "L'action a ete effectué");
            return $this->redirectToRoute('Dashboard_concours');
        }
        return $this->render('concours/New_concours.html.twig', [
            "form" => $form->createView(),
            "modif" => $modif
        ]);
    }


    /**
     * @Route("/Dashboard/concours/supprimer/{id}", name="supprimer_concours")
     */
    public function delete(Concours $concours)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($concours);
        $em->flush();
        $this->addFlash('success', "L'action a ete effectué");
        return $this->redirectToRoute('Dashboard_concours');
    }

    /**
     * @Route("/concours/{id}", name="single_concours")
     */
    public function single_commentaire(Concours $concours, ConcoursRepository $repository, $id, Request $request, CommentaireRepository $commentaireRepository): Response
    {
        $concours->incrementNbViews();
        $em = $this->getDoctrine()->getManager();
        $em->persist($concours);
        $em->flush();
        $concours = $repository->find($id);

        $commentaires = $commentaireRepository->findby(['concours' => $id]);
        $commentaire_article = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire_article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire_article->setUtilisateur($this->getUser());
            $commentaire_article->setConcours($concours);
            $commentaire_article->setCreatedAt(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire_article);
            $em->flush();
            return $this->redirectToRoute('single_concours',[
                "id"=> $concours->getId()
            ]);
        }
            return $this->render('concours/single_concours.html.twig', [
                "concours" => $concours ,
                "form"=>$form->createView(),
                "commentaires" => $commentaires
            ]);
        }


}
