<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }






/*
    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    //  public function edit(Request $request, User $user, UserRepository $userRepository): Response
    //   {
    //     $form = $this->createForm(UserType::class, $user);
    //    $form->handleRequest($request);

    //    if ($form->isSubmitted() && $form->isValid()) {
    //       $userRepository->add($user, true);

    //        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    //    }

    //   return $this->renderForm('user/edit.html.twig', [
    //       'user' => $user,
    //        'form' => $form,
    //    ]);
//   }

    /**
     * @Route("/{id}/edit", name="app_user_edit",methods={"GET", "POST"})
     */
    public function editProfile(Request $request,User $user)
    {   $notification=null;
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();



            $this->addFlash('message', 'Profil mis à jour');
            $notification="Profil mis à jour";

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'notification'=>$notification
        ]);
    }
    /**
     * @Route("/users/pass/modifier", name="users_pass_modifier")
     */
    public function editPass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // On vérifie si les 2 mots de passe sont identiques
            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');

                return $this->redirectToRoute('app_user_index');

            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }

        return $this->render('user/editpass.html.twig');
    }





 //   /**
  //     * @Route("/{id}/delete", name="app_user_delete")
  //   */
  //    public function delete( User $user): Response
  //   {
   // $em=$this->getDoctrine()->getManager();
  //  $em->remove($user);
 //   $em->flush();
 //   return $this->redirectToRoute('app_home');
    //    }


 // /**
 //   * @Route("/{id}", name="app_user_delete", methods={"POST"})
  //   */
 //   public function delete(Request $request, User $user, UserRepository $userRepository): Response
  //  {
       // if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
         //  $userRepository->remove($user, true);
   //    }

     //  return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
  // }



}
