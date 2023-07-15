<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{


    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    

    #[Route('/posts', name: 'app_posts')]
    public function index(): Response
    {
        $repo = $this->entityManager->getRepository(Post::class);
        $posts =  $repo->findBy([], ['id' => 'DESC']);
  
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/detail/{id}', name: 'app_details_posts')]
    public function detail(PostRepository $repo, $id): Response
    {
       

        $post =  $repo->find($id);
  
        return $this->render('post/detail.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/post/delete/{id}', name: 'app_delete_posts')]
    public function delete(PostRepository $repo, EntityManagerInterface $entityManager, $id): Response
    {
       
        
        $post =  $repo->find($id);
        $entityManager->remove($post);
        $entityManager->flush();
  
        return $this->redirectToRoute('app_posts');
    }
}
