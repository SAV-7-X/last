

<!-- Add AOS CSS and JS -->


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-duration="800">
            <div class="card shadow-lg border-0 rounded-3 mb-4 overflow-hidden">
                <!-- Card Header with Elegant Styling -->
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 d-flex align-items-center">
                        <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="fas fa-users text-light"></i>
                        </span>
                        <span class="fw-bold">Users Management</span>
                    </h5>
                    <button wire:click="createUser" class="btn btn-primary btn-sm d-flex align-items-center rounded-pill px-3 py-2">
                        <i class="fas fa-plus me-2"></i> Add New User
                    </button>
                </div>
                
                <div class="card-body">
                    <!-- Search Filters with Enhanced UI -->
                    <div class="bg-light p-4 mb-4 rounded-3 border-start border-primary border-4 shadow-sm" data-aos="fade-right" data-aos-duration="600">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-user text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchName" type="text" 
                                        class="form-control border-0" placeholder="Search by name...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-envelope text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchEmail" type="text" 
                                        class="form-control border-0" placeholder="Search by email...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-user-tag text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchRole" class="form-select border-0">
                                        <option value="">All Roles</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-toggle-on text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchStatus" class="form-select border-0">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-list-ol text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="perPage" class="form-select border-0">
                                        <option value="10">10 per page</option>
                                        <option value="25">25 per page</option>
                                        <option value="50">50 per page</option>
                                        <option value="100">100 per page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-3">
                            <button wire:click="resetFilters" class="btn btn-light me-2 rounded-pill px-3 shadow-sm">
                                <i class="fas fa-redo me-2"></i> Reset Filters
                            </button>
                            <button wire:click="deleteSelected" class="btn btn-danger rounded-pill px-3 shadow-sm" 
                                @if(empty($selectedRows)) disabled @endif>
                                <i class="fas fa-trash me-2"></i> Delete Selected
                                @if(!empty($selectedRows))
                                    <span class="badge bg-white text-danger ms-1">{{ count($selectedRows) }}</span>
                                @endif
                            </button>
                        </div>
                    </div>
                    
                    <!-- Users Table with Enhanced Styling -->
                    <div class="table-responsive shadow-sm rounded-3 border" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="ps-3">
                                        <div class="form-check d-flex justify-content-center">
                                            <input wire:model.live="selectAll" class="form-check-input" 
                                                type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('name')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            User 
                                            @if($sortField === 'name')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('role')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Role 
                                            @if($sortField === 'role')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('status')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Status 
                                            @if($sortField === 'status')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('created_at')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Created At
                                            @if($sortField === 'created_at')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr class="align-middle">
                                        <td class="ps-3">
                                            <div class="form-check d-flex justify-content-center">
                                                <input wire:model.live="selectedRows" value="{{ $user->id }}" 
                                                    class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-2">
                                                @if($user->profile_photo_path)
                                                    <div class="avatar-wrapper rounded-circle overflow-hidden me-3 shadow-sm border border-2 border-white">
                                                        <img src="{{ Storage::url($user->profile_photo_path) }}" 
                                                            class="avatar" alt="{{ $user->name }}">
                                                    </div>
                                                @else
                                                    <div class="avatar-wrapper rounded-circle me-3 shadow-sm 
                                                        bg-primary bg-opacity-10 text-light 
                                                        d-flex align-items-center justify-content-center border border-2 border-white"
                                                        style="width: 40px; height: 40px;">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm fw-semibold">{{ $user->name }}</h6>
                                                    <p class="text-muted small mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($user->status === 'active')
                                                <span class="badge bg-success bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary small">
                                                {{ $user->created_at->format('d M, Y') }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <button wire:click="editUser({{ $user->id }})" 
                                                    class="btn btn-sm btn-light text-primary rounded-pill me-1" title="Edit">
                                                    <i class="fas fa-edit fs-6"></i>
                                                </button>
                                                <button wire:click="confirmUserDeletion({{ $user->id }})" 
                                                    class="btn btn-sm btn-danger rounded-pill" title="Delete">
                                                    <i class="fas fa-trash fs-6"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="empty-state-icon bg-light p-4 rounded-circle mb-3 shadow-sm">
                                                    <i class="fas fa-users fa-3x text-primary opacity-50"></i>
                                                </div>
                                                <h5 class="text-dark">No users found</h5>
                                                <p class="text-muted mb-3">Try adjusting your search filters</p>
                                                <button wire:click="resetFilters" class="btn btn-primary rounded-pill px-4">
                                                    <i class="fas fa-redo me-2"></i> Reset Filters
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination with Enhanced Styling -->
                    <div class="d-flex justify-content-center justify-content-md-between align-items-center py-3 mt-3" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                        <div class="d-none d-md-block text-muted">
                            Showing <span class="fw-semibold">{{ $users->firstItem() ?: 0 }}</span> to 
                            <span class="fw-semibold">{{ $users->lastItem() ?: 0 }}</span> of 
                            <span class="fw-semibold">{{ $users->total() }}</span> users
                        </div>
                        
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('modals.user')
    
    <!-- Toast Container with Enhanced UI -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer" class="toast-container"></div>
    </div>
    
    @include('scripts.users')
    @include('styles.users')
   
        
        <!-- Initialize AOS -->
     
</div>

<!-- Suggested Custom CSS for Navbar Enhancement -->
