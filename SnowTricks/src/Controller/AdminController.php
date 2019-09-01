<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/login", name="admin_login")
     */
    public function login()
    {
        return $this->render('admin/login.html.twig');
    }

    /**
     * @Route("/admin/area", name="admin_area")
     */
    public function userArea() {

        return $this->render('admin/adminArea.html.twig');

    }

     /**
     * @Route("/adminlogout", name="admin_logout")
     */
    public function logout() {}
}
