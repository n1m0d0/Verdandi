<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Position;
use App\Models\Assignment;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentAssignment extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $action;
    public $iteration;
    public $search;

    public $user;
    public $user_id;
    public $user_name;
    public $position_id;
    public $file;
    public $assignment_id;

    public $deleteModal;
    public $concludeModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'position_id' => 'required',
        'file' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
    ];

    public function mount()
    {
        $this->action = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->concludeModal = false;
        $this->user_id = $this->user->id;
        $this->user_name = $this->user->name;
    }

    public function render()
    {
        $Query = Assignment::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $assignments = $Query->where('user_id', $this->user_id)->where('status', "!=", Assignment::Inactive)->orderBy('id', 'DESC')->paginate(7);
        $positions = Position::where('status', Position::Active)->get();
        return view('livewire.component-assignment', compact('positions', 'assignments'));
    }

    public function store()
    {
        $this->validate();

        $assignment = new Assignment();
        $assignment->position_id = $this->position_id;
        $assignment->user_id = $this->user_id;
        $assignment->file = $this->file->store('public');
        $assignment->save();

        $position = Position::find($this->position_id);
        $position->status = Position::Occupied;
        $position->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->assignment_id = $id;
        $assignment = Assignment::find($id);
        $this->position_id = $assignment->position_id;

        $this->action = "edit";
    }

    public function update()
    {
        $assignment = Assignment::find($this->assignment_id);

        if ($this->file != null) {
            $this->validate();

            Storage::delete($assignment->image);
            $assignment->position_id = $this->position_id;
            $assignment->user_id = $this->user_id;
            $assignment->file = $this->file->store('public');
            $assignment->save();
        } else {
            $this->validate([
                'position_id' => 'required',
            ]);

            $assignment->position_id = $this->position_id;
            $assignment->user_id = $this->user_id;
            $assignment->save();
        }

        $this->action = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->assignment_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $assignment = Assignment::find($this->assignment_id);
        $assignment->status = Assignment::Inactive;
        $assignment->save();

        $position = Position::find($assignment->position_id);
        $position->status = Position::Active;
        $position->save();

        $this->clear();
        $this->deleteModal = false;
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function modalConclude($id)
    {
        $this->assignment_id = $id;
        $this->concludeModal = true;
    }

    public function conclude()
    {
        $assignment = Assignment::find($this->assignment_id);
        $assignment->status = Assignment::Conclude;
        $assignment->save();

        $position = Position::find($assignment->position_id);
        $position->status = Position::Active;
        $position->save();

        $this->clear();
        $this->concludeModal = false;
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function downloadFile($id)
    {
        $assignment = Assignment::find($id);
        return Storage::download($assignment->file);
    }

    public function clear()
    {
        $this->reset(['position_id','assignment_id', 'file']);
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