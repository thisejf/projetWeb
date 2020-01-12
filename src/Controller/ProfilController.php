<?php
/**
 * Created by PhpStorm.
 * User: jfr
 * Date: 2019-12-16
 * Time: 18:27
 */

namespace App\Controller;

use App\Entity\Prestataire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        $user = $this->getUser();

        if($user instanceof Prestataire){
            $userType = 'prestataire';
        }else{
            $userType = 'internaute';
        }
        return $this->render('profil/profil.html.twig', [
            'user_type'=>$userType,
            'user'=>$user,
        ]);
    }
}