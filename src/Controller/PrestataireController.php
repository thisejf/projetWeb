<?php

namespace App\Controller;

use App\Repository\CategorieDeServicesRepository;
use App\Repository\PrestataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestataire/", name="prestataire")
     */
    public function index(PrestataireRepository $prestataire, CategorieDeServicesRepository $categorieDeServices)
    {
        return $this->render('prestataire/list_prestataire.html.twig', [
            'prestataires' => $prestataire->findAllData(),
            'categorieDeServices'=>$categorieDeServices->findAll(),
            'request'=>null
        ]);
    }

    /**
     * @Route("/prestataire/search/", name="prestataire_search")
     */
    public function indexSearch(Request $request ,PrestataireRepository $prestataire, CategorieDeServicesRepository $categorieDeServices)
    {

        if($request){
            foreach ($request->query as $key => $value){
                $data[$key]= $value;
            }
            $prestataireResult = $prestataire->search($data);
        }else{
            $prestataireResult = $prestataire->findAllData();
        }

        return $this->render('prestataire/list_prestataire.html.twig', [
            'prestataires' =>$prestataireResult,
            'categorieDeServices'=>$categorieDeServices->findAll(),
            'request'=>$data
        ]);
    }

    /**
     * @Route("/prestataire/{id}", name="prestataire_id")
     */
    public function indexId(int $id, PrestataireRepository $prestataire)
    {
        return $this->render('prestataire/prestataire.html.twig', [
            'prestataire' => $prestataire->findOneDataBy($id)
        ]);
    }
}
