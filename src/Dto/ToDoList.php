<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ToDoList
{
    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    public string $name;

    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: 'string')
    ])]
    public array $items;
}
