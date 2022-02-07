<?php

namespace App\Controller;



use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\FavActeursRepository;
use App\Repository\FavFilmRepository;
use App\Security\AppUserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class UserController extends AbstractController
{
    #[Route("/register", name: "app_register")]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher,UserAuthenticatorInterface $authenticator, AppUserAuthenticator $appUserAuthenticator)
    {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $user->getPassword();
            $password = $hasher->hashPassword($user,$password);
            $user->setPassword($password);
            $user->setRoles(["ROLE_USER"]);
            $user->setImgProfil('https://cdn.pixabay.com/photo/2017/02/23/13/05/profile-2092113_960_720.png');
            $entityManager->persist($user);
            $entityManager->flush();

            return $authenticator->authenticateUser(
                $user,
                $appUserAuthenticator,
                $request);
        }

        return $this->render('user/register.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    //------------------------------------------------------------------------------------------------------------------
    //---------  Profile  ----------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    #[Route("/profile", name: "app_profile")]
    public function profile(EntityManagerInterface $entityManager, FavActeursRepository $favActeursRepository, FavFilmRepository $favFilmRepository)
    {
        $films = $favFilmRepository->findBy(['UserId' => $this->getUser()]);
        $acteurs = $favActeursRepository->findBy(['UserId' => $this->getUser()]);
        return $this->render('user/userprofile.html.twig',[
            "films"=>$films,
            "acteurs"=>$acteurs,
        ]);
    }

    //------------------------------------------------------------------------------------------------------------------
    //---------  Edit  -------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    #[Route("/profile/edit", name: "app_profile_edit")]
    public function edit(Request $request, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->flush();
            return $this->redirectToRoute('app_profile');

        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
}
}
