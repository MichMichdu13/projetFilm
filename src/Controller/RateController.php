<?php

namespace App\Controller;

use App\Entity\Rate;
use App\Entity\RateListe;
use App\Form\SearchType;
use App\Repository\RateListeRepository;
use App\Repository\RateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RateController extends AbstractController
{
    #[Route('/rate/{id}/{type<acteur|film|serie>}/{rateChoice}', name: 'rate')]
    #[IsGranted("ROLE_USER")]
    public function newEdit($id,$type,$rateChoice,EntityManagerInterface $entityManager, Request $request, RateRepository $rateRepository,RateListeRepository $rateListeRepository,ValidatorInterface $validator)
    {

        $rateTry = $rateRepository->findOneBy(['idObject' => $id,'User' => $this->getUser()]);
        if($rateTry == null){
            $rate = new Rate();
            $rate->setIdObject($id);
            $rate->setRateNumber($rateChoice);
            $rate->setUser($this->getUser());
            if($validator->validate($rate)->count() == 0){
                $entityManager->persist($rate);
                $entityManager->flush();
            }
        }else{
            $rateTry->setRateNumber($rateChoice);
            $entityManager->flush();
        }
        $rateListeTry = $rateListeRepository->findOneBy(['IdFilm'=> $id]);
        if($rateListeTry == null){
            $rateListe = new RateListe();
            $rateListe->setIdFilm($id);
            $rateListe->setMoyenneRate($rateChoice);
            $rateListe->setImg($request->query->get("img"));
            $rateListe->setNameFilm($request->query->get("name"));
            $rateListe->setType($type);
            if($validator->validate($rateListe)->count() == 0){
                $entityManager->persist($rateListe);
                $entityManager->flush();
            }

        }else{
            $rates = $rateRepository->findBy(['idObject' => $id]);
            $nombreNote=0;
            $note=0;
            foreach ($rates as $rate){
                $note = $note+$rate->getRateNumber();
                $nombreNote++;
            }
            $rates = $note/$nombreNote;
            $rateListeTry->setMoyenneRate($rates);
            $entityManager->persist($rateListeTry);
            $entityManager->flush();
        }

        if($type=='acteur'){
            return $this->redirectToRoute('app_acteur_show', [
                "id_acteur" => $id,
            ]);
        }elseif ($type=='film') {
            return $this->redirectToRoute('app_film_show', [
                "type" => 'film',
                "id_film" => $id,
            ]);
        }else{
            return $this->redirectToRoute('app_film_show', [
                "type" => 'film',
                "id_film" => $id,
            ]);
        }
    }

    #[Route('/rate', name: 'rate_show')]
    public function show(Request $request, RateListeRepository $rateListeRepository)
    {
        $films = $rateListeRepository->findBy([],orderBy:["MoyenneRate" => "DESC"]);
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            return $this->redirectToRoute('app_search_show', ['recherche' => $form->getData()['recherche']]);
        }
        return $this->render('rate/show.html.twig',[
            'films' => $films,
            'form' => $form->createView(),
        ]);
    }
}
