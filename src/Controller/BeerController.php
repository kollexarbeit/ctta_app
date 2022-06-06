<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BeerController extends AbstractController
{
    #[Route('/beer/{id}', name: 'app_beer')]
    public function index(int $id): Response
    {
        $client = new \GuzzleHttp\Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.punkapi.com/',
            // You can set any number of default request options.
            //'timeout'  => 2.0,
            //'verify' => false,
            \GuzzleHttp\RequestOptions::VERIFY => \Composer\CaBundle\CaBundle::getSystemCaRootBundlePath()
            
        ]);
        $response = $client->request('GET', '/v2/beers/'.$id);
        $body = $response->getBody();
        $rows = json_decode($body); 
        
        return $this->render('beer/index.html.twig', [
            'beer' => $rows[0],
        ]);
    }
}
