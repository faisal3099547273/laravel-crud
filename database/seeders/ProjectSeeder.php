<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Project::create([
            'name' => 'Ecommerce',
            'user_id' => 2,
            'description' => 'Test',
        ]);

        Project::create([
            'name' => 'Accounting',
            'user_id' => 3,
            'description' => 'Test',
        ]);


        Project::create([
            'name' => 'Eventory',
            'user_id' => 4,
            'description' => 'Test',
        ]);

        Project::create([
            'name' => 'PlayStore',
            'user_id' => 5,
            'description' => 'Test',
        ]);
    }
}
