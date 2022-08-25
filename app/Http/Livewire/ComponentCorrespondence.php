<?php

namespace App\Http\Livewire;

use App\Models\Road;
use App\Models\Roadmap;
use Livewire\Component;
use App\Models\Document;
use App\Models\Assignment;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentCorrespondence extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $action;
    public $iteration;
    public $search;

    public $user_id;
    public $road_id;
    public $acceptModal;
    public $sendModal;
    public $writeModal;
    public $uploadModal;
    public $responseModal;

    public $sent_by;
    public $sent_to;
    public $document_id;
    public $reference;
    public $file;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->action = 'tickets';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->user_id = auth()->user()->id;
        $this->user_name = auth()->user()->name;
        $this->acceptModal = false;
        $this->sendModal = false;
        $this->writeModal = false;
        $this->uploadModal = false;
        $this->responseModal = false;
    }

    public function render()
    {
        $documents = Document::where('status', 1)->get();
        $myAssignments = Assignment::where('user_id', $this->user_id)->where('status', 1)->get();
        $assignments = Assignment::where('user_id', "!=", $this->user_id)->where('status', 1)->get();
        $roadsQuery = Road::query();

        if ($this->search != null) {
            $this->updatingSearch();
            $roadsQuery = $roadsQuery->whereHas('roadmap', function ($query) {
                $query->where('id', 'LIKE', "%$this->search%");
            });
        }

        if ($this->action == "tickets") {
            foreach ($myAssignments as $assignment) {
                $roadsQuery = $roadsQuery->where('sent_to', $assignment->id);
            }
            $roadsQuery = $roadsQuery->where('status', Road::Active)->where('is_sent', 1)->where('is_delivered', 0);
        }

        if ($this->action == "received") {
            foreach ($myAssignments as $assignment) {
                $roadsQuery = $roadsQuery->where('sent_to', $assignment->id);
            }
            $roadsQuery = $roadsQuery->where('status', Road::Active)->where('is_delivered', 1);
        }

        if ($this->action == "pendings") {
            foreach ($myAssignments as $assignment) {
                $roadsQuery = $roadsQuery->where('sent_by', $assignment->id);
            }
            $roadsQuery = $roadsQuery->where('status', Road::Active)->where('is_sent', 0);
        }

        if ($this->action == "sent") {
            foreach ($myAssignments as $assignment) {
                $roadsQuery = $roadsQuery->where('sent_by', $assignment->id);
            }
            $roadsQuery = $roadsQuery->where('status', Road::Active)->where('is_sent', 1)->where('is_delivered', 0);
        }

        $roads = $roadsQuery->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-correspondence', compact('roads', 'myAssignments', 'assignments', 'documents'));
    }

    public function tickets()
    {
        $this->action = "tickets";

        $this->resetSearch();
    }

    public function received()
    {
        $this->action = "received";

        $this->resetSearch();
    }

    public function pendings()
    {
        $this->action = "pendings";

        $this->resetSearch();
    }

    public function sent()
    {
        $this->action = "sent";

        $this->resetSearch();
    }

    public function modalAccept($id)
    {
        $this->road_id = $id;
        $this->acceptModal = true;
    }

    public function acceptRoad()
    {
        $road = Road::find($this->road_id);
        $road->is_delivered = 1;
        $road->delivered_on = now();
        $road->save();

        $this->acceptModal = false;
        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function modalSend($id)
    {
        $this->road_id = $id;
        $this->sendModal = true;
    }

    public function sendRoad()
    {
        $road = Road::find($this->road_id);

        if ($road->file != null) {
            $road->is_sent = 1;
            $road->sent_on = now();
            $road->save();

            $this->sendModal = false;
            $this->clear();

            toast()
                ->success('Se guardo correctamente')
                ->push();
        } else {
            $this->sendModal = false;
            $this->clear();

            toast()
                ->warning('Debe adjuntar el archivo')
                ->push();
        }
    }

    public function downloadFile($id)
    {
        $road = Road::find($id);
        return Storage::download($road->file);
    }

    public function writeRoad()
    {
        $this->validate([
            'sent_by' => 'required',
            'sent_to' => 'required',
            'document_id' => 'required',
            'reference' => 'required|max:200'
        ]);

        $roadmap = new Roadmap();
        $roadmap->code = Str::uuid()->toString();
        $roadmap->user_id = $this->user_id;
        $roadmap->save();

        $road = new Road();
        $road->roadmap_id = $roadmap->id;
        $road->sent_by = $this->sent_by;
        $road->sent_to = $this->sent_to;
        $road->document_id = $this->document_id;
        $road->reference = $this->reference;
        $road->save();

        $this->writeModal = false;
        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function closeWrite()
    {
        $this->writeModal = false;
        $this->clear();
    }

    public function modalUpload($id)
    {
        $this->clear();
        $this->road_id = $id;
        $this->uploadModal = true;
    }

    public function uploadRoad()
    {
        $this->validate([
            'file' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
        ]);

        $road = Road::find($this->road_id);
        $road->file = $this->file->store('public');
        $road->save();

        $this->uploadModal = false;
        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function modalResponse($id)
    {
        $this->clear();
        $this->road_id = $id;
        $this->responseModal = true;
    }

    public function responseRoad()
    {
        $this->validate([
            'sent_by' => 'required',
            'sent_to' => 'required',
            'document_id' => 'required',
            'reference' => 'required|max:200'
        ]);

        $road = Road::find($this->road_id);
        $road->status = Road::Conclude;
        $road->save();
        $roadmap = $road->roadmap;

        $road = new Road();
        $road->parent_id = $this->road_id;
        $road->roadmap_id = $roadmap->id;
        $road->sent_by = $this->sent_by;
        $road->sent_to = $this->sent_to;
        $road->document_id = $this->document_id;
        $road->reference = $this->reference;
        $road->save();

        $this->responseModal = false;
        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['road_id', 'file', 'sent_by', 'sent_to', 'document_id', 'reference']);
        $this->iteration++;
        $this->resetSearch();
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