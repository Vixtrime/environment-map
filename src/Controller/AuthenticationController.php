<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\PatchedInitialValuesNormalizer;
use Limenius\Liform\Liform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthenticationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function registerUser(Request $request, Liform $liform, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user, ['csrf_protection' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute('dashboard');
        }
        $cnx = $this->getDoctrine()->getConnection();
        dump($cnx);

        $cnx->isConnected() ? 'Connected' : 'not connected';
        dump($cnx);
        $schema = json_encode($liform->transform($form));
        $normalizer = new PatchedInitialValuesNormalizer();
        $data = (array) $normalizer->normalize($form);
//        dump($schema);
//        dump($data);
//        dump($form->createView());
        return $this->render('register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function userLogin()
    {
        return true;
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function userLogout()
    {
        return true;
    }
}
