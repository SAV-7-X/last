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
            toast.className = `toast align-items-center text-white bg-${event.detail.type === 'success' ? 'warning text-dark' : event.detail.type} border-0 shadow-sm`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            
            const icon = event.detail.type === 'success' ? 'check-circle' : 
                       event.detail.type === 'danger' ? 'exclamation-circle' : 
                       event.detail.type === 'warning' ? 'exclamation-triangle' : 'info-circle';
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${icon} me-2"></i>
                        ${event.detail.message}
                    </div>
                    <button type="button" class="btn-close ${event.detail.type === 'success' ? '' : 'btn-close-white'} me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            
            document.getElementById('toastContainer').appendChild(toast);
            
            const bsToast = new bootstrap.Toast(toast, {
                delay: 5000,
                animation: true
            });
            
            bsToast.show();
            
            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
            });
        });
    });
</script>
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                AOS.init({
                    once: true
                });
                
                // Re-initialize AOS after Livewire updates
                // if (typeof window.Livewire !== 'undefined') {
                //     window.Livewire.hook('message.processed', () => {
                //         AOS.refresh();
                //     });
                // }
            });
        </script> --}}
@endpush