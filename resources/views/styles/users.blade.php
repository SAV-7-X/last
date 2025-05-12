<style>
    /* Enhanced Navbar Styling */
    .navbar {
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .navbar-brand {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .nav-link {
        position: relative;
        margin: 0 5px;
        padding: 10px 15px !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .nav-link:before {
        content: '';
        position: absolute;
        width: 0;
        height: 3px;
        bottom: 0;
        left: 50%;
        background-color: var(--bs-primary);
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }
    
    .nav-link.active:before,
    .nav-link:hover:before {
        width: 70%;
    }
    
    .nav-link.active {
        color: var(--bs-primary) !important;
        background-color: rgba(var(--bs-primary-rgb), 0.05);
        border-radius: 6px;
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--bs-primary);
        opacity: 0.7;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: var(--bs-primary);
        opacity: 1;
    }
    
    /* Custom Avatar Styling */
    .avatar-wrapper {
        width: 40px;
        height: 40px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .avatar-wrapper:hover {
        transform: scale(1.05);
    }
    
    /* Table Row Hover Animation */
    tr {
        transition: all 0.2s ease;
    }
    
    tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        z-index: 1;
        position: relative;
    }
    
    /* Button Hover Effects */
    .btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }
    
    .btn-primary {
        box-shadow: 0 4px 10px rgba(var(--bs-primary-rgb), 0.3);
    }
    
    .btn-danger {
        box-shadow: 0 4px 10px rgba(var(--bs-danger-rgb), 0.3);
    }
    
    /* Card Styling */
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    /* Custom Badge Styling */
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    </style>