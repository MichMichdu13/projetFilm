<?php

namespace App\Controller;



use App\Entity\FavFilm;
use App\Form\SearchType;
use App\Repository\AvisRepository;
use App\Repository\RateRepository;
use App\Service\ApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class FilmController extends AbstractController
{
    #[Route("/", name: "app_homepage")]

    public function homepage(ApiService $apiService, Request $request)
    {
        $films = $apiService->requestApi(
            'GET',
            'https://imdb-api.com/en/API/MostPopularMovies/ApiKey'
        );
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            return $this->redirectToRoute('app_search_show', ['recherche' => $form->getData()['recherche']]);
        }
        return $this->render('home.html.twig',[
            'films' => $films,
            'form' => $form->createView(),
        ]);
    }


    #[Route("/{type<film|serie>}/fav", name: "app_film_fav",priority: 100)]
    #[IsGranted("ROLE_USER")]
    public function favFilm(EntityManagerInterface $entityManager, Request $request, ValidatorInterface $validator,$type){
        $fav = new FavFilm();
        $fav->setIdFilm($request->query->get("filmId"));
        $fav->setImgFilm($request->query->get("filmImage"));
        $fav->setTitreFilm($request->query->get("filmTitle"));
        $fav->setUserId($this->getUser());
        if($validator->validate($fav)->count() == 0){
            $entityManager->persist($fav);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_film_show', ["type"=> $type,"id_film" => $request->query->get("filmId")]);
    }


    #[Route("/{type<film|serie>}/{id_film}", name: "app_film_show", priority: 10)]

    public function show($id_film, ApiService $apiService,RateRepository $rateRepository, AvisRepository $repository)
    {

        $film = $apiService->requestApi(
            'GET',
            'https://imdb-api.com/en/API/Title/ApiKey/'.$id_film
        );
        $avis = $repository->findBy(['idSorage' => $id_film]);
        $rates = $rateRepository->findBy(['idObject' => $id_film]);
        if($rates!= null){
            $nombreNote=0;
            $note=0;
            foreach ($rates as $rate){
                $note = $note+$rate->getRateNumber();
                $nombreNote++;
            }
            $rateStar = intval(round(($note*20)/$nombreNote));
            $rates = $note/$nombreNote;
        }else{
            $rateStar = 0;
            $rates = 0;
        }
        return $this->render('film/showFilm.html.twig', [
            'film' => $film,
            'avis' => $avis,
            'starRate' => $rateStar,
            'Rate' => $rates
        ]);
    }
}

//k_j7187ii9