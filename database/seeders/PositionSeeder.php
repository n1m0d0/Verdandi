<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = new Position();
        $position->entity_id = 1;
        $position->name = "Ministro de planificacion para el desarrollo";
        $position->save();

        $position = new Position();
        $position->entity_id = 2;
        $position->name = "Director de tecnologías de información";
        $position->save();

        $position = new Position();
        $position->entity_id = 3;
        $position->name = "Director de recursos humanos";
        $position->save();
    }
}
