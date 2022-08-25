<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $document = new Document();
        $document->name = "nota interna";
        $document->abbreviation = "ni";
        $document->save();

        $document = new Document();
        $document->name = "nota externa";
        $document->abbreviation = "ne";
        $document->save();

        $document = new Document();
        $document->name = "informe";
        $document->abbreviation = "inf";
        $document->save();

        $document = new Document();
        $document->name = "memorándum";
        $document->abbreviation = "memo";
        $document->save();
    }
}
