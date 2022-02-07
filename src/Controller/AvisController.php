<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/avis/new/{type<acteur|film|serie>}/{id}', name: 'app_avis_new')]
    #[IsGranted("ROLE_USER")]
    public function new($id,$type,Request $request, EntityManagerInterface $entityManager)
    {
        $avis = new Avis();
        $avis->setIdUser($this->getUser());
        $avis->setIdSorage($id);
        $avis->setDateAvis(new \DateTime('now'));
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid()){
            $entityManager->persist($avis);
            $entityManager->flush();
            if ($request->query->get('type') == 'acteur'){

                return $this->redirectToRoute('app_acteur_show', ['id_acteur' => $avis->getIdSorage()]);

            }else{
                return $this->redirectToRoute('app_film_show', ["type"=>$type,'id_film' => $avis->getIdSorage()]);
            }
        }
        return $this->render('avis/new.html.twig',[

            'form' => $form->createView(),
        ]);
    }
}
