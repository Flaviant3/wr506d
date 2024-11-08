<?php

namespace App\Controller;

use App\Entity\Movie; // Assurez-vous que cette entité existe
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/api/movies/latest', name: 'latest_movies', methods: ['GET'])]
    public function latestMovies(EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les derniers films
        $movies = $entityManager->getRepository(Movie::class)->findBy([], ['created_at' => 'DESC'], 4);
        return $this->json($movies);
    }

    #[Route('/api/movies', name: 'create_movie', methods: ['POST'])]
    public function createMovie(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Créez une nouvelle instance de Movie
        $movie = new Movie();
        $movie->setTitle($data['title']);
        $movie->setDescription($data['description']);
        $movie->setReleaseDate(new \DateTime($data['release_date']));
        $movie->setDuration($data['duration']);
        $movie->setEntries($data['entries']);
        $movie->setDirector($data['director']);
        $movie->setGenre($data['genre']);
        $movie->setMedia($data['media']);
        $movie->setRating($data['rating']);
        $movie->setSaga($data['saga']);
        $movie->setStudio($data['studio']);

        // Persistez l'entité dans la base de données
        $entityManager->persist($movie);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Movie created!', 'id' => $movie->getId()], 201);
    }
}
