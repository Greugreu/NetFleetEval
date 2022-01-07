<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++)
        {
            $movie = new Movie();
            $movie->setName($faker->name);
            $movie->setSynopsis($faker->text);
            $movie->setGenre($faker->word);
            $movie->setCreatedAt(new DateTimeImmutable());

            $this->entityManager->persist($movie);
        }
        $this->entityManager->flush();
    }
}
