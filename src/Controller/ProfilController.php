<?php
/**
 * Created by PhpStorm.
 * User: jfr
 * Date: 2019-12-16
 * Time: 18:27
 */

namespace App\Controller;

use App\Entity\Prestataire;
use App\Repository\PrestataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profil(AuthenticationUtils $authenticationUtils, PrestataireRepository $prestataire)
    {
        $user = $this->getUser();
        if($user instanceof Prestataire){
            $userType = 'prestataire';
        }else{
            $userType = 'internaute';
        }
        return $this->render('profil/profil.html.twig', [
            'user_type'=>$userType
        ]);
    }
}