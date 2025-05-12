@push('scripts')
<script>
    document.addEventListener('livewire:initialized', function () {
        var categoryFormModal = new bootstrap.Modal(document.getElementById('categoryFormModal'));
        var deleteCategoryModal = new bootstrap.Modal(document.getElementById('deleteCategoryModal'));
        var deleteSelectedModal = new bootstrap.Modal(document.getElementById('deleteSelectedModal'));
        
        // Show form modal
        window.addEventListener('show-form', function () {
            categoryFormModal.show();
        });
        
        // Hide form modal
        window.addEventListener('hide-form', function () {
            categoryFormModal.hide();
        });
        
        // Show delete confirmation
        window.addEventListener('show-delete-confirmation', function (data) {
            window.livewire.dispatch('set-category-being-deleted', data);
            deleteCategoryModal.show();
        });
        
        // Show delete selected confirmation
        window.addEventListener('show-delete-selected-confirmation', function () {
            deleteSelectedModal.show();
        });
        
        // Show alerts/notifications
        window.addEventListener('alert', function (data) {
            showToast(data.type, data.message);
        });
        
        // Function to show toast notifications
        function showToast(type, message) {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type} border-0 mb-2`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            
            const icon = type === 'success' ? 'check-circle' : 
                        type === 'danger' ? 'exclamation-circle' : 
                        type === 'warning' ? 'exclamation-triangle' : 'info-circle';
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${icon} me-2"></i> ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast, { delay: 5000 });
            bsToast.show();
            
            // Remove toast from DOM after it's hidden
            toast.addEventListener('hidden.bs.toast', function () {
                toastContainer.removeChild(toast);
            });
        }
    });
</script>

<!-- Initialize AOS animation library -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            once: true, // animations only happen once
            duration: 800, // values from 0 to 3000, with step 50ms
        });
    });
</script> --}}
@endpush