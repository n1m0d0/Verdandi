<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentDocument extends Component
{
    use WithPagination;
    use WireToast;

    public $action;
    public $iteration;
    public $search;

    public $name;
    public $abbreviation;
    public $document_id;

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
        $Query = Document::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $documents = $Query->where('status', Document::Active)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-document', compact('documents'));
    }

    public function store()
    {
        $this->validate();

        $document = new Document();
        $document->name = $this->name;
        $document->abbreviation = $this->abbreviation;
        $document->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->document_id = $id;
        $document = Document::find($id);
        $this->name = $document->name;
        $this->abbreviation = $document->abbreviation;

        $this->action = "edit";
    }

    public function update()
    {
        $document = Document::find($this->document_id);

        $this->validate();

        $document->name = $this->name;
        $document->abbreviation = $this->abbreviation;
        $document->save();

        $this->action = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->document_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $form = Document::find($this->document_id);
        $form->status = Document::Inactive;
        $form->save();

        $this->clear();
        $this->deleteModal = false;
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'abbreviation', 'document_id']);
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