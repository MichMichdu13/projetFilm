<?php

namespace App\Controller;

use App\Entity\FavActeurs;
use App\Entity\Rate;
use App\Repository\AvisRepository;
use App\Repository\RateRepository;
use App\Service\ApiService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ActeurController extends AbstractController
{
    #[Route("/acteur/fav", name: "app_acteur_fav")]
    #[IsGranted("ROLE_USER")]
    public function favActeur(EntityManagerInterface $entityManager, Request $request, ValidatorInterface $validator){
        $fav = new FavActeurs();
        $fav->setIdActeur($request->query->get("acteurId"));
        $fav->setImageActeur($request->query->get("acteurImage"));
        $fav->setNameActeur($request->query->get("acteurName"));
        $fav->setUserId($this->getUser());
        if($validator->validate($fav)->count() == 0){
            $entityManager->persist($fav);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_acteur_show', ["id_acteur" => $request->query->get("acteurId")]);
    }
    #[Route("/acteur/{id_acteur}", name: "app_acteur_show")]

    public function show($id_acteur, ApiService $apiService, AvisRepository $repository, RateRepository $rateRepository)
    {

        $acteur = $apiService->requestApi(
            'GET',
            'https://imdb-api.com/en/API/Name/ApiKey/'.$id_acteur
        );

        $avis = $repository->findBy(['idSorage' => $id_acteur]);

        $rates = $rateRepository->findBy(['idObject' => $id_acteur]);
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

        return $this->render('acteur/showActeur.html.twig', [
            'acteur' => $acteur,
            'avis' => $avis,
            'starRate' => $rateStar,
            'Rate' => $rates
        ]);
    }

}