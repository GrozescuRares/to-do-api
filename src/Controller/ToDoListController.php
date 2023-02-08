<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ToDoList;
use App\Repository\ToDoListFileRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ToDoListController extends BaseController
{
    #[Route(path: '/todo-list', methods: ['POST'])]
    public function save(Request $request, ToDoListFileRepository $fileRepository, ValidatorInterface $validator): Response
    {
        $toDoList = $this->convertRequestToDto($request, ToDoList::class);

        $violations = $validator->validate($toDoList);
        if ($violations->count() > 0) {
            return $this->json($violations, Response::HTTP_BAD_REQUEST);
        }

        $fileRepository->save($toDoList);

        return new Response();
    }

    #[Route(path: '/todo-list', methods: ['GET'])]
    public function get(ToDoListFileRepository $fileRepository): JsonResponse
    {
        return new JsonResponse($fileRepository->get());
    }
}
