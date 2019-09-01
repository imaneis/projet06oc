<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class TricksController extends AbstractController
{
    /**
     * @Route("/tricks/{id}", name="tricks")
     */
    public function index(Article $article, Request $request, ObjectManager $manager)
    {

    	$comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

         $username = $this->getUser()->getUsername();

            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article)
                    ->setUser($this->getUser())
                    ->setAuthor($username);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('tricks', ['id' => $article->getId()]);
        }


        return $this->render('tricks/index.html.twig', [
            'trick' => $article,
            'commentForm' => $form->createView()
        ]);
    }
}
