<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'serie')]
    public function show(ApiService $apiService, Request $request)
    {
        $series = $apiService->requestApi(
            'GET',
            'https://imdb-api.com/en/API/Top250TVs/ApiKey'
        );
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            return $this->redirectToRoute('app_search_show', ['recherche' => $form->getData()['recherche']]);
        }
        return $this->render('serie/show.html.twig',[
            'series' => $series,
            'form' => $form->createView(),
        ]);
    }
}
