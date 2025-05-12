<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $searchName = '';
    public $searchEmail = '';
    public $searchRole = '';
    public $searchStatus = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $selectedRows = [];
    public $selectAll = false;

    // For user editing/creation
    public $userId = null;
    public $name = '';
    public $email = '';
    public $role = '';
    public $status = 'active';
    public $password = '';
    public $password_confirmation = '';
    public $isEditMode = false;
    // protected $listeners = ['deleteUser'];

    protected $queryString = [
        'searchName' => ['except' => ''],
        'searchEmail' => ['except' => ''],
        'searchRole' => ['except' => ''],
        'searchStatus' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    protected $listeners = ['deleteConfirmed' => 'deleteUser'];

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'role' => 'required',
        'status' => 'required',
        'password' => 'sometimes|min:8|confirmed',
    ];

    public function updatingSearchName()
    {
        $this->resetPage();
    }

    public function updatingSearchEmail()
    {
        $this->resetPage();
    }

    public function updatingSearchRole()
    {
        $this->resetPage();
    }

    public function updatingSearchStatus()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $users = User::query()
            ->when($this->searchName, function ($query) {
                return $query->where('name', 'like', '%' . $this->searchName . '%');
            })
            ->when($this->searchEmail, function ($query) {
                return $query->where('email', 'like', '%' . $this->searchEmail . '%');
            })
            ->when($this->searchRole, function ($query) {
                return $query->where('role', $this->searchRole);
            })
            ->when($this->searchStatus, function ($query) {
                return $query->where('status', $this->searchStatus);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // Get distinct roles for the filter dropdown
        $roles = User::distinct()->pluck('role')->filter();
        
        return view('livewire.users', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['searchName', 'searchEmail', 'searchRole', 'searchStatus']);
        $this->resetPage();
    }

    public function confirmUserDeletion($userId)
    {
        $this->dispatch('show-delete-confirmation', ['userId' => $userId]);
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            $user->delete();
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'User deleted successfully!'
            ]);
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedRows)) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'No users selected for deletion!'
            ]);
            return;
        }

        $this->dispatch('show-delete-selected-confirmation');
    }

    public function deleteSelectedConfirmed()
    {
        User::whereIn('id', $this->selectedRows)->delete();
        
        $this->selectedRows = [];
        $this->selectAll = false;
        
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Selected users deleted successfully!'
        ]);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = User::query()
                ->when($this->searchName, function ($query) {
                    return $query->where('name', 'like', '%' . $this->searchName . '%');
                })
                ->when($this->searchEmail, function ($query) {
                    return $query->where('email', 'like', '%' . $this->searchEmail . '%');
                })
                ->when($this->searchRole, function ($query) {
                    return $query->where('role', $this->searchRole);
                })
                ->when($this->searchStatus, function ($query) {
                    return $query->where('status', $this->searchStatus);
                })
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function createUser()
    {
        $this->resetValidation();
        $this->resetUserForm();
        $this->isEditMode = false;
        $this->dispatch('show-form');
    }

    public function editUser($userId)
    {
        $this->resetValidation();
        $this->isEditMode = true;
        $this->userId = $userId;
        
        $user = User::find($userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->status = $user->status;
        
        $this->dispatch('show-form');
    }

    public function saveUser()
    {
        if ($this->isEditMode) {
            $this->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,' . $this->userId,
                'role' => 'required',
                'status' => 'required',
                'password' => 'nullable|min:8|confirmed',
            ]);
        } else {
            $this->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'status' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);
        }

        if ($this->isEditMode) {
            $user = User::find($this->userId);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->role = $this->role;
            $user->status = $this->status;
            
            if ($this->password) {
                $user->password = bcrypt($this->password);
            }
            
            $user->save();
            
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'User updated successfully!'
            ]);
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'status' => $this->status,
                'password' => bcrypt($this->password),
            ]);
            
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'User created successfully!'
            ]);
        }

        $this->dispatch('hide-form');
        $this->resetUserForm();
    }

    public function resetUserForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->status = 'active';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function cancelForm()
    {
        $this->dispatch('hide-form');
        $this->resetUserForm();
    }
    // public function render()
    // {
    //     return view('livewire.user');
    // }
}
