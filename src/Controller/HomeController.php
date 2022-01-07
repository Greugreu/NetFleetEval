<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Services\MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private MovieRepository $movieRepository;
    private MovieService $movieService;

    public function __construct(MovieRepository $movieRepository, MovieService $movieService)
    {
        $this->movieRepository = $movieRepository;
        $this->movieService = $movieService;
    }

    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $movies = $this->movieService->GetLastAddedMovies();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'movies' => $movies,
        ]);
    }
}
