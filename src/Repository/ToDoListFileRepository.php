<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\ToDoList;

class ToDoListFileRepository
{
    private const FILE_PATH = __DIR__ .'/../../var/todo_list.json';
}
