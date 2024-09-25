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
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

        $actors = $faker->actors($gender = null, $count = 190, $duplicates = false);
        $createdActors = [];
        foreach ($actors as $item) {
            $fullname = $item; //ex : Christian Bale
            $fullnameExploded = explode(' ', $fullname);

            $firstname = $fullnameExploded[0]; //ex : Christian
            $lastname = $fullnameExploded[1]; //ex : Bale

            $actor = new Actor();
            $actor->setLastname($lastname);
            $actor->setFirstname($firstname);
            $actor->setDob($faker->dateTimeThisCentury());
            $actor->setCreatedAt(new DateTimeImmutable());

            $createdActors[] = $actor;

            $manager->persist($actor);
        }

        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $movies = $faker->movies(100);
        foreach ($movies as $item) {
            $movie = new Movie();
            $movie->setTitle($item);

            shuffle($createdActors);
            $createdActorsSliced = array_slice($createdActors, 0, 4);
            foreach ($createdActorsSliced as $actor) {
                $movie->addActor($actor);
            }
            $manager->persist($movie);
        }


        $manager->flush();
        return true;
    }
}