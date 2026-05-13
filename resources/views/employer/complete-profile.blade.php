@extends('layouts.standalone')

@section('title', 'Complete Your Company Profile')

@section('content')
<style>
    /* ============================================================
       PAGE CONTAINER
    ============================================================ */
    .full-page-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        padding: 2rem 0;
    }

    .content-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* ============================================================
       GLOBAL ICON SIZING - ONE RULE TO RULE THEM ALL
    ============================================================ */
    svg {
        width: 20px;
        height: 20px;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    /* ============================================================
       PROFILE CARD
    ============================================================ */
    .profile-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        border: 1px solid #e5e7eb;
    }

    /* ============================================================
       HEADER
    ============================================================ */
    .profile-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .profile-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.5rem;
    }

    .profile-header p {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    /* ============================================================
       SECTIONS
    ============================================================ */
    .profile-section {
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .profile-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* ============================================================
       FORM ELEMENTS
    ============================================================ */
    .profile-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.875rem;
    }

    .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

    .profile-input,
    .profile-textarea,
    .profile-select {
        width: 100%;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        background: #fff;
        transition: all 0.2s;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .profile-input:focus,
    .profile-textarea:focus,
    .profile-select:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .profile-textarea {
        resize: vertical;
        font-family: inherit;
    }

    .form-hint {
        font-size: 0.7rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    /* ============================================================
       FLEX ROW
    ============================================================ */
    .profile-flex-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .profile-flex-col {
        flex: 1;
        min-width: 200px;
    }

    /* ============================================================
       BUTTONS
    ============================================================ */
    .profile-btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        width: 100%;
        font-size: 0.875rem;
        transition: all 0.2s;
        cursor: pointer;
    }

    .profile-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    /* ============================================================
       FILE UPLOAD
    ============================================================ */
    .file-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafbfc;
    }

    .file-upload-area:hover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .file-upload-area.dragover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .file-input {
        display: none;
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
        border-radius: 12px;
        display: none;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .file-info.show {
        display: flex;
    }

    .file-name {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: #374151;
        word-break: break-all;
        flex: 1;
    }

    .file-size {
        font-size: 0.7rem;
        color: #6b7280;
        white-space: nowrap;
    }

    .file-remove-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 8px;
        padding: 0.375rem 0.875rem;
        font-size: 0.7rem;
        cursor: pointer;
        transition: background 0.2s;
        font-weight: 500;
    }

    .file-remove-btn:hover {
        background: #fecaca;
    }

    .current-file {
        background: #e0e7ff;
        border-radius: 12px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .current-file-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: #3730a3;
        word-break: break-all;
        flex: 1;
    }

    .current-file-btn {
        background: #c7d2fe;
        color: #3730a3;
        border: none;
        border-radius: 8px;
        padding: 0.375rem 0.875rem;
        font-size: 0.7rem;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .current-file-btn:hover {
        background: #a5b4fc;
    }

    .upload-placeholder {
        background: #fef3c7;
        border: 1px solid #fde68a;
        border-radius: 12px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.8rem;
        color: #92400e;
    }

    /* ============================================================
       ALERTS
    ============================================================ */
    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        font-size: 0.8rem;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 1rem;
    }

    .alert-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        font-size: 0.8rem;
    }

    .upload-success-message {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
    }

    /* ============================================================
       FOOTER
    ============================================================ */
    .profile-footer {
        margin-top: 1.5rem;
        text-align: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .profile-footer p {
        font-size: 0.7rem;
        color: #9ca3af;
        margin: 0;
    }

    /* ============================================================
       RESPONSIVE DESIGN - Only size and spacing changes, NO icon overrides
    ============================================================ */

    /* Tablet (768px and below) */
    @media (max-width: 768px) {
        .full-page-container {
            padding: 1rem 0;
        }

        .content-wrapper {
            padding: 0 1rem;
        }

        .profile-card {
            padding: 1.5rem;
        }

        .profile-header h1 {
            font-size: 1.25rem;
        }

        .profile-header p {
            font-size: 0.75rem;
        }
    }

    /* Mobile (640px and below) */
    @media (max-width: 640px) {
        .full-page-container {
            padding: 0.75rem 0;
        }

        .content-wrapper {
            padding: 0 0.75rem;
        }

        .profile-card {
            padding: 1rem;
            border-radius: 20px;
        }

        .profile-header {
            margin-bottom: 1rem;
        }

        .profile-header h1 {
            font-size: 1.125rem;
        }

        .profile-header p {
            font-size: 0.7rem;
        }

        .profile-section {
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }

        .profile-label {
            font-size: 0.8rem;
        }

        .profile-input,
        .profile-textarea,
        .profile-select {
            padding: 0.625rem 0.875rem;
            font-size: 0.8rem;
            border-radius: 10px;
        }

        .profile-flex-row {
            flex-direction: column;
            gap: 0.75rem;
        }

        .profile-flex-col {
            min-width: 100%;
        }

        .profile-btn-primary {
            padding: 0.75rem 1.5rem;
            font-size: 0.8rem;
        }

        /* File upload area */
        .file-upload-area {
            padding: 1.5rem;
        }

        .file-upload-text {
            font-size: 0.75rem;
        }

        .file-upload-text br {
            display: none;
        }

        .file-info {
            flex-direction: column;
            align-items: flex-start;
        }

        .file-name {
            width: 100%;
        }

        .file-remove-btn {
            width: 100%;
            text-align: center;
        }

        .current-file {
            flex-direction: column;
            align-items: flex-start;
        }

        .current-file-info {
            width: 100%;
        }

        .current-file-btn {
            width: 100%;
            text-align: center;
            justify-content: center;
        }

        .upload-placeholder {
            font-size: 0.7rem;
            padding: 0.6rem;
        }

        /* Alerts */
        .alert-error,
        .alert-info,
        .upload-success-message {
            padding: 0.6rem 0.875rem;
            font-size: 0.7rem;
            border-radius: 10px;
        }

        .profile-footer {
            margin-top: 1rem;
        }
    }

    /* Very Small Phones (480px and below) */
    @media (max-width: 480px) {
        .full-page-container {
            padding: 0.5rem 0;
        }

        .content-wrapper {
            padding: 0 0.5rem;
        }

        .profile-card {
            padding: 0.875rem;
            border-radius: 16px;
        }

        .profile-header h1 {
            font-size: 1rem;
        }

        .profile-header p {
            font-size: 0.65rem;
        }

        .section-title {
            font-size: 0.85rem;
        }

        .profile-label {
            font-size: 0.75rem;
        }

        .profile-input,
        .profile-textarea,
        .profile-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 8px;
        }

        .form-hint {
            font-size: 0.6rem;
        }

        .file-upload-area {
            padding: 1rem;
        }

        .file-upload-text {
            font-size: 0.7rem;
        }

        .file-name {
            font-size: 0.7rem;
        }

        .file-size {
            font-size: 0.6rem;
        }

        .file-remove-btn,
        .current-file-btn {
            padding: 0.3rem 0.7rem;
            font-size: 0.65rem;
        }

        .profile-btn-primary {
            padding: 0.625rem 1.25rem;
            font-size: 0.75rem;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <div class="profile-card">
            <div class="profile-header">
                <h1>Complete Your Company Profile</h1>
                <p>Tell us about your company to start posting jobs</p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
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
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('employer.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Company Information Section -->
                <div class="profile-section">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Company Information
                    </div>

                    <label class="profile-label">Company Name <span class="required-star">*</span></label>
                    <input type="text" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}"
                        class="profile-input" placeholder="Enter your company name" required>

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

                    <label class="profile-label">Website</label>
                    <input type="url" name="website" value="{{ old('website', $company->website ?? '') }}"
                        class="profile-input" placeholder="https://www.yourcompany.com">
                    <p class="form-hint">Optional but recommended</p>
                </div>

                <!-- Legal Documents Section -->
                <div class="profile-section">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Legal Documents
                    </div>

                    <label class="profile-label">Business Permit / Mayor's Permit <span class="required-star">*</span></label>

                    @if(($company->business_permit_path ?? false))
                        <div class="current-file">
                            <div class="current-file-info">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Current file: {{ basename($company->business_permit_path) }}</span>
                            </div>
                            <a href="{{ Storage::url($company->business_permit_path) }}" target="_blank" class="current-file-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                        </div>
                    @endif

                    @if(!($company->business_permit_path ?? false))
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>No business permit uploaded yet. Please upload your business permit.</span>
                        </div>
                    @endif

                    <div class="file-upload-area" id="fileUploadArea">
                        <input type="file" name="business_permit" id="businessPermit" class="file-input" accept=".jpg,.jpeg,.png,.pdf">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <div class="file-upload-text">
                            <strong>Click to upload</strong> or drag and drop<br>
                            <span style="font-size: 0.7rem;">JPG, PNG, or PDF (Max 5MB)</span>
                        </div>
                    </div>

                    <div class="file-info" id="fileInfo">
                        <div class="file-name">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span id="fileName"></span>
                            <span class="file-size" id="fileSize"></span>
                        </div>
                        <button type="button" class="file-remove-btn" id="removeFileBtn">Remove</button>
                    </div>
                    <p class="form-hint">Upload a valid business permit for verification</p>
                </div>

                <!-- Company Description Section -->
                <div class="profile-section">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        About the Company
                    </div>

                    <label class="profile-label">Company Description <span class="required-star">*</span></label>
                    <textarea name="description" rows="5" class="profile-textarea" 
                        placeholder="Describe your company, its mission, values, and what makes it unique..." 
                        required>{{ old('description', $company->description ?? '') }}</textarea>
                    <p class="form-hint">This will help job seekers understand your company culture</p>
                </div>

                <button type="submit" class="profile-btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Complete Profile & Access Dashboard
                </button>
            </form>

            <div class="profile-footer">
                <p>All information provided will be kept confidential and used only for verification purposes.</p>
            </div>
        </div>
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

    if (fileUploadArea) {
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
    }

    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                updateFileDisplay(file);
            }
        });
    }

    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', () => {
            resetFileDisplay();
        });
    }
</script>
@endsection