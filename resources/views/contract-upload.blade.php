<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Simple Document Upload</title>
    <style>
        :root {
            --primary: #3498db;
            --success: #2ecc71;
            --danger: #e74c3c;
            --background: #f5f7fa;
            --card-bg: white;
            --text-dark: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background-color: var(--background);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 1.8rem;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .upload-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        /* Combined Upload/Select Area */
        .upload-area {
            border: 2px dashed var(--primary);
            border-radius: 12px;
            padding: 25px 15px;
            text-align: center;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-area:hover,
        .upload-area.active {
            border-color: var(--success);
            background-color: #eafaf1;
        }

        .upload-icon {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .upload-text {
            color: #555;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .preview-container {
            margin-top: 15px;
            display: none;
            text-align: center;
        }

        .preview-title {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 8px;
        }

        .preview-image {
            max-width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
            max-height: 150px;
            object-fit: contain;
        }

        .remove-btn {
            background-color: var(--danger);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            margin-top: 10px;
            cursor: pointer;
        }

        .submit-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s;
            margin-top: 10px;
            opacity: 0.7;
            /* Initial disabled state look */
        }

        .submit-btn:not(:disabled) {
            background-color: var(--primary);
            opacity: 1;
        }

        .hidden-input {
            display: none;
        }

        .footer-note {
            text-align: center;
            color: #95a5a6;
            font-size: 0.8rem;
            margin-top: 25px;
        }

        /* Progress indicator styles */
        .progress-container {
            background-color: #ecf0f1;
            border-radius: 10px;
            margin-top: 25px;
            padding: 15px;
            display: none;
        }

        .progress-bar {
            height: 8px;
            background-color: #dfe6e9;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 5px;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--success);
            width: 0%;
            transition: width 0.5s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Document Upload</h1>
            <p>Upload the required images below. All fields are mandatory.</p>
        </div>

        <form id="uploadForm" action="{{ url('contract/' . $contract_ref . '/upload') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="card">

                <div class="form-group">
                    <label class="upload-label">ID Front</label>
                    <div class="upload-area" id="idFrontArea" data-field="id_front">
                        <div class="upload-icon">👆</div>
                        <div class="upload-text">Tap to Upload/Capture ID Front</div>
                    </div>
                    <input type="file" name="id_front" accept="image/*" class="hidden-input" id="idFrontInput" required>

                    <div class="preview-container" id="idFrontPreview">
                        <img src="" class="preview-image" id="idFrontImage">
                        <button type="button" class="remove-btn" data-field="id_front">Remove</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="upload-label">ID Back</label>
                    <div class="upload-area" id="idBackArea" data-field="id_back">
                        <div class="upload-icon">👆</div>
                        <div class="upload-text">Tap to Upload/Capture ID Back</div>
                    </div>
                    <input type="file" name="id_back" accept="image/*" class="hidden-input" id="idBackInput" required>

                    <div class="preview-container" id="idBackPreview">
                        <img src="" class="preview-image" id="idBackImage">
                        <button type="button" class="remove-btn" data-field="id_back">Remove</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="upload-label">Customer Selfie</label>
                    <div class="upload-area" id="customerArea" data-field="customer">
                        <div class="upload-icon">🤳</div>
                        <div class="upload-text">Tap to Upload/Capture Selfie</div>
                    </div>
                    <input type="file" name="customer" accept="image/*" class="hidden-input" id="customerInput"
                        required>

                    <div class="preview-container" id="customerPreview">
                        <img src="" class="preview-image" id="customerImage">
                        <button type="button" class="remove-btn" data-field="customer">Remove</button>
                    </div>
                </div>

                <div class="progress-container" id="progressContainer">
                    <div style="display: flex; justify-content: space-between; font-size: 0.9em;">
                        <span>Uploading...</span>
                        <span id="progressPercent">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn" disabled>
                    Upload Documents
                </button>
            </div>
        </form>

        <div class="footer-note">
            Max 5MB per image. Images will be optimized before upload.
        </div>
    </div>

    <script></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- DOM Elements ---
        const uploadForm = document.getElementById('uploadForm');
        const submitBtn = document.getElementById('submitBtn');
        const progressContainer = document.getElementById('progressContainer');
        const progressFill = document.getElementById('progressFill');
        const progressPercent = document.getElementById('progressPercent');

        // Map fields to their elements
        const fields = {
            id_front: { input: document.getElementById('idFrontInput'), area: document.getElementById('idFrontArea'), preview: document.getElementById('idFrontPreview'), image: document.getElementById('idFrontImage') },
            id_back: { input: document.getElementById('idBackInput'), area: document.getElementById('idBackArea'), preview: document.getElementById('idBackPreview'), image: document.getElementById('idBackImage') },
            customer: { input: document.getElementById('customerInput'), area: document.getElementById('customerArea'), preview: document.getElementById('customerPreview'), image: document.getElementById('customerImage') }
        };

        const MAX_ORIGINAL_SIZE_MB = 5;
        const COMPRESSION_QUALITY = 0.8;
        const MAX_DIMENSION = 1920; // Max width or height for resized image

        // --- Core Functions ---

        /**
         * Resizes and compresses an image file using Canvas.
         * @param {File} file - The original image file.
         * @param {function(File)} callback - Function to execute with the compressed file.
         */
        function compressImage(file, callback) {
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = function (event) {
                const img = new Image();
                img.src = event.target.result;

                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    let width = img.width;
                    let height = img.height;

                    // Resize logic: maintain aspect ratio while fitting within MAX_DIMENSION
                    if (width > height) {
                        if (width > MAX_DIMENSION) {
                            height *= MAX_DIMENSION / width;
                            width = MAX_DIMENSION;
                        }
                    } else {
                        if (height > MAX_DIMENSION) {
                            width *= MAX_DIMENSION / height;
                            height = MAX_DIMENSION;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);

                    // Convert canvas content back to a Blob (compressed image data)
                    canvas.toBlob(function (blob) {
                        // Create a new File object with the compressed blob
                        const compressedFile = new File([blob], file.name, {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });

                        callback(compressedFile);

                    }, 'image/jpeg', COMPRESSION_QUALITY);
                }
                img.onerror = () => alert("Error loading image for compression.");
            }
        }

        /**
         * Handles file selection, runs compression, and updates the UI.
         */
        function handleFileSelect(event, field) {
            const file = event.target.files[0];
            if (!file) return;

            // 1. Validation
            if (!file.type.match('image.*')) {
                alert('Please select an image file (JPG, PNG, etc.)');
                field.input.value = ''; // Clear input
                return;
            }
            if (file.size > MAX_ORIGINAL_SIZE_MB * 1024 * 1024) {
                alert(`Original file size exceeds ${MAX_ORIGINAL_SIZE_MB}MB limit. The image will be compressed, but please choose a smaller file if possible.`);
            }

            // 2. Compress & Process
            compressImage(file, function (compressedFile) {

                // Replace the original file with the compressed file in the input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(compressedFile);
                field.input.files = dataTransfer.files;

                // Show preview using the compressed file
                const reader = new FileReader();
                reader.onload = function (e) {
                    field.image.src = e.target.result;
                    field.preview.style.display = 'block';
                    field.area.classList.add('active'); // Change color/border

                    checkFormCompletion();
                };
                reader.readAsDataURL(compressedFile);
            });
        }

        /**
         * Clears file input and resets UI for a given field.
         */
        function removeImage(fieldName) {
            const field = fields[fieldName];
            field.input.value = '';
            field.preview.style.display = 'none';
            field.area.classList.remove('active');
            field.area.style.borderColor = 'var(--primary)';

            checkFormCompletion();
        }

        /**
         * Checks if all required file inputs have a file.
         */
        function checkFormCompletion() {
            const allFilled = Object.values(fields).every(f => f.input.files.length > 0);
            submitBtn.disabled = !allFilled;
            return allFilled;
        }


        /**
         * Submits the form via AJAX with upload progress tracking.
         */
        function submitFormWithProgress() {
            progressContainer.style.display = 'block';
            submitBtn.style.display = 'none';

            const formData = new FormData(uploadForm);
            const xhr = new XMLHttpRequest();
            const actionUrl = uploadForm.getAttribute('action');

            xhr.open('POST', actionUrl);

            // Get the CSRF token from the hidden input field (Laravel specific)
            const csrfTokenElement = document.querySelector('input[name="_token"]');
            if (csrfTokenElement) {
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfTokenElement.value);
            }

            // Progress Event Listener
            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressFill.style.width = percent + '%';
                    progressPercent.textContent = Math.round(percent) + '%';
                }
            });

            // Load/Completion Event Listener
            xhr.addEventListener('load', function () {
                progressContainer.style.display = 'none';
                submitBtn.style.display = 'block';

                if (xhr.status >= 200 && xhr.status < 300) {
                    alert('Upload successful! Documents submitted for verification.');
                    // Example: window.location.href = '/success-page';
                } else {
                    alert(`Upload failed! Server responded with status ${xhr.status}. Please check your connection and try again.`);
                }

                // Reset progress bar
                progressFill.style.width = '0%';
                progressPercent.textContent = '0%';
            });

            // Error Event Listener (for network issues, etc.)
            xhr.addEventListener('error', function () {
                alert('An network error occurred during upload. Please try again.');
                progressContainer.style.display = 'none';
                submitBtn.style.display = 'block';
            });

            // Send the request
            xhr.send(formData);
        }

        // --- Event Listeners ---

        // 1. Setup listeners for each field
        Object.keys(fields).forEach(key => {
            const field = fields[key];

            // 1.1 Trigger file input click when upload area is tapped
            field.area.addEventListener('click', function () {
                field.input.click();
            });

            // 1.2 Handle file selection change (and compression)
            field.input.addEventListener('change', (e) => handleFileSelect(e, field));

            // 1.3 Add visual feedback when dragging files over upload areas
            field.area.addEventListener('dragover', function (e) {
                e.preventDefault();
                this.classList.add('active');
            });

            field.area.addEventListener('dragleave', function () {
                if (field.input.files.length === 0) {
                    this.classList.remove('active');
                }
            });

            field.area.addEventListener('drop', function (e) {
                e.preventDefault();
                if (e.dataTransfer.files.length) {
                    field.input.files = e.dataTransfer.files;
                    const event = new Event('change', { bubbles: true });
                    field.input.dispatchEvent(event);
                }
            });
        });

        // 2. Set up listeners for remove buttons
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function () {
                removeImage(this.getAttribute('data-field'));
            });
        });

        // 3. Form submission handler
        uploadForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (checkFormCompletion()) {
                submitFormWithProgress();
            } else {
                alert("Please ensure all documents are uploaded before submitting.");
            }
        });

        // Initialize form state
        checkFormCompletion();
    });
</script>

</html>