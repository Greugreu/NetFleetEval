<?php

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;

class MovieService implements IMovieService
{
    private EntityManagerInterface $entityManager;
    private MovieRepository $movieRepository;

    public function __construct(EntityManagerInterface $entityManager, MovieRepository $movieRepository)
    {
        $this->entityManager = $entityManager;
        $this->movieRepository = $movieRepository;
    }

    public function InsertMovieToDb($data)
    {
        $movie = new Movie();
        $movie->setName($data['Name']);
        $movie->setSynopsis($data['Synopsis']);
        $movie->setGenre($data['Genre']);
        $movie->setCreatedAt(new DateTimeImmutable('now'));

        $this->entityManager->persist($movie);
        $this->entityManager->flush();
    }

    public function UpdateMovie($data)
    {
        $movie = $this->GetSingleMovieById($data['id']);
        if (!empty($movie))
        {
            $movie->setName($data['Name']);
            $movie->setSynopsis($data['Synopsis']);
            $movie->setGenre($data['Genre']);
            $movie->setModifiedAt(new DateTimeImmutable('now'));

            $this->entityManager->persist($movie);
        }

        $this->entityManager->flush();
    }

    public function GetSingleMovieById($id): ?Movie
    {
        return $this->movieRepository->findOneBy(["id" => $id]);
    }

    public function GetLastAddedMovies(): array
    {
        $date = new \DateTime('now');
        return $this->movieRepository->findBy(["created_at" => $date]);
    }
}