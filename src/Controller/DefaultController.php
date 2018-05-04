<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/users", name="list_users")
     * @param UserRepository $repository
     * @return Response
     */
    public function listUsers(UserRepository $repository): Response
    {
        return $this->render('users/list.html.twig', [
            'users' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="create_user")
     * @param Request $request
     * @return Response
     */
    public function addUser(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('list_users');
        }

        return $this->render('users/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_user")
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('list_users');
        }

        return $this->render('users/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/success", name="user_created_success")
     */
    public function success()
    {
        return $this->render('users/success.html.twig');
    }
}
