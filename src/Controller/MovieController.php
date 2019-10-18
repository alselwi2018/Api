<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Class MovieController
 * @package App\Controller
 * @Route("/api", name="api")
 */
class MovieController extends FOSRestController
{
    /**
     * Lists all Movies
     * @Rest\Get("/movies")
     * @return Response
     */
    public function getMovieAction()
    {
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $movie = $repository->findAll();
        return $this->handleView($this->view($movie));
    }

    /**
     * create movie
     * @Rest\Post("/movies")
     * @return Response
     */
    public function postMovieAction(Request $request)
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();
            return $this->handleView($this->view(['status'=>'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }
}
