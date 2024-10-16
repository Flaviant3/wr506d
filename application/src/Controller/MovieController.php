<?php

namespace App\Controller;

use App\Entity\Movie; // Assurez-vous que cette entité existe
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/api/movies/latest', name: 'latest_movies', methods: ['GET'])]

    public function latestMovies(EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les derniers films (assurez-vous que cette méthode fonctionne)
        $movies = $entityManager->getRepository(Movie::class)->findBy([], ['created_at' => 'DESC'], 4);

        return $this->json($movies);
    }
}
?>