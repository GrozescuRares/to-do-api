<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\ToDoList;

class ToDoListFileRepository
{
    private const FILE_PATH = '/var/www/app/var/todo_lists.json';

    public function save(ToDoList $toDoList): void
    {
        $contents = json_decode(file_get_contents(self::FILE_PATH), true);
        $contents[] = $toDoList;

        $file = fopen(self::FILE_PATH, 'w');
        fwrite($file, json_encode($contents));
        fclose($file);
    }
}
