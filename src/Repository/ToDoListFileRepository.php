<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\ToDoList;
use App\Dto\ToDoListUpdate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function getByName(string $name): ToDoList
    {
        $contents = json_decode(file_get_contents(self::FILE_PATH), true);
        foreach ($contents as $toDoListData) {
            if ($toDoListData['name'] === $name) {
                return $this->convertToDoListDataToDto($toDoListData);
            }
        }

        throw new NotFoundHttpException();
    }

    public function getAll(): array
    {
        $contents = json_decode(file_get_contents(self::FILE_PATH), true);

        return array_map(fn (array $toDoListData) => $this->convertToDoListDataToDto($toDoListData), $contents);
    }

    public function update(string $name, ToDoListUpdate $toDoListUpdate): void
    {
        $toUpdate = false;
        $contents = json_decode(file_get_contents(self::FILE_PATH), true);

        foreach ($contents as &$toDoListData) {
            if ($toDoListData['name'] !== $name) {
                continue;
            }

            if (!empty($toDoListUpdate->name)) {
                $toDoListData['name'] = $toDoListUpdate->name;
            }

            if (!empty($toDoListUpdate->items)) {
                $toDoListData['items'] = $toDoListUpdate->items;
            }

            $toUpdate = true;
            break;
        }

        if (false === $toUpdate) {
            throw new NotFoundHttpException();
        }

        $file = fopen(self::FILE_PATH, 'w');
        fwrite($file, json_encode($contents));
        fclose($file);
    }

    private function convertToDoListDataToDto(array $toDoListData): ToDoList
    {
        $toDoList = new ToDoList();
        $toDoList->name = $toDoListData['name'];
        $toDoList->items = $toDoListData['items'];

        return $toDoList;
    }
}
