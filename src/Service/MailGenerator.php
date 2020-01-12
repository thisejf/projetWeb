<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

Class MailGenerator {

    private $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer = $mailer;
    }

    public function registrationMail($user){
        $email = (new TemplatedEmail())
            ->from('info@annuaire.be')
            ->to($user->getEMail())
            ->subject('Time for Symfony Mailer!')
            ->htmlTemplate('emails/register.html.twig')
            ->context([
                'expiration_date' =>$user->getInscription()->add(new \DateInterval('P7D')),
                'user'=>$user
            ]);
        /** @var Symfony\Component\Mailer\SentMessage $sentEmail */
        $this->mailer->send($email);
    }
}