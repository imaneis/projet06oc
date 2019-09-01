<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\ArticleRepository;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ArticleRepository $repo)
    {

    	$articles = $repo->findAll();

        foreach ($articles as $key => $value) {
          $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }
    	
        return $this->render('blog/home.html.twig', [
        	'articles' => $articles
        ]);
    }
}
