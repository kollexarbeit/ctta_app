<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beer;
use Doctrine\Persistence\ManagerRegistry;

class BeersController extends AbstractController
{
    #[Route('/beers', name: 'app_beers')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Beer::class);
        $beers = $repository->getAll();
        
        return $this->render('beers/index.html.twig', [
            'beers' => $beers,
        ]);
    }
}
