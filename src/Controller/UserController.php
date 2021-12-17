<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->userRepository = $objectManager->getRepository(User::class);
    }

    #[Route('/users', name: 'users_list')]
    public function userList(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users
        ]);
    }

}
