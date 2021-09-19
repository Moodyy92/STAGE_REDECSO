<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ClientRepository $clientRepository): Response
    {
        $clientList = $clientRepository->findAll();
//        dd($clientList);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'clients' =>$clientList,
        ]);
    }
}