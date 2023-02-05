<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\ToDoList;

class ToDoListFileRepository
{
    private const FILE_PATH = '/var/www/app/var/to_do_list.txt';
    private const LINE_SEPARATOR = "\n";

    public function save(ToDoList $toDoList): void
    {
        $file = fopen(self::FILE_PATH, 'w');

        fwrite($file, $toDoList->name . self::LINE_SEPARATOR);
        foreach ($toDoList->items as $item) {
            fwrite($file, $item . self::LINE_SEPARATOR);
        }

        fclose($file);
    }
}
