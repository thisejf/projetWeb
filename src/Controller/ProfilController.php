<?php
/**
 * Created by PhpStorm.
 * User: jfr
 * Date: 2019-12-16
 * Time: 18:27
 */

namespace App\Controller;

use App\Entity\Prestataire;
use App\Form\InternauteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profil(Request $request)
    {
        $user = $this->getUser();
        if($user instanceof Prestataire){
            $userType = 'prestataire';
            ////todo formulaire prestataire
            $form = $this->createForm(PrestataireFormType::class, $user);
        }else{
            $userType = 'internaute';
            $form = $this->createForm(InternauteFormType::class, $user);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $newsletter = $form['newsLetter']->getData();
            $newsletter = array_shift($newsletter);
            $user->setNewsLetter($newsletter);

            //$user->setPassword($passwordEncoder->encodePassword($user ,$user->getpassword()))
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('profil/profil.html.twig', [
            'user_type'=>$userType,
            'user'=>$user,
            'profilForm' => $form->createView(),
        ]);
    }

}