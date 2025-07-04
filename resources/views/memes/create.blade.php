<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Meme - MemeHub</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        
        .container {
            max-width: 900px;
        }
        
        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            background-color: #fff;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 20px 25px;
            border-bottom: none;
            font-weight: bold;
            font-size: 1.8rem;
            position: relative;
        }
        
        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--accent-color);
        }
        
        .card-body {
            padding: 30px 25px;
        }
        
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 10px;
            font-size: 1.05rem;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            box-shadow: none;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }
        
        .form-text {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .btn {
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            box-shadow: 0 4px 10px rgba(108, 117, 125, 0.3);
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #dc3545;
            display: none;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }
        
        .upload-area {
            border: 2px dashed #ced4da;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .upload-area:hover {
            border-color: var(--primary-color);
        }
        
        .upload-icon {
            font-size: 3rem;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        #preview-container {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        #image-preview {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: none;
        }
        
        .source-icon {
            font-size: 1.5rem;
            margin-right: 10px;
            vertical-align: middle;
        }
        
        .instagram-icon {
            color: #C13584;
        }
        
        .tiktok-icon {
            color: #000000;
        }
        
        .upload-icon {
            color: #4361ee;
        }
        
        .step-number {
            display: inline-block;
            width: 28px;
            height: 28px;
            line-height: 28px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            text-align: center;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .option-card {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .option-card:hover, .option-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .option-card.selected {
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
        }
        
        .option-card-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card main-card">
            <div class="card-header">
                Create New Meme
            </div>
            <div class="card-body">
                <form method="POST" action="/memes" enctype="multipart/form-data" id="memeForm">
                    <!-- Remove CSRF token entirely since we've disabled verification in the route -->
                    
                    <div class="mb-4">
                        <h5 class="section-title"><span class="step-number">1</span> Give your meme a catchy title</h5>
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Enter a memorable title for your meme" required>
                        <div class="alert alert-danger mt-2" id="title-error"></div>
                    </div>

                    <div class="mb-4">
                        <h5 class="section-title"><span class="step-number">2</span> Choose your meme type</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="option-card" data-value="image" onclick="selectType(this, 'image')">
                                    <div class="text-center option-card-icon">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <h5 class="text-center">Image</h5>
                                    <p class="text-muted text-center small">Upload or link to static images</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="option-card" data-value="video" onclick="selectType(this, 'video')">
                                    <div class="text-center option-card-icon">
                                        <i class="fas fa-video"></i>
                                    </div>
                                    <h5 class="text-center">Video</h5>
                                    <p class="text-muted text-center small">Upload or link to video content</p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="type" name="type" required>
                        <div class="alert alert-danger mt-2" id="type-error"></div>
                    </div>

                    <div class="mb-4">
                        <h5 class="section-title"><span class="step-number">3</span> Select your content source</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="option-card" data-value="upload" onclick="selectSource(this, 'upload')">
                                    <div class="text-center option-card-icon">
                                        <i class="fas fa-upload upload-icon"></i>
                                    </div>
                                    <h5 class="text-center">Upload File</h5>
                                    <p class="text-muted text-center small">From your device</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="option-card" data-value="instagram" onclick="selectSource(this, 'instagram')">
                                    <div class="text-center option-card-icon">
                                        <i class="fab fa-instagram instagram-icon"></i>
                                    </div>
                                    <h5 class="text-center">Instagram</h5>
                                    <p class="text-muted text-center small">Link to Instagram post</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="option-card" data-value="tiktok" onclick="selectSource(this, 'tiktok')">
                                    <div class="text-center option-card-icon">
                                        <i class="fab fa-tiktok tiktok-icon"></i>
                                    </div>
                                    <h5 class="text-center">TikTok</h5>
                                    <p class="text-muted text-center small">Link to TikTok video</p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="source" name="source" required>
                        <div class="alert alert-danger mt-2" id="source-error"></div>
                    </div>

                    <div class="mb-4" id="upload-section" style="display: none;">
                        <h5 class="section-title"><span class="step-number">4</span> Upload your content</h5>
                        <div class="upload-area" id="drop-area" onclick="document.getElementById('content').click()">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <h5>Drag & drop your file here or click to browse</h5>
                            <p class="text-muted">Supported formats: JPEG, PNG, GIF, MP4, MOV (Max: 10MB)</p>
                        </div>
                        <input type="file" class="form-control d-none" id="content" name="content" onchange="previewFile()">
                        <div id="preview-container">
                            <img id="image-preview" class="mb-3">
                            <video id="video-preview" class="mb-3" controls style="display:none; max-width:100%; max-height:300px; border-radius:8px;"></video>
                            <p id="file-name" class="mb-2" style="display:none;"></p>
                        </div>
                        <div class="alert alert-danger mt-2" id="content-error"></div>
                    </div>

                    <div class="mb-4" id="url-section" style="display: none;">
                        <h5 class="section-title"><span class="step-number">4</span> Paste your content URL</h5>
                        <label for="content_url" class="form-label">Content URL</label>
                        <div class="input-group">
                            <span class="input-group-text" id="url-icon"><i class="fas fa-link"></i></span>
                            <input type="url" class="form-control" id="content_url" name="content_url" placeholder="Paste your Instagram or TikTok URL here">
                        </div>
                        <div class="form-text" id="url-help-text">Paste the full URL of the post you want to share</div>
                        <div class="alert alert-danger mt-2" id="content_url-error"></div>
                    </div>

                    <div class="mb-3 pt-3 d-flex justify-content-between">
                        <a href="/" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Create Meme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check URL for error parameters
        const urlParams = new URLSearchParams(window.location.search);
        const errors = {};
        
        // Initialize error UI based on server response
        if (urlParams.has('errors')) {
            try {
                const errorData = JSON.parse(decodeURIComponent(urlParams.get('errors')));
                for (const key in errorData) {
                    if (errorData.hasOwnProperty(key)) {
                        const errorElement = document.getElementById(key + '-error');
                        if (errorElement) {
                            errorElement.textContent = errorData[key];
                            errorElement.style.display = 'block';
                        }
                    }
                }
            } catch (e) {
                console.error('Error parsing error data:', e);
            }
        }
        
        // Initialize drag and drop functionality
        const dropArea = document.getElementById('drop-area');
        
        if (dropArea) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropArea.style.borderColor = '#4361ee';
                dropArea.style.backgroundColor = 'rgba(67, 97, 238, 0.05)';
            }
            
            function unhighlight() {
                dropArea.style.borderColor = '#ced4da';
                dropArea.style.backgroundColor = '#fff';
            }
            
            dropArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if(files.length) {
                    document.getElementById('content').files = files;
                    previewFile();
                }
            }
        }
        
        // Restore form values from session if available
        const oldValues = {};
        if (urlParams.has('old')) {
            try {
                const oldData = JSON.parse(decodeURIComponent(urlParams.get('old')));
                for (const key in oldData) {
                    if (oldData.hasOwnProperty(key)) {
                        const input = document.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.value = oldData[key];
                            
                            // For select elements with visual representation
                            if (key === 'type') {
                                const typeCard = document.querySelector(`.option-card[data-value="${oldData[key]}"]`);
                                if (typeCard) selectType(typeCard, oldData[key]);
                            }
                            
                            if (key === 'source') {
                                const sourceCard = document.querySelector(`.option-card[data-value="${oldData[key]}"]`);
                                if (sourceCard) selectSource(sourceCard, oldData[key]);
                            }
                        }
                    }
                }
            } catch (e) {
                console.error('Error parsing old values:', e);
            }
        }
    });
    
    function selectType(element, value) {
        // Remove selected class from all options
        document.querySelectorAll('.option-card[data-value="image"], .option-card[data-value="video"]').forEach(el => {
            el.classList.remove('selected');
        });
        
        // Add selected class to clicked option
        element.classList.add('selected');
        
        // Update hidden input
        document.getElementById('type').value = value;
    }
    
    function selectSource(element, value) {
        // Remove selected class from all options
        document.querySelectorAll('.option-card[data-value="upload"], .option-card[data-value="instagram"], .option-card[data-value="tiktok"]').forEach(el => {
            el.classList.remove('selected');
        });
        
        // Add selected class to clicked option
        element.classList.add('selected');
        
        // Update hidden input
        document.getElementById('source').value = value;
        
        // Update sections visibility
        updateSections(value);
        
        // Update URL icon if needed
        if(value === 'instagram') {
            document.getElementById('url-icon').innerHTML = '<i class="fab fa-instagram instagram-icon"></i>';
            document.getElementById('url-help-text').innerText = 'Paste the full URL of the Instagram post';
        } else if(value === 'tiktok') {
            document.getElementById('url-icon').innerHTML = '<i class="fab fa-tiktok tiktok-icon"></i>';
            document.getElementById('url-help-text').innerText = 'Paste the full URL of the TikTok video';
        }
    }
    
    function updateSections(value) {
        const uploadSection = document.getElementById('upload-section');
        const urlSection = document.getElementById('url-section');
        
        if (value === 'upload') {
            uploadSection.style.display = 'block';
            urlSection.style.display = 'none';
        } else if (value === 'instagram' || value === 'tiktok') {
            uploadSection.style.display = 'none';
            urlSection.style.display = 'block';
        } else {
            uploadSection.style.display = 'none';
            urlSection.style.display = 'none';
        }
    }
    
    function previewFile() {
        const fileInput = document.getElementById('content');
        const file = fileInput.files[0];
        
        if(file) {
            const fileNameElement = document.getElementById('file-name');
            fileNameElement.textContent = file.name;
            fileNameElement.style.display = 'block';
            
            if(file.type.startsWith('image/')) {
                // Handle image file
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('image-preview');
                    const videoPreview = document.getElementById('video-preview');
                    
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    videoPreview.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } 
            else if(file.type.startsWith('video/')) {
                // Handle video file
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('image-preview');
                    const videoPreview = document.getElementById('video-preview');
                    
                    videoPreview.src = e.target.result;
                    videoPreview.style.display = 'block';
                    imagePreview.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    }
    
    // Form validation before submit
    document.getElementById('memeForm').addEventListener('submit', function(e) {
        const type = document.getElementById('type').value;
        const source = document.getElementById('source').value;
        let hasError = false;
        
        // Reset error messages
        document.querySelectorAll('.alert-danger').forEach(el => {
            el.style.display = 'none';
            el.textContent = '';
        });
        
        if(!type) {
            const typeError = document.getElementById('type-error');
            typeError.textContent = 'Please select a meme type.';
            typeError.style.display = 'block';
            hasError = true;
        }
        
        if(!source) {
            const sourceError = document.getElementById('source-error');
            sourceError.textContent = 'Please select a content source.';
            sourceError.style.display = 'block';
            hasError = true;
        }
        
        if(source === 'upload') {
            const fileInput = document.getElementById('content');
            if(!fileInput.files || fileInput.files.length === 0) {
                const contentError = document.getElementById('content-error');
                contentError.textContent = 'Please select a file to upload.';
                contentError.style.display = 'block';
                hasError = true;
            }
        }
        
        if(source === 'instagram' || source === 'tiktok') {
            const urlInput = document.getElementById('content_url');
            if(!urlInput.value) {
                const urlError = document.getElementById('content_url-error');
                urlError.textContent = 'Please enter a valid URL.';
                urlError.style.display = 'block';
                hasError = true;
            }
        }
        
        if(hasError) {
            e.preventDefault();
        }
    });
    </script>
</body>
</html>
