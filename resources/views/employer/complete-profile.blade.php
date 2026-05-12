@extends('layouts.standalone')

@section('title', 'Complete Your Company Profile')

@section('content')

<style>
    .profile-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(60, 72, 88, .08);
        padding: 2.5rem 2rem;
        max-width: 900px;
        margin: 2rem auto;
    }

    .profile-section {
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
    }

    .profile-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .profile-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }

    .profile-input,
    .profile-textarea,
    .profile-select {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        background: #f9fafb;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .profile-input:focus,
    .profile-textarea:focus,
    .profile-select:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 2px #2563eb22;
        background: #fff;
    }

    .profile-btn-primary {
        background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 2rem;
        margin-top: 1.5rem;
        width: 100%;
        font-size: 1.1rem;
        transition: background 0.2s;
        cursor: pointer;
    }

    .profile-btn-primary:hover {
        background: linear-gradient(90deg, #1e40af 0%, #2563eb 100%);
    }

    .profile-flex-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .profile-flex-col {
        flex: 1 1 0;
        min-width: 200px;
    }

    .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-hint {
        font-size: 0.7rem;
        color: #6b7280;
        margin-top: -0.5rem;
        margin-bottom: 0.5rem;
    }

    /* File Upload Styles */
    .file-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafbfc;
    }

    .file-upload-area:hover {
        border-color: #2563eb;
        background: #f0f9ff;
    }

    .file-upload-area.dragover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .file-input {
        display: none;
    }

    .file-upload-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        color: #9ca3af;
    }

    .file-upload-text {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .file-upload-text strong {
        color: #2563eb;
    }

    .file-info {
        margin-top: 1rem;
        padding: 0.75rem;
        background: #f3f4f6;
        border-radius: 8px;
        display: none;
        align-items: center;
        justify-content: space-between;
    }

    .file-info.show {
        display: flex;
    }

    .file-name {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #374151;
    }

    .file-size {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .file-remove-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 6px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .file-remove-btn:hover {
        background: #fecaca;
    }

    .current-file {
        background: #e0e7ff;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .current-file-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #3730a3;
    }

    .current-file-btn {
        background: #c7d2fe;
        color: #3730a3;
        border: none;
        border-radius: 6px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
    }

    .current-file-btn:hover {
        background: #a5b4fc;
    }

    .upload-success-message {
        margin-top: 0.75rem;
        padding: 0.5rem 0.75rem;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        color: #15803d;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .upload-placeholder {
        background: #fef3c7;
        border: 1px solid #fde68a;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        color: #92400e;
    }

    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .alert-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }
</style>

<div class="profile-card">
    <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">
        Complete Your Company Profile
    </h1>
    <p class="text-center text-gray-600 mb-6">
        Tell us about your company to start posting jobs
    </p>

    @if ($errors->any())
        <div class="alert-error">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('info'))
        <div class="alert-info">
            {{ session('info') }}
        </div>
    @endif

    @if (session('success'))
        <div class="upload-success-message">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('employer.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Company Name -->
        <div class="profile-section">
            <label class="profile-label">Company Name <span class="required-star">*</span></label>
            <input type="text" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}"
                class="profile-input" placeholder="Enter your company name" required>
        </div>

        <!-- Location & Phone -->
        <div class="profile-section">
            <div class="profile-flex-row">
                <div class="profile-flex-col">
                    <label class="profile-label">Location <span class="required-star">*</span></label>
                    <input type="text" name="location" value="{{ old('location', $company->location ?? '') }}"
                        class="profile-input" placeholder="City, Country" required>
                </div>
                <div class="profile-flex-col">
                    <label class="profile-label">Phone Number <span class="required-star">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone', $company->phone ?? '') }}"
                        class="profile-input" placeholder="+1 234 567 8900" required>
                </div>
            </div>
        </div>

        <!-- Website -->
        <div class="profile-section">
            <label class="profile-label">Website</label>
            <input type="url" name="website" value="{{ old('website', $company->website ?? '') }}"
                class="profile-input" placeholder="https://www.yourcompany.com">
            <p class="form-hint">Optional but recommended</p>
        </div>

        <!-- Business Permit Upload -->
        <div class="profile-section">
            <label class="profile-label">Business Permit / Mayor's Permit <span class="required-star">*</span></label>

            @if(($company->business_permit_path ?? false))
                <div class="current-file">
                    <div class="current-file-info">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Current file: {{ basename($company->business_permit_path) }}</span>
                    </div>
                    <a href="{{ Storage::url($company->business_permit_path) }}" target="_blank" class="current-file-btn">View</a>
                </div>
            @endif

            @if(!($company->business_permit_path ?? false))
                <div class="upload-placeholder" id="uploadPlaceholder">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>No business permit uploaded yet. Please upload your business permit.</span>
                </div>
            @endif

            <div class="file-upload-area" id="fileUploadArea">
                <input type="file" name="business_permit" id="businessPermit" class="file-input" accept=".jpg,.jpeg,.png,.pdf">
                <div class="file-upload-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <div class="file-upload-text">
                    <strong>Click to upload</strong> or drag and drop<br>
                    <span style="font-size: 0.75rem;">JPG, PNG, or PDF (Max 5MB)</span>
                </div>
            </div>

            <div class="file-info" id="fileInfo">
                <div class="file-name">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span id="fileName"></span>
                    <span class="file-size" id="fileSize"></span>
                </div>
                <button type="button" class="file-remove-btn" id="removeFileBtn">Remove</button>
            </div>
            <p class="form-hint">Upload a valid business permit for verification</p>
        </div>

        <!-- Company Description -->
        <div class="profile-section">
            <label class="profile-label">Company Description <span class="required-star">*</span></label>
            <textarea name="description" rows="5" class="profile-textarea" 
                placeholder="Describe your company, its mission, values, and what makes it unique..." 
                required>{{ old('description', $company->description ?? '') }}</textarea>
            <p class="form-hint">This will help job seekers understand your company culture</p>
        </div>

        <button type="submit" class="profile-btn-primary">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Complete Profile & Access Dashboard
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-xs text-gray-500">All information provided will be kept confidential and used only for verification purposes.</p>
    </div>
</div>

<script>
    // File upload handling
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('businessPermit');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeFileBtn = document.getElementById('removeFileBtn');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const currentFile = document.querySelector('.current-file');

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function updateFileDisplay(file) {
        if (file) {
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            fileInfo.classList.add('show');
            fileUploadArea.style.display = 'none';
            
            if (uploadPlaceholder) uploadPlaceholder.style.display = 'none';
            if (currentFile) currentFile.style.display = 'none';
        }
    }

    function resetFileDisplay() {
        fileInfo.classList.remove('show');
        fileUploadArea.style.display = 'block';
        fileInput.value = '';
        
        if (uploadPlaceholder && !currentFile) {
            uploadPlaceholder.style.display = 'flex';
        }
        if (currentFile) {
            currentFile.style.display = 'flex';
        }
    }

    fileUploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    fileUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadArea.classList.add('dragover');
    });

    fileUploadArea.addEventListener('dragleave', () => {
        fileUploadArea.classList.remove('dragover');
    });

    fileUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file && (file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'application/pdf')) {
            if (file.size <= 5 * 1024 * 1024) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                updateFileDisplay(file);
            } else {
                alert('File size must be less than 5MB');
            }
        } else {
            alert('Please upload JPG, PNG, or PDF files only');
        }
    });

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            updateFileDisplay(file);
        }
    });

    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', () => {
            resetFileDisplay();
        });
    }
</script>
@endsection