<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ToDoListUpdate
{
    #[Assert\Type(type: 'string')]
    public $name;

    #[Assert\All([new Assert\Type(type: 'string')])]
    public $items;
}
