<?php

namespace App\Controller;

use App\Repository\CategorieDeServicesRepository;
use App\Repository\PrestataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(PrestataireRepository $prestataireRepository, CategorieDeServicesRepository $categorieDeService)
    {
        return $this->render('default/home.html.twig', [
            'prestataires'=>$prestataireRepository->last4Prestataire(),
            'nav'=>true,
            'categorieDeServices'=>$categorieDeService->findAll()
        ]);
    }
}
