<?php

namespace App\Controller;

use App\Repository\CategorieDeServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategorieDeServiceController extends AbstractController
{
    /**
     * @Route("/categorieDeService/{id}", name="categorie_de_service")
     */
    public function index(int $id = null, CategorieDeServicesRepository $categorieDeService)
    {
        if(!$id){
            return $this->render('categorie_de_service/categorie_de_service.html.twig', [
                'categorieDeServices'=>$categorieDeService->categorieJoinImage()
            ]);
        }
        return $this->render('categorie_de_service/categorie_de_service.html.twig', [
            'categorieDeServices'=>$categorieDeService->findOnecategorieJoinImage($id)
        ]);
    }
}
