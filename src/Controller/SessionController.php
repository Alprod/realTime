<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Session;

class SessionController extends AbstractController
{
    /**
     * @Route("/", name="session_index")
     * Affiche l'ensemble des session classer par odre de production
     */
    public function index()
    {
        $re = $this->getDoctrine()->getRepository(Session::class);

        return $this->render('session/index.html.twig', [
            'sessions' => $re->findBy([], ['datetime' => 'ASC'])
        ]);
    }

    /**
     *  @Route("/session{id}", name="session_detail")
     * Affiche le detail d'une session par l'id
     */
    public function detail(Session $session)
    {
        return $this->render('session/detail.html.twig', ['session' => $session]);
    }
}
