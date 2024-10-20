<?php

// src/Controller/GraphQL/MovieResolver.php

namespace App\Controller\GraphQL;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\Error;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MovieResolver
{
private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
$this->entityManager = $entityManager;
}

public function movies()
{
return $this->entityManager->getRepository(Movie::class)->findAll();
}

public function movie($id)
{
return $this->entityManager->getRepository(Movie::class)->find($id);
}

public function createMovie($title, $description, $releaseDate)
{
$movie = new Movie();
$movie->setTitle($title);
$movie->setDescription($description);
$movie->setReleaseDate(new \DateTime($releaseDate));

$this->entityManager->persist($movie);
$this->entityManager->flush();

return $movie;
}

public function updateMovie($id, $title, $description, $releaseDate)
{
$movie = $this->entityManager->getRepository(Movie::class)->find($id);
if (!$movie) {
throw new Error('Movie not found');
}

$movie->setTitle($title);
$movie->setDescription($description);
if ($releaseDate) {
$movie->setReleaseDate(new \DateTime($releaseDate));
}

$this->entityManager->flush();

return $movie;
}

public function deleteMovie($id)
{
$movie = $this->entityManager->getRepository(Movie::class)->find($id);
if (!$movie) {
throw new Error('Movie not found');
}

$this->entityManager->remove($movie);
$this->entityManager->flush();

return true;
}
}
