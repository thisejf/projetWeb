<?php

namespace App\Controller;

use App\Entity\Internaute;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use App\Service\MailGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, MailGenerator $mailGenerator): Response
    {

        $data = $request->get('registration_form', '');

        if($data){
            if($data['roles'] === Utilisateur::ROLE_INTERNAUTE){
                $user = new Internaute();
            }else{
                $user = new Prestataire();
            }
        }else{
            $user = new Utilisateur();
        }

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $user = $form->getData();
            $user->setInscription($date)
                ->setPassword($passwordEncoder->encodePassword($user ,$user->getpassword()))
                ->setRoles([$data['roles']])
                ->setRegisterToken(hash('ripemd160' ,$date->getTimestamp().'MonSuperToken'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            $mailGenerator->registrationMail($user);

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/confirmation/{register_token}", name="register_confirmation")
     *
     */
    public function confirmation(Utilisateur $utilisateur, Request $request, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator):Response
    {
        //todo : créer une exception custom
        if($utilisateur == null){
            $this->redirectToRoute('app_register');
        }

        //vérifie si la date de confirmation n'est pas supérieur à 7 jours par rapport à l'inscription.
        $interval = $utilisateur->getInscription()->diff(new \DateTime());

        if($interval->format('%d') <= 7 ){
            $utilisateur->setInscriptionConf(true);
            $utilisateur->setRegisterToken(null);
            $this->addFlash('success', 'Votre profil a bien été confirmé!');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $utilisateur,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );

        }else{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilisateur);
            $entityManager->flush();
            $this->addFlash('fail', "Votre profil n'a pas été confirmé à temps! Merci de vous réinscrire");
            return $this->redirectToRoute('app_register');
        }


    }
}