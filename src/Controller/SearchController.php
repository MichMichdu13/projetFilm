<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search/{recherche}', name: 'app_search_show', priority: 100)]
    public function show($recherche,ApiService $apiService, Request $request)
    {
        $search = $apiService->requestApi(
            'GET',
            'https://imdb-api.com/en/API/SearchAll/ApiKey/'.$recherche,
        );
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            return $this->redirectToRoute('app_search_show', [
                'recherche' => $form->getData()['recherche'],
            ]);
        }
        return $this->render('search/show.html.twig', [
            "search" => $search,
            'form' => $form->createView(),
        ]);
    }
}
