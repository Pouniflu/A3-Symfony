<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{

    /** @var MissionRepository */
    private $missionRepository;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->missionRepository = $objectManager->getRepository(Mission::class);
    }

    // CREATE
    #[Route('/missions/create', name: 'create_mission')]
    public function createMission(Request $request): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();
            $this->missionRepository->save($mission);

            return $this->redirectToRoute('missions_list');
        }

        return $this->renderForm('mission/create.html.twig', ['form' => $form]);
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

    // DETAIL
    #[Route('/missions/{id}', name: 'mission_details')]
    public function missionDetails(int $id): Response
    {
        $mission = $this->missionRepository->find($id);

        return $this->render('mission/details.html.twig', [
            'controller_name' => 'MissionController',
            'mission' => $mission
        ]);
    }

    // EDIT
    #[Route('/missions/{id}/edit', name: 'mission_edit')]
    public function editMission(int $id, Request $request): Response
    {
        $mission = $this->missionRepository->find($id);

        if(null === $mission) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();
            $this->missionRepository->save($mission);

            return $this->redirectToRoute('missions_list');
        }

        return $this->renderForm('mission/create.html.twig', [
            'form' => $form
        ]);
    }

    // DELETE
    #[Route('/missions/{id}/delete', name: 'delete_mission')]
    public function deleteMission(int $id): Response
    {
        $mission = $this->missionRepository->find($id);

        if (!$mission instanceof Mission) {
            throw new NotFoundHttpException();
        }

        $this->missionRepository->delete($mission);

        return $this->redirectToRoute('missions_list');

    }
}
