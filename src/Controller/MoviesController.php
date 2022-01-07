<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Services\MovieService;
use App\Services\SerializerService;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private MovieService $movieService;
    private MovieRepository $movieRepository;
    private SerializerService $serializerService;

    public function __construct(MovieService $movieService, MovieRepository $movieRepository, SerializerService $serializerService)
    {
        $this->movieService = $movieService;
        $this->movieRepository = $movieRepository;
        $this->serializerService = $serializerService;
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

    /**
     * @Route("/movies/all", name="Get all movies")
     */
    public function GetAllMovies(): JsonResponse
    {
        $movies = $this->movieRepository->findAll();
        $json = $this->serializerService->SimpleSerializer($movies, 'json');
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/movies/{id}", name="getId")
     */
    public function GetMovieById($id): JsonResponse
    {
        $movie = $this->movieService->GetSingleMovieById($id);
        if (!empty($movie))
        {
            $json = $this->serializerService->SimpleSerializer($movie, 'json');
            return JsonResponse::fromJsonString($json);
        }
        else
        {
            return new JsonResponse("Not Found", Response::HTTP_NOT_FOUND);
        }
    }
}
