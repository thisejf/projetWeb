<?php
/**
 * Created by PhpStorm.
 * User: jfr
 * Date: 2019-12-16
 * Time: 18:27
 */

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Prestataire;
use App\Form\InternauteFormType;
use App\Form\PrestataireFormType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profil(Request $request, FileUploader $fileUploader)
    {
        $user = $this->getUser();
        if($user instanceof Prestataire){
            $form = $this->createForm(PrestataireFormType::class, $user);
        }else{
            $form = $this->createForm(InternauteFormType::class, $user);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            if($user->getType() === 'ROLE_INTERNAUTE'){
                $newsletter = $form['newsLetter']->getData();
                $newsletter = array_shift($newsletter);
                $user->setNewsLetter($newsletter);
            }

            $imageFile = $form['image']->getData();
            if ($imageFile){
                $image = new Images();
                $imageFileName = $fileUploader->upload($imageFile);
                $image->setImage($imageFileName);
                $user->setImage($image);
            }

            //$user->setPassword($passwordEncoder->encodePassword($user ,$user->getpassword()))
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('profil/profil.html.twig', [
            'user'=>$user,
            'profilForm' => $form->createView(),
        ]);
    }
}