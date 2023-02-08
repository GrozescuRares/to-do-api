<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\ToDoList;

class ToDoListFileRepository
{
    private const FILE_PATH = __DIR__ .'/../../var/todo_list.json';

    public function save(ToDoList $toDoList): void
    {
        $file = fopen(self::FILE_PATH, 'w');
        fwrite($file, json_encode($toDoList));
        fclose($file);
    }

    public function get(): ToDoList
    {
        $toDoListData = json_decode(file_get_contents(self::FILE_PATH), true);

        $toDoList = new ToDoList();
        $toDoList->items = $toDoListData['items'];

        return $toDoList;
    }
}
