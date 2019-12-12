<?php

namespace App\Controller;

use App\Repository\CategorieDeServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategorieDeServiceController extends AbstractController
{
    /**
     * @Route("/categorieDeService/", name="categorie_de_service")
     */
    public function index(CategorieDeServicesRepository $categorieDeService)
    {
        return $this->render('categorie_de_service/categorie_de_service.html.twig', [
            'categorieDeServices'=>$categorieDeService->findAllCategorieDeServices()
        ]);
    }

    /**
     * @Route("/categorieDeService/{id}", name="categorie_de_service_id")
     */
    public function indexId(int $id, CategorieDeServicesRepository $categorieDeService)
    {
        return $this->render('categorie_de_service/categorie_de_service.html.twig', [
            'categorieDeServices'=>$categorieDeService->findOneCategorieDeService($id)
        ]);
    }
}
