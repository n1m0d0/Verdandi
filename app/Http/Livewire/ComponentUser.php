<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentUser extends Component
{
    use WithPagination;
    use WireToast;

    public $action;
    public $iteration;
    public $search;

    public $name;
    public $email;
    public $password;
    public $user_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'email' => 'required|unique:users|max:100',
        'password' => 'required|min:8|max:100'
    ];

    public function mount()
    {
        $this->action = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }

    public function render()
    {
        $Query = User::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $users = $Query->where('status', User::Active)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-user', compact('users'));
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        $user->assignRole('user');

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->user_id = $id;
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;

        $this->action = "edit";
    }

    public function update()
    {
        $user = User::find($this->user_id);

        if ($this->password != null) {
            $this->validate([
                'name' => 'required|max:200',
                'email' => ['required', 'max:100', Rule::unique('users')->ignore($this->user_id)],
                'password' => 'required|min:8|max:100'
            ]);

            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = bcrypt($this->password);
            $user->save();
        } else {
            $this->validate([
                'name' => 'required|max:200',
                'email' => ['required', 'max:100', Rule::unique('users')->ignore($this->user_id)]
            ]);

            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();
        }

        $this->action = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->user_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $user = User::find($this->user_id);
        $user->status = User::Inactive;
        $user->save();

        $this->clear();
        $this->deleteModal = false;
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'email', 'password', 'user_id']);
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