<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use App\Models\Roadmap;
use App\Models\User;
use Livewire\Component;

class ComponentInformation extends Component
{
    public function render()
    {
        $users = User::all();
        $entities = Entity::all();
        $roadmaps = Roadmap::all();
        return view('livewire.component-information', compact('users', 'entities', 'roadmaps'));
    }
}