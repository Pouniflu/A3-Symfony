<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    /** @var MissionRepository */
    private $missionRepository;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->missionRepository = $objectManager->getRepository(Mission::class);
    }

    // INDEX
    #[Route('/missions', name: 'missions_list')]
    public function missionsList(): Response
    {
        $missions = $this->missionRepository->findAll();

        return $this->render('mission/index.html.twig', [
            'controller_name' => 'MissionController',
            'missions' => $missions
        ]);
    }

    // INDEX
    #[Route('/missions/{id}', name: 'mission_details')]
    public function missionDetails(int $id): Response
    {
        $mission = $this->missionRepository->find($id);

        return $this->render('mission/details.html.twig', [
            'controller_name' => 'MissionController',
            'mission' => $mission
        ]);
    }
}
