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

    public function getByName(string $name): ?ToDoList
    {
        $contents = json_decode(file_get_contents(self::FILE_PATH), true);
        foreach ($contents as $toDoListData) {
            if ($toDoListData['name'] === $name) {
                $toDoList = new ToDoList();
                $toDoList->name = $toDoListData['name'];
                $toDoList->items = $toDoListData['items'];

                return $toDoList;
            }
        }

        return null;
    }

    public function getAll(): array
    {
        $contents = json_decode(file_get_contents(self::FILE_PATH), true);

        return array_map(function (array $toDoListData) {
            $toDoList = new ToDoList();
            $toDoList->name = $toDoListData['name'];
            $toDoList->items = $toDoListData['items'];

            return $toDoList;
        }, $contents);
    }
}
