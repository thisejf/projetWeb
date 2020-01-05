<?php

namespace App\Controller;

use App\Entity\Internaute;
use App\Entity\Prestataire;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, MailerInterface $mailer): Response
    {
        $form = $this->createForm(RegistrationFormType::class);
        $data = $form->handleRequest($request);

        $mail = $form->get('eMail')->getData();
        $pW = $form->get('password')->getData();
        $role = $form->get('roles')->getData();

        if($role ==='ROLE_INTERNAUTE'){
            $user = new Internaute();
        }else{
            $user = new Prestataire();
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setEMail($mail)
            ->setPassword($passwordEncoder->encodePassword($user, $pW))
            ->setInscription(new \DateTime())
            ->setRoles([$role]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            //
            $email = (new TemplatedEmail())
                ->from('info@annuaire.be')
                ->to($mail)
                ->subject('Time for Symfony Mailer!')
                ->htmlTemplate('emails/signup.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'role' => $role
                ]);
            /** @var Symfony\Component\Mailer\SentMessage $sentEmail */
            $mailer->send($email);

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
}