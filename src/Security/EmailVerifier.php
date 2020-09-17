<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailVerifier
{
    private $verifyEmailHelper;
    private $entityManager;

    public function __construct(VerifyEmailHelperInterface $helper, EntityManagerInterface $manager)
    {
        $this->verifyEmailHelper = $helper;
        $this->entityManager = $manager;
    }

    public function sendEmailConfirmation(string $verifyEmailRouteName, UserInterface $user): void
    {
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            $verifyEmailRouteName,
            $user->getId(),
            $user->getEmail()
        );

        $transport = (new \Swift_SmtpTransport('mail.continuousnet.com', 587))
        ->setUsername('jihen.bensaid@continuousnet.com')
        ->setPassword('j?V?tD4j');

        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message('registration'))
        ->setfrom('jihen.bensaid@continuousnet.com')
        ->setTo($user->getEmail())
        ->setBody('registration/confirmation_email.html.twig');
        // $context = $email->getContext();
        // $context['signedUrl'] = $signatureComponents->getSignedUrl();
        // $context['expiresAt'] = $signatureComponents->getExpiresAt();

        // $email->context($context);

        $mailer->send($message);
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    public function handleEmailConfirmation(Request $request, UserInterface $user): void
    {
        $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());

        $user->setIsVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
