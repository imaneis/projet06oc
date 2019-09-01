<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Form\UserRegistrationType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/signup", name="user_security")
     */
    public function registration()
    {
    	$user = new Users();
    	$form = $this->createForm(UserRegistrationType::class, $user);
        
        return $this->render('security/userRegistration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
