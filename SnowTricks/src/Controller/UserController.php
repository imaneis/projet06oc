<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\ArticleFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Article;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use  App\Repository\ArticleRepository;


class UserController extends AbstractController
{
    /**
     * @Route("/signup", name="user_signup")
     */
    public function signup(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
    	$user = new User();

    	$form = $this->createForm(RegistrationType::class, $user);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $file = $form->get('image')->getData();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );

            $user->setImage($fileName);

    		$manager->persist($user);
         	$manager->flush();

            return $this->redirectToRoute('user_signin');
    	}

        return $this->render('user/userSignup.html.twig', [
        	'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/signin", name="user_signin")
     */
    public function signin() {

        return $this->render('user/userSignin.html.twig');

    }

     /**
     * @Route("/logout", name="user_logout")
     */
    public function logout() {}

     /**
     * @Route("/user/area", name="user_area")
     */
    public function userArea(ArticleRepository $repo) {

        $user = $this->getUser();

        $username = $user->getUsername();

        $articles = $repo->findBy(array('Author' => $username));

        return $this->render('user/userArea.html.twig', [
            'user' => $user,
            'articles' => $articles
        ]);

    }

    /**
     * @Route("/user/create", name="user_create")
     */
    public function userCreate(Request $request, ObjectManager $manager) {
            
            $article = new Article();

            $form = $this->createForm(ArticleFormType::class, $article);

            $form->handleRequest($request);

            $username = $this->getUser()->getUsername();

            if ($form->isSubmitted() && $form->isValid()) {

                try{

                $article->setCreatedAt(new \DateTime());
                $article->setAuthor($username);
                $file1 = $article->getImage1();

                $fileName = $this->generateUniqueFileName().'.'.$file1->guessExtension();

                // moves the file to the directory where brochures are stored
                $file1->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage1($fileName);

                $file2 = $article->getImage2();

                $fileName = $this->generateUniqueFileName().'.'.$file2->guessExtension();

                // moves the file to the directory where brochures are stored
                $file2->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage2($fileName);

                $file3 = $article->getImage3();

                $fileName = $this->generateUniqueFileName().'.'.$file3->guessExtension();

                // moves the file to the directory where brochures are stored
                $file3->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage3($fileName);

                $file4 = $article->getImage4();

                $fileName = $this->generateUniqueFileName().'.'.$file4->guessExtension();

                // moves the file to the directory where brochures are stored
                $file4->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage4($fileName);

                $manager->persist($article);
                $manager->flush();

                $this->addFlash('success', 'Le trick a été ajoutée à la base de données avec succès');

                return $this->redirectToRoute('home');

                }
                catch(\Exception $e){
                    $this->addFlash('error', 'une erreur s\'est produite lors de l\'ajout du trick dans la base de données');
                }
            }

        return $this->render('user/userCreate.html.twig', [

            'formArticle' => $form->createView()

        ]);

    }

     private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

     /**
     * @Route("/user/edit/{id}", name="user_edit")
     */
    public function userEdit($id, ArticleRepository $repo, Request $request, ObjectManager $manager) {


            $article = $repo->find($id);

            $form = $this->createForm(ArticleFormType::class, $article);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                try{

                $file1 = $article->getImage1();

                $fileName = $this->generateUniqueFileName().'.'.$file1->guessExtension();

                // moves the file to the directory where brochures are stored
                $file1->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage1($fileName);

                $file2 = $article->getImage2();

                $fileName = $this->generateUniqueFileName().'.'.$file2->guessExtension();

                // moves the file to the directory where brochures are stored
                $file2->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage2($fileName);

                $file3 = $article->getImage3();

                $fileName = $this->generateUniqueFileName().'.'.$file3->guessExtension();

                // moves the file to the directory where brochures are stored
                $file3->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage3($fileName);

                $file4 = $article->getImage4();

                $fileName = $this->generateUniqueFileName().'.'.$file4->guessExtension();

                // moves the file to the directory where brochures are stored
                $file4->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $article->setImage4($fileName);

                $manager->persist($article);
                $manager->flush();

                $this->addFlash('success', 'the trick was edited');


                return $this->redirectToRoute('home');

                 }
                catch(\Exception $e){
                     $this->addFlash('error', 'there was an error somewhere there');
                }

            }

        return $this->render('user/userEdit.html.twig', [
            'article' => $article,
            'formArticle' => $form->createView()
        ]);

    }

    /**
     * @Route("/user/delete/{id}/{state}", name="user_delete")
     */
    public function userDelete($id, $state, ArticleRepository $repo, ObjectManager $manager) {

         $article = $repo->find($id);

         $image1 = $article->getImage1();

         unlink("../public/uploads/brochures/" . $image1);

         $image2 = $article->getImage2();

         unlink("../public/uploads/brochures/" . $image2);

         $image3 = $article->getImage3();

         unlink("../public/uploads/brochures/" . $image3);

         $image4 = $article->getImage4();

         unlink("../public/uploads/brochures/" . $image4);

         $manager->remove($article);
         $manager->flush();

         if ($state === "true") {
            return $this->redirectToRoute('user_area');
         }
         else{
            return $this->redirectToRoute('home');
         }

    }

}
