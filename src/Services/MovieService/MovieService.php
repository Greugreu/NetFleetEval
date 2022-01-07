<?php

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

    public function InsertMovieToDb()
    {

    }

    public function GetSingleMovieById()
    {

    }
}