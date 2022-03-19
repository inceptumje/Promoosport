<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuiSommesNousController extends AbstractController
{
    /**
     * @Route("/quisommesnous/attributions", name="attributions")
     */
    public function attributions(): Response
    {
       
        return $this->render('quisommesnous/Attributions.html.twig' );
    }

     /**
     * @Route("/quisommesnous/quisommesnous", name="quisommesnous")
     */
    public function quisommesnous(): Response
    {
       
        return $this->render('quisommesnous/quisommesnous.html.twig' );
    }


    
     /**
     * @Route("/quisommesnous/concourspromosport", name="concourspromosport")
     */
    public function concourspromosport(): Response
    {
       
        return $this->render('quisommesnous/concourspromosport.html.twig' );
    }

       /**
     * @Route("/quisommesnous/commercial", name="commercial")
     */
    public function commercial(): Response
    {
       
        return $this->render('quisommesnous/commercial.html.twig' );
    }

     /**
     * @Route("/quisommesnous/technologie", name="technologie")
     */
    public function technologie(): Response
    {
       
        return $this->render('quisommesnous/technologie.html.twig' );
    }

  /**
     * @Route("/quisommesnous/reglementation", name="reglementation")
     */
    public function reglementation(): Response
    {
       
        return $this->render('quisommesnous/reglementation.html.twig' );
    }

 /**
     * @Route("/quisommesnous/textesjuridiques", name="textesjuridiques")
     */
    public function textesjuridiques(): Response
    {
       
        return $this->render('quisommesnous/textesjuridiques.html.twig' );
    }
}
