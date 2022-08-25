<?php

namespace App\Http\Livewire;

use App\Models\Road;
use Livewire\Component;
use App\Models\Assignment;

class ComponentStatus extends Component
{
    public $user_id;

    public function mount()
    {
        $this->action = 'tickets';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->user_id = auth()->user()->id;
    }
    public function render()
    {
        $myAssignments = Assignment::where('user_id', $this->user_id)->where('status', 1)->get();

        $ticketsQuery = Road::query();
        foreach ($myAssignments as $assignment) {
            $ticketsQuery = $ticketsQuery->where('sent_to', $assignment->id);
        }
        $tickets = $ticketsQuery->where('status', Road::Active)->where('is_sent', 1)->where('is_delivered', 0);

        $receivedQuery = Road::query();
        foreach ($myAssignments as $assignment) {
            $receivedQuery = $receivedQuery->where('sent_to', $assignment->id);
        }
        $received = $receivedQuery->where('status', Road::Active)->where('is_delivered', 1);

        $pendingsQuery = Road::query();
        foreach ($myAssignments as $assignment) {
            $pendingsQuery = $pendingsQuery->where('sent_by', $assignment->id);
        }
        $pendings = $pendingsQuery->where('status', Road::Active)->where('is_sent', 0);

        $sentQuery = Road::query();
        foreach ($myAssignments as $assignment) {
            $sentQuery = $sentQuery->where('sent_by', $assignment->id);
        }
        $sent = $sentQuery->where('status', Road::Active)->where('is_sent', 1)->where('is_delivered', 0);

        return view('livewire.component-status', compact('tickets', 'received', 'pendings', 'sent'));
    }
}