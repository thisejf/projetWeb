<?php

namespace App\Controller;

use App\Repository\PrestataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestataire/{id}", name="prestataire")
     */
    public function index(int $id = null, PrestataireRepository $prestataire)
    {
        if(!$id){
            return $this->render('prestataire/list_prestataire.html.twig', [
                'prestataires' => $prestataire->findAllData(),
            ]);
        }

        return $this->render('prestataire/prestataire.html.twig', [
            'prestataire' => $prestataire->findOneDataBy($id)
        ]);
    }
}
