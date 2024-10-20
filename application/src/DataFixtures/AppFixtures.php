<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Actor;
use App\Entity\Movie;
use App\DataFixtures\images;

include 'images.php';

class AppFixtures extends Fixture
{
    private const TOTAL_ACTORS = 100;
    private const TOTAL_MOVIES = 100;
    private const TOTAL_CATEGORIES = 10;
    private const ITEMS_PER_PAGE = 10;

    public function load(ObjectManager $manager)
    {

        $faker = Factory:: create('FR-fr');
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

// Create Actors
        for ($i = 0; $i < self::TOTAL_ACTORS; $i++) {
            $actor = new Actor();
            $actor->setLastname($faker->actor());
            $actor->setDob($faker->dateTimeThisCentury());
            $actor->setBio($faker->text(100));
            $actor->setNationality($faker->country());
            $actor->setMedia('https://image.tmdb.org/t/p/original//aWeKITRFbbwY8txG5uCj4rMCfSP.jpg');
            $actor->setGender($faker->randomElement(['male', 'female']));
            $actor->setCreatedAt(new DateTimeImmutable());
            $actor->setUpdatedAt(new DateTimeImmutable());
            $dob = $actor->getDob();
            $actor->setDeathDate($faker->optional(0.15)->dateTimeBetween($dob, 'now'));

// Récupérer une image aléatoire pour l'acteur
            $imageUrls = ActorImages::getImages();
            $randomImageUrl = $faker->randomElement($imageUrls);
            $actor->setMedia($randomImageUrl);

            $this->addReference("actor_$i", $actor);
            $manager->persist($actor);
        }

// Create Movies
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        for ($i = 0; $i < self::TOTAL_MOVIES; $i++) {
            $movie = new Movie();
            $movie->setTitle($faker->movie);
            $movie->setDescription($faker->overview);
            $movie->setReleaseDate($faker->dateTimeBetween('-30 years', 'now'));
            $movie->setDuration($faker->numberBetween(60, 180));
            $movie->setEntries($faker->numberBetween(1000, 100000));
            $movie->setDirector($faker->name);
            $movie->setGenre($faker->movieGenre());
            $movie->setStudio($faker->company);
            $movie->setRating($faker->randomFloat(1, 1, 10));
            $movie->setMedia('https://image.tmdb.org/t/p/original//aWeKITRFbbwY8txG5uCj4rMCfSP.jpg');
            $movie->setCreatedAt(new DateTimeImmutable());
            $movie->addActor($this->getReference("actor_" . $faker->numberBetween(0, self::TOTAL_ACTORS - 1)));
            $movie->addActor($this->getReference("actor_" . $faker->numberBetween(0, self::TOTAL_ACTORS - 1)));

            $imageUrls = \App\DataFixtures\images::getImages();
            $randomImageUrl = $faker->randomElement($imageUrls);
            $movie->setMedia($randomImageUrl);

            $actors = $manager->getRepository(Actor::class)->findAll();
            shuffle($actors);
            $selectedActors = array_slice($actors, 0, 4);
            foreach ($selectedActors as $actor) {
                $movie->addActor($actor);
            }

            $manager->persist($movie);
        }

// Create Categories
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        for ($i = 0; $i < self::TOTAL_CATEGORIES; $i++) {
            $category = new Category();
            $category->setTitle($faker->movieGenre());
            $category->setCreatedAt(new DateTimeImmutable());
            $category->setUpdatedAt(new DateTimeImmutable());

            $actors = $manager->getRepository(Actor::class)->findAll();
            shuffle($actors);
            $selectedActors = array_slice($actors, 0, 4);
            foreach ($selectedActors as $actor) {
                $category->addActor($actor);
            }

            $manager->persist($category);
        }

        $manager->flush();
    }
}