<?php

namespace App\Controller;

use App\Repository\PrestataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(PrestataireRepository $prestataireRepository)
    {
        return $this->render('default/home.html.twig', [
            'prestataires'=>$prestataireRepository->last4Prestataire(),
            'nav'=>true
        ]);
    }
}
