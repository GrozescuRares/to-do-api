<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    protected function convertRequestToDto(Request $request, string $dtoClass)
    {
        $dto = new $dtoClass();

        $requestBody = json_decode($request->getContent(), true);
        foreach ($dto as $property => $value) {
            $dto->$property = $requestBody[$property] ?? null;
        }

        return $dto;
    }
}
