<?php
// Direct PHP form without Blade templating
session_start();
?>
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
        body {
            background-color: #f5f8fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            background-color: #fff;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .card-body {
            padding: 25px;
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 15px;
        }
        .form-text {
            color: #6c757d;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 5px;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 5px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create New Meme
            </div>
            <div class="card-body">
                <form method="POST" action="/memes" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo isset($_SESSION['_token']) ? $_SESSION['_token'] : ''; ?>">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Meme Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">-- Select Type --</option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="source" class="form-label">Content Source</label>
                        <select class="form-select" id="source" name="source" required>
                            <option value="">-- Select Source --</option>
                            <option value="upload">Upload File</option>
                            <option value="instagram">Instagram Link</option>
                            <option value="tiktok">TikTok Link</option>
                        </select>
                    </div>

                    <div class="mb-3" id="upload-section" style="display: none;">
                        <label for="content" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="content" name="content">
                        <div class="form-text">Supported formats: JPEG, PNG, GIF, MP4, MOV (Max: 10MB)</div>
                    </div>

                    <div class="mb-3" id="url-section" style="display: none;">
                        <label for="content_url" class="form-label">Content URL</label>
                        <input type="url" class="form-control" id="content_url" name="content_url">
                        <div class="form-text">Paste the Instagram or TikTok post URL</div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Meme
                        </button>
                        <a href="/" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sourceSelect = document.getElementById('source');
        const uploadSection = document.getElementById('upload-section');
        const urlSection = document.getElementById('url-section');
        
        function updateSections() {
            if (sourceSelect.value === 'upload') {
                uploadSection.style.display = 'block';
                urlSection.style.display = 'none';
            } else if (sourceSelect.value === 'instagram' || sourceSelect.value === 'tiktok') {
                uploadSection.style.display = 'none';
                urlSection.style.display = 'block';
            } else {
                uploadSection.style.display = 'none';
                urlSection.style.display = 'none';
            }
        }
        
        sourceSelect.addEventListener('change', updateSections);
        
        // Initialize on page load
        updateSections();
    });
    </script>
</body>
</html> 