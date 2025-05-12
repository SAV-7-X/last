@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('notify', ({ type, message }) => {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.classList.add('toast', 'show', 'align-items-center', 'border-0', 'shadow-sm');
            
            const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
            toast.classList.add(bgClass, 'text-white');
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

            toastContainer.appendChild(toast);

            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        });
    });
</script>
@endpush