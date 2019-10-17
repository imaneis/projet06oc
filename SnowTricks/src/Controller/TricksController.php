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
use App\Repository\CommentRepository;

class TricksController extends AbstractController
{
    /**
     * @Route("/tricks/{id}/{page}", requirements={"page" = "\d+"}, name="tricks")
     */
    public function index($page, CommentRepository $repo, Article $article, Request $request, ObjectManager $manager)
    {

        $nbArticlesParPage = 1;

        $comments = $repo->findAllPagineEtTrie($page, $nbArticlesParPage);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($comments) / $nbArticlesParPage),
            'nomRoute' => 'tricks',
            'paramsRoute' => array()
        );


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
            'commentForm' => $form->createView(),
             'comments' => $comments,
            'pagination' => $pagination
        ]);
    }
}
