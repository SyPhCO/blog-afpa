<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\AddArticleType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Location;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddPostController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }



    #[Route('/addpost', name: 'app_add_post')]
    public function addPost( Request $request): Response
    {

        $post = new Post();
        $form = $this->createForm(AddArticleType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setTitle($post->getTitle())
                ->setcontent($post->getcontent());

            $this->entityManager->persist($post);
            $this->entityManager->flush();

        }

        return $this
        ->render('add_post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/modif/post', name: 'app_modif_post')]
    public function modifPost( Request $request): Response
    {

        $post = new Post();
        $form = $this->createForm(AddArticleType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setTitle($post->getTitle())
                ->setcontent($post->getcontent());

            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }
    
        return $this->render('add_post/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
