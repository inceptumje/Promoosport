<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Repository\ArticleRepository;
use App\Repository\ConcoursRepository;
use App\Repository\PromosportRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="global")
     */
    public function index(ArticleRepository $repository ,ConcoursRepository $rep ,PromosportRepository $promosportRepository , PaginatorInterface $paginator, Request $request,AuthenticationUtils $utils): Response
    {
        $article = $repository->findAll();
        $promosport = $promosportRepository->findAll();
        $concours = $paginator->paginate(
            $rep->Last_5_concours() ,
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('global/index.html.twig', [
            "concours" => $concours ,
            "article"=>$article,
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

    /**
     * @Route("/inscription", name="inscription")
     */
    public function Inscription(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordcrypt = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordcrypt);
            $utilisateur->setRoles('[ROLE_USER]');
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('global');
        }
        return $this->render('global/Inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     *
     */

    public function login(AuthenticationUtils $utils): Response
    {
        return $this->render('global/login.html.twig',[
            'LastUserName' => $utils->getLastUsername() ,
            'error' => $utils->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */

    public function logout()
    {

    }

}
