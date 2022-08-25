<?php

namespace App\Http\Livewire;

use App\Models\Road;
use App\Models\Roadmap;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentSearchRoadmap extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $search;
    public $list;
    public $timeline;

    public $roadmap_id;
    public $roadmap;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->action = 'create';
        $this->iteration = rand(0, 999);
        $this->list = false;
        $this->timeline = false;
    }

    public function render()
    {
        $roadmapsQuery = Roadmap::query();

        if ($this->search != null) {
            $this->list = true;
            $this->timeline = false;
            $roadmapsQuery = $roadmapsQuery->where('id', 'LIKE', "%$this->search%");
        } else {
            $this->resetSearch();
        }

        $roadmaps = $roadmapsQuery->orderBy('id', 'DESC')->get();
        return view('livewire.component-search-roadmap', compact('roadmaps'));
    }

    public function record($id)
    {
        $this->roadmap_id = $id;
        $this->timeline = true;

        $this->roadmap = Roadmap::find($id);

        $this->resetSearch();
    }

    public function downloadFile($id)
    {
        $road = Road::find($id);
        return Storage::download($road->file);
    }

    public function resetSearch()
    {
        $this->list = false;
        $this->reset(['search']);
    }
}