<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/Dashboard/commentaires", name="Dashboard_commentaire")
     */
    public function index_back(CommentaireRepository $repository ): Response
    {
        $commentaires = $repository->findAll();
        return $this->render('commentaire/indexBack.html.twig', [
            "commentaires" => $commentaires
        ]);
    }

    /**
     * @Route("/Dashboard/commentaire/supprimer/{id}", name="supprimer_commentaire")
     */
    public function delete(Commentaire $commentaire)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($commentaire);
        $em->flush();
        $this->addFlash('success',"L'action a ete effectué");
        return $this->redirectToRoute('Dashboard_commentaire');
    }
}
