<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entity = new Entity();
        $entity->name = "despacho ministerial";
        $entity->abbreviation = "dp";
        $entity->save();


        $entity = new Entity();
        $entity->parent_id = 1;
        $entity->name = "dirección de tecnologías de información";
        $entity->abbreviation = "dti";
        $entity->save();

        $entity = new Entity();
        $entity->parent_id = 1;
        $entity->name = "dirección de recursos humanos";
        $entity->abbreviation = "drh";
        $entity->save();
    }
}
