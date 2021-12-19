<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->userRepository = $objectManager->getRepository(User::class);
    }

    // CREATE
    #[Route('/users/create', name: 'create_user')]
    public function createUser(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->userRepository->save($user);

            return $this->redirectToRoute('missions_list');
        }

        return $this->renderForm('user/create.html.twig', ['form' => $form]);
    }

    // INDEX
    #[Route('/users', name: 'users_list')]
    public function userList(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users
        ]);
    }

    // DELETE
    #[Route('/user/{id}/delete', name: 'delete_user')]
    public function deleteUser(int $id): Response
    {
        $user = $this->userRepository->find($id);

        if(!$user instanceof User) {
            throw new NotFoundHttpException();
        }

        $this->userRepository->delete($user);

        return $this->redirectToRoute('users_list');

    }
}
