<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusTableSeeder extends Seeder
{
    public function run()
    {
        $taskStatuses = [
            [
                'id'   => 1,
                'name' => 'Piano',
            ],
            [
                'id'   => 2,
                'name' => 'Violín',
            ],
            [
                'id'   => 3,
                'name' => 'Dibujo',
            ],
        ];

        TaskStatus::insert($taskStatuses);
    }
}
