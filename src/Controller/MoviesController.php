<?php

namespace App\Controller;

use MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private MovieService $movieService;
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }
    /**
     * @Route("/movies", name="movies")
     */
    public function index(): Response
    {
        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
        ]);
    }
    /**
     * @Route("/AddMovie", name="Add Movie")
     */
    public function AddMovie(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if(!empty($data)) {
            $this->movieService->InsertMovieToDb($data);
        } else {
            return new JsonResponse("Le JSON est vide gros", Response::HTTP_BAD_REQUEST);
        }
        $lastAdded = $this->movieService->GetLastAddedMovies();
        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
            'lastAdded' => $lastAdded
        ]);
    }
}
