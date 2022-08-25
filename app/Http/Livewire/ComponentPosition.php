<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Position;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentPosition extends Component
{
    use WithPagination;
    use WireToast;
    use WithFileUploads;

    public $action;
    public $iteration;
    public $search;

    public $entity;
    public $entity_id;
    public $entity_name;
    public $name;
    public $position_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200'
    ];

    public function mount()
    {
        $this->action = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->entity_id = $this->entity->id;
        $this->entity_name = $this->entity->name;
    }

    public function render()
    {
        $Query = Position::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $positions = $Query->where('status', Position::Active)->where('entity_id', $this->entity_id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-position', compact('positions'));
    }

    public function store()
    {
        $this->validate();

        $position = new Position();
        $position->entity_id = $this->entity_id;
        $position->name = $this->name;
        $position->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->position_id = $id;
        $position = Position::find($id);        
        $this->name = $position->name;

        $this->action = "edit";
    }

    public function update()
    {
        $position = Position::find($this->position_id);

        $this->validate();

        $position->name = $this->name;
        $position->save();

        $this->action = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->position_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $position = Position::find($this->position_id);
        $position->status = Position::Inactive;
        $position->save();

        $this->clear();
        $this->deleteModal = false;
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'position_id']);
        $this->iteration++;
        $this->action = "create";   
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->updatingSearch();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}