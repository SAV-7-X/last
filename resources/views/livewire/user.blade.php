<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Users Management</h6>
                        <button wire:click="createUser" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add User
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <!-- Search Filters -->
                        <div class="px-4 py-3">
                            <div class="search-filters">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input wire:model.debounce.500ms="searchName" type="text" class="form-control" placeholder="Search by name...">
                                </div>
                                
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input wire:model.debounce.500ms="searchEmail" type="text" class="form-control" placeholder="Search by email...">
                                </div>
                                
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <select wire:model="searchRole" class="form-select">
                                        <option value="">All Roles</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select wire:model="searchStatus" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                    <select wire:model="perPage" class="form-select">
                                        <option value="10">10 per page</option>
                                        <option value="25">25 per page</option>
                                        <option value="50">50 per page</option>
                                        <option value="100">100 per page</option>
                                    </select>
                                </div>
                                
                                <button wire:click="resetFilters" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                                
                                <button wire:click="deleteSelected" class="btn btn-danger" @if(empty($selectedRows)) disabled @endif>
                                    <i class="fas fa-trash"></i> Delete Selected
                                </button>
                            </div>
                        </div>
                        
                        <!-- Users Table -->
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="px-2 text-secondary opacity-7">
                                            <div class="form-check">
                                                <input wire:model="selectAll" class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a href="#" wire:click.prevent="sortBy('name')" class="text-secondary">
                                                User 
                                                @if($sortField === 'name')
                                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            <a href="#" wire:click.prevent="sortBy('role')" class="text-secondary">
                                                Role 
                                                @if($sortField === 'role')
                                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a href="#" wire:click.prevent="sortBy('status')" class="text-secondary">
                                                Status 
                                                @if($sortField === 'status')
                                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a href="#" wire:click.prevent="sortBy('created_at')" class="text-secondary">
                                                Created At
                                                @if($sortField === 'created_at')
                                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="text-secondary opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td class="px-2">
                                                <div class="form-check">
                                                    <input wire:model="selectedRows" value="{{ $user->id }}" class="form-check-input" type="checkbox">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if($user->profile_photo_path)
                                                            <img src="{{ Storage::url($user->profile_photo_path) }}" class="avatar me-3" alt="{{ $user->name }}">
                                                        @else
                                                            <div class="avatar me-3 bg-secondary text-white d-flex align-items-center justify-content-center">
                                                                {{ substr($user->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ ucfirst($user->role) }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge bg-gradient-{{ $user->status === 'active' ? 'success' : 'secondary' }} status-badge">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $user->created_at->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <button wire:click="editUser({{ $user->id }})" class="btn btn-sm btn-info me-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button wire:click="confirmUserDeletion({{ $user->id }})" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="fas fa-users fa-3x text-secondary mb-2"></i>
                                                    <h5 class="text-secondary">No users found</h5>
                                                    <p class="text-muted">Try adjusting your search filters</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="px-4 py-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Create/Edit User Modal -->
        <div class="modal fade" id="userFormModal" tabindex="-1" aria-labelledby="userFormModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userFormModalLabel">{{ $isEditMode ? 'Edit User' : 'Create User' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="saveUser">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input wire:model.defer="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select wire:model.defer="role" class="form-select @error('role') is-invalid @enderror" id="role">
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="user">User</option>
                                </select>
                                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select wire:model.defer="status" class="form-select @error('status') is-invalid @enderror" id="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ $isEditMode ? 'Password (leave blank to keep current)' : 'Password' }}</label>
                                <input wire:model.defer="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input wire:model.defer="password_confirmation" type="password" class="form-control" id="password_confirmation">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancelForm">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="saveUser">Save</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Delete Selected Confirmation Modal -->
        <div class="modal fade" id="deleteSelectedConfirmationModal" tabindex="-1" aria-labelledby="deleteSelectedConfirmationModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSelectedConfirmationModalLabel">Delete Selected Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the selected users? This action cannot be undone.</p>
                        <p class="text-danger">Total users to be deleted: {{ count($selectedRows) }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteSelectedConfirmed">Delete Selected</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Toast Container -->
        <div class="toast-container"></div>
        
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Handle show form event
                    window.addEventListener('show-form', event => {
                        var userFormModal = new bootstrap.Modal(document.getElementById('userFormModal'));
                        userFormModal.show();
                    });
                    
                    // Handle hide form event
                    window.addEventListener('hide-form', event => {
                        var userFormModal = bootstrap.Modal.getInstance(document.getElementById('userFormModal'));
                        if (userFormModal) {
                            userFormModal.hide();
                        }
                    });
                    
                    // Handle delete confirmation
                    window.addEventListener('show-delete-confirmation', event => {
                        var deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                        deleteConfirmationModal.show();
                        
                        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                            @this.call('deleteUser', event.detail.userId);
                            deleteConfirmationModal.hide();
                        });
                    });
                    
                    // Handle delete selected confirmation
                    window.addEventListener('show-delete-selected-confirmation', event => {
                        var deleteSelectedConfirmationModal = new bootstrap.Modal(document.getElementById('deleteSelectedConfirmationModal'));
                        deleteSelectedConfirmationModal.show();
                    });
                    
                    // Handle alerts
                    window.addEventListener('alert', event => {
                        const toast = document.createElement('div');
                        toast.className = `toast align-items-center text-white bg-${event.detail.type} border-0`;
                        toast.setAttribute('role', 'alert');
                        toast.setAttribute('aria-live', 'assertive');
                        toast.setAttribute('aria-atomic', 'true');
                        
                        toast.innerHTML = `
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${event.detail.message}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        `;
                        
                        document.querySelector('.toast-container').appendChild(toast);
                        
                        const bsToast = new bootstrap.Toast(toast, {
                            delay: 5000
                        });
                        
                        bsToast.show();
                        
                        // Remove toast after it's hidden
                        toast.addEventListener('hidden.bs.toast', function() {
                            toast.remove();
                        });
                    });
                });
            </script>
        @endpush
    </div>
</div>