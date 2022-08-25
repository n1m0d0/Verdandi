<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentEntity extends Component
{
    use WithPagination;
    use WireToast;

    public $action;
    public $iteration;
    public $search;

    public $parent_id;
    public $name;
    public $abbreviation;
    public $entity_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'abbreviation' => 'required|max:200'
    ];

    public function mount()
    {
        $this->action = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }

    public function render()
    {
        $Query = Entity::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $entities = $Query->where('status', Entity::Active)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-entity', compact('entities'));
    }

    public function store()
    {
        $this->validate();

        $entity = new Entity();
        if ($this->parent_id == "null") {
            $entity->parent_id = null;
        } else {
            $entity->parent_id = $this->parent_id;
        }
        $entity->name = $this->name;
        $entity->abbreviation = $this->abbreviation;
        $entity->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->entity_id = $id;
        $entity = Entity::find($id);        
        $this->parent_id = $entity->parent_id;
        $this->name = $entity->name;
        $this->abbreviation = $entity->abbreviation;

        $this->action = "edit";
    }

    public function update()
    {
        $entity = Entity::find($this->entity_id);

        $this->validate();
        
        if ($this->parent_id == "null") {
            $entity->parent_id = null;
        } else {
            $entity->parent_id = $this->parent_id;
        }
        $entity->name = $this->name;
        $entity->abbreviation = $this->abbreviation;
        $entity->save();

        $this->action = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->entity_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $entity = Entity::find($this->entity_id);
        $entity->parent_id = null;
        $entity->status = Entity::Inactive;
        $entity->save();

        $entities = Entity::where('parent_id', $this->entity_id)->get();
        foreach ($entities as $entity)
        {
            $entity->parent_id = null;
            $entity->save();
        }

        $this->clear();
        $this->deleteModal = false;
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['parent_id','name', 'abbreviation', 'entity_id']);
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