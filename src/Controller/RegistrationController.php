<?php

namespace App\Controller;

use App\Entity\Internaute;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Repository\InternauteRepository;
use App\Repository\PrestataireRepository;
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
     * @Route("/register/confirmation/{token}", name="register_confirmation")
     */
    public function confirmation(string $token, Request $request, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, PrestataireRepository $prestataireRepository, InternauteRepository $internauteRepository)
    {
        if($prestataireRepository->findByToken($token) != null){
            $user = $prestataireRepository->findByToken($token);
        }elseif($internauteRepository->findByToken($token) != null){
            $user = $internauteRepository->findByToken($token);
        }else{
            $this->redirectToRoute('app_register');
        }
        $user = array_shift($user);
        $user->setInscriptionConf(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $authenticator,
            'main' // firewall name in security.yaml
        );
    }
}