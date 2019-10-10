<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\ArticleRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $repo)
    {

    	$articles = $repo->findAll();
    	
        return $this->render('home/index.html.twig', [
        	'articles' => $articles
        ]);
    }
}
