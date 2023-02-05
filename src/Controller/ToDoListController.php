<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ToDoList;
use App\Dto\ToDoListUpdate;
use App\Repository\ToDoListFileRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ToDoListController extends BaseController
{
    #[Route(path: '/todo-list', methods: ['POST'])]
    public function create(
        Request $request,
        ToDoListFileRepository $fileRepository,
        ValidatorInterface $validator,
    ): Response {
        $toDoList = $this->convertRequestToDto($request, ToDoList::class);

        $violations = $validator->validate($toDoList);
        if ($violations->count() > 0) {
            return $this->json($violations, Response::HTTP_BAD_REQUEST);
        }

        $fileRepository->save($toDoList);

        return new Response(status: Response::HTTP_CREATED);
    }

    #[Route(path: '/todo-list/{name}', methods: ['GET'])]
    public function get(string $name, ToDoListFileRepository $fileRepository): JsonResponse
    {
        $toDoList = $fileRepository->getByName($name);

        return new JsonResponse($toDoList);
    }

    #[Route(path: '/todo-list', methods: ['GET'])]
    public function getAll(ToDoListFileRepository $fileRepository): JsonResponse
    {
        $toDoLists = $fileRepository->getAll();

        return new JsonResponse($toDoLists);
    }

    #[Route(path: '/todo-list/{name}', methods: ['PATCH'])]
    public function update(
        string $name,
        Request $request,
        ValidatorInterface $validator,
        ToDoListFileRepository $fileRepository,
    ): Response {
        $toDoListUpdate = $this->convertRequestToDto($request, ToDoListUpdate::class);

        $violations = $validator->validate($toDoListUpdate);
        if ($violations->count() > 0) {
            return $this->json($violations, Response::HTTP_BAD_REQUEST);
        }

        $fileRepository->update($name, $toDoListUpdate);

        return new Response();
    }
}
