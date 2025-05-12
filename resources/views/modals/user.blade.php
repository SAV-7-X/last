<!-- Create/Edit User Modal with Modern UI -->
<div class="modal fade" id="userFormModal" tabindex="-1" aria-labelledby="userFormModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title d-flex align-items-center" id="userFormModalLabel">
                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                        <i class="fas {{ $isEditMode ? 'fa-edit' : 'fa-user-plus' }} text-primary"></i>
                    </span>
                    {{ $isEditMode ? 'Edit User' : 'Create New User' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form wire:submit.prevent="saveUser">
                    <div class="mb-4">
                        <label for="name" class="form-label small text-muted fw-bold">Full Name</label>
                        <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-user text-primary opacity-50"></i>
                            </span>
                            <input wire:model.defer="name" type="text" 
                                class="form-control border-0 @error('name') is-invalid @enderror" 
                                id="name" placeholder="Enter user's full name">
                        </div>
                        @error('name') <div class="text-danger small mt-2 ps-2">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="form-label small text-muted fw-bold">Email Address</label>
                        <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-envelope text-primary opacity-50"></i>
                            </span>
                            <input wire:model.defer="email" type="email" 
                                class="form-control border-0 @error('email') is-invalid @enderror" 
                                id="email" placeholder="Enter email address">
                        </div>
                        @error('email') <div class="text-danger small mt-2 ps-2">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="role" class="form-label small text-muted fw-bold">Role</label>
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-user-tag text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.defer="role" 
                                        class="form-select border-0 @error('role') is-invalid @enderror" 
                                        id="role">
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        {{-- <option value="manager">Manager</option> --}}
                                        <option value="customer">User</option>
                                    </select>
                                </div>
                                @error('role') <div class="text-danger small mt-2 ps-2">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="status" class="form-label small text-muted fw-bold">Status</label>
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-toggle-on text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.defer="status" 
                                        class="form-select border-0 @error('status') is-invalid @enderror" 
                                        id="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                @error('status') <div class="text-danger small mt-2 ps-2">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label small text-muted fw-bold">
                            {{ $isEditMode ? 'Password (leave blank to keep current)' : 'Password' }}
                        </label>
                        <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-lock text-primary opacity-50"></i>
                            </span>
                            <input wire:model.defer="password" type="password" 
                                class="form-control border-0 @error('password') is-invalid @enderror" 
                                id="password" placeholder="{{ $isEditMode ? 'Enter new password' : 'Enter password' }}">
                        </div>
                        @error('password') <div class="text-danger small mt-2 ps-2">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small text-muted fw-bold">Confirm Password</label>
                        <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-lock text-primary opacity-50"></i>
                            </span>
                            <input wire:model.defer="password_confirmation" type="password" 
                                class="form-control border-0" id="password_confirmation" 
                                placeholder="Confirm password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal" wire:click="cancelForm">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" wire:click="saveUser">
                    <i class="fas fa-save me-1"></i> Save User
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal with Modern UI -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="modal-body p-0">
                <div class="text-center bg-danger text-white py-4">
                    <div class="rounded-circle bg-white p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-user-times text-danger fa-2x"></i>
                    </div>
                    <h5 class="mb-0">Delete User</h5>
                </div>
                <div class="p-4 text-center">
                    <h6 class="fw-bold mb-3">Are you sure?</h6>
                    <p class="text-muted small mb-4">You are about to delete this user. This action cannot be undone.</p>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger rounded-pill px-4 shadow-sm" id="confirmDeleteBtn">
                            <i class="fas fa-trash-alt me-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Selected Confirmation Modal with Modern UI -->
<div class="modal fade" id="deleteSelectedConfirmationModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="modal-body p-0">
                <div class="text-center bg-danger text-white py-4">
                    <div class="rounded-circle bg-white p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-users-slash text-danger fa-2x"></i>
                    </div>
                    <h5 class="mb-0">Delete Selected Users</h5>
                </div>
                
                <div class="p-4 text-center">
                    <h6 class="fw-bold mb-3">Bulk Delete Confirmation</h6>
                    <p class="text-muted mb-3">You are about to delete the selected users. This action cannot be undone.</p>
                    
                    <div class="alert alert-light rounded-pill border border-danger border-2 d-inline-flex align-items-center mb-4">
                        <span class="badge bg-danger rounded-pill me-2">{{ count($selectedRows) }}</span>
                        <span class="fw-medium">users selected for deletion</span>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger rounded-pill px-4 shadow-sm" wire:click="deleteSelectedConfirmed">
                            <i class="fas fa-trash-alt me-1"></i> Delete Selected
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal Animation Styles -->
<style>
    /* Modal Animation Enhancements */
    .modal .modal-content {
        transform: scale(0.8);
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .modal.show .modal-content {
        transform: scale(1);
        opacity: 1;
    }
    
    /* Custom input field styling */
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: var(--bs-primary);
    }
    
    .input-group-merge {
        transition: all 0.3s ease;
    }
    
    .input-group-merge:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25) !important;
    }
    
    /* Modal icon styling */
    .modal-title .rounded-circle {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Delete modal icon container animation */
    .modal .rounded-circle {
        animation: pulseIcon 2s infinite;
    }
    
    @keyframes pulseIcon {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(var(--bs-danger-rgb), 0.7);
        }
        
        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(var(--bs-danger-rgb), 0);
        }
        
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(var(--bs-danger-rgb), 0);
        }
    }
    
    /* Modal footer buttons */
    .modal-footer .btn {
        transition: all 0.3s ease;
    }
    
    .modal-footer .btn:hover {
        transform: translateY(-2px);
    }
    
    .modal-footer .btn-primary {
        box-shadow: 0 4px 10px rgba(var(--bs-primary-rgb), 0.3);
    }
    
    .modal-footer .btn-danger {
        box-shadow: 0 4px 10px rgba(var(--bs-danger-rgb), 0.3);
    }
</style>