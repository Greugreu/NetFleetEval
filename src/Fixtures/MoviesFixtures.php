<?php

use App\Entity\Movie;
use Doctrine\Persistence\ObjectManager;

class MoviesFixtures
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++)
        {
            $movie = new Movie();
            $movie->setName($faker->title);
            $movie->setSynopsis($faker->text);
            $movie->setGenre($faker->word);
            $movie->setCreatedAt(new DateTimeImmutable());

            $manager->persist($movie);
        }
        $manager->flush();
    }
}