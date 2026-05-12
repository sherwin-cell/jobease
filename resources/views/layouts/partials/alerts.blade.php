@if(session('success'))
    <div class="alert-message alert-success animate-slide-in">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="alert-text">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="alert-message alert-error animate-slide-in">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="alert-text">{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert-message alert-error animate-slide-in">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="alert-title">There were {{ $errors->count() }} errors with your submission</h3>
                <div class="alert-error-list">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    /* ============================================================
       GLOBAL ALERT STYLES - COMPACT & UNIFIED
    ============================================================ */
    .alert-message {
        margin-bottom: 1rem;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border-left-width: 4px;
    }

    .alert-success {
        background: #dcfce7;
        border-left-color: #22c55e;
    }

    .alert-error {
        background: #fee2e2;
        border-left-color: #ef4444;
    }

    .alert-icon {
        width: 18px;
        height: 18px;
    }

    .alert-success .alert-icon {
        color: #22c55e;
    }

    .alert-error .alert-icon {
        color: #ef4444;
    }

    .alert-text {
        font-size: 0.875rem;
        font-weight: 500;
    }

    .alert-success .alert-text {
        color: #166534;
    }

    .alert-error .alert-text {
        color: #991b1b;
    }

    .alert-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #991b1b;
        margin-bottom: 0.25rem;
    }

    .alert-error-list {
        font-size: 0.813rem;
        color: #991b1b;
        margin-top: 0.25rem;
    }

    .alert-error-list ul {
        padding-left: 1.25rem;
    }

    .alert-error-list li {
        margin-bottom: 0.125rem;
    }

    /* Animation */
    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .alert-message {
            padding: 0.5rem 0.75rem;
        }
        
        .alert-icon {
            width: 14px;
            height: 14px;
        }
        
        .alert-text {
            font-size: 0.75rem;
        }
        
        .alert-title {
            font-size: 0.75rem;
        }
        
        .alert-error-list {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 480px) {
        .alert-message {
            padding: 0.375rem 0.625rem;
        }
        
        .alert-icon {
            width: 12px;
            height: 12px;
        }
        
        .alert-text {
            font-size: 0.7rem;
        }
    }
</style>