<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use DateTimeImmutable;
use App\Entity\Actor;
use App\Entity\Movie;

class AppFixtures extends Fixture
{
    private const TOTAL_ACTORS = 100; // Nombre total d'acteurs
    private const TOTAL_MOVIES = 100; // Nombre total de films
    private const ITEMS_PER_PAGE = 10; // Nombre d'éléments par page

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

        // Créer des acteurs
        for ($i = 0; $i < self::TOTAL_ACTORS; $i++) {
            $actor = new Actor();
            $actor->setLastname($faker->lastName);
            $actor->setFirstname($faker->firstName);
            $actor->setDob($faker->dateTimeThisCentury());
            $actor->setBio($faker->text(20));
            $actor->setMovie($faker->text(20));
            $actor->setName($faker->text(20));
            $actor->setNationality($faker->country);
            $actor->setMedia($faker->imageUrl());
            $actor->setGender($faker->randomElement(['male', 'female']));
            $actor->setCreatedAt(new DateTimeImmutable());
            $actor->setUpdatedAt(new DateTimeImmutable());

            $manager->persist($actor);
        }

        // Créer des films
        for ($i = 0; $i < self::TOTAL_MOVIES; $i++) {
            $movie = new Movie();
            $movie->setTitle($faker->sentence(3));
            $movie->setDescription($faker->text(20));
            $movie->setReleaseDate($faker->dateTimeBetween('-30 years', 'now'));
            $movie->setDuration($faker->numberBetween(60, 180));
            $movie->setEntries($faker->numberBetween(1000, 100000));
            $movie->setDirector($faker->name);
            $movie->setRating($faker->randomFloat(1, 1, 10));
            $movie->setMedia($faker->imageUrl());

            // Associer des acteurs au film
            $actors = $manager->getRepository(Actor::class)->findAll();
            shuffle($actors);
            $selectedActors = array_slice($actors, 0, 4);
            foreach ($selectedActors as $actor) {
                $movie->addActor($actor);
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
