<?php 
$pageTitle = "Upload PDF Contracts | LASA Consultants & Organisation";
$pageDesc = "Upload multiple PDF contracts and convert them into separate Excel files automatically.";

ob_start();
?>
    <style>
        /* Hero Section */
        .upload-hero {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #1c2a4d 100%);
            padding: 100px 0 80px;
            text-align: center;
            color: white;
            position: relative;
        }

        .upload-hero h1 {
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .upload-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* Upload Section */
        .upload-container {
            padding: 80px 0;
            background: var(--bg-color);
        }

        .upload-card {
            background: var(--card-bg);
            max-width: 800px;
            margin: -60px auto 60px;
            padding: 50px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 10;
            border: 1px solid var(--glass-border);
        }

        .drop-zone {
            border: 2px dashed var(--primary-color);
            border-radius: 15px;
            padding: 60px 40px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            background: var(--bg-color);
        }

        .drop-zone:hover, .drop-zone.dragover {
            border-color: var(--primary-color);
            background: rgba(184, 134, 11, 0.05);
        }

        .upload-icon {
            font-size: 4rem;
            color: var(--primary-light);
            margin-bottom: 25px;
            display: block;
            background: rgba(184, 134, 11, 0.1);
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 50%;
            margin-left: auto;
            margin-right: auto;
        }

        .drop-zone h3 {
            font-size: 1.8rem;
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .drop-zone p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .drop-zone .highlight {
            color: var(--primary-color);
            font-weight: 700;
            text-decoration: underline;
        }

        .drop-zone .meta {
            font-size: 0.85rem;
            opacity: 0.6;
            margin-top: 15px;
        }

        .btn-convert-wrap {
            text-align: center;
            margin-top: 30px;
        }

        .btn-convert {
            background: var(--primary-color);
            color: white;
            padding: 15px 50px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-convert:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        /* Features Section */
        .features-strip {
            background: var(--card-bg);
            padding: 30px 0;
            border-radius: 10px;
            margin-bottom: 60px;
            border: 1px solid var(--glass-border);
        }

        .features-strip h4 {
            text-align: center;
            color: var(--text-color);
            margin-bottom: 25px;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 0 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            color: var(--text-color);
            font-weight: 500;
        }

        .feature-item i {
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        #file-list {
            margin-top: 20px;
            text-align: left;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .file-entry {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background: var(--bg-color);
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid var(--glass-border);
            border-left: 4px solid var(--primary-color);
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            .upload-card {
                padding: 30px 20px;
                margin: -40px 20px 40px;
            }
        }

        /* Processing Overlay Styles */
        #processing-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(11, 19, 43, 0.9);
            z-index: 9999;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            backdrop-filter: blur(10px);
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.1); opacity: 0.7; } 100% { transform: scale(1); opacity: 1; } }
    </style>
<?php 
$extraStyles = ob_get_clean();

ob_start();
?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('file-input');
            const fileList = document.getElementById('file-list');
            const form = document.getElementById('upload-form');

            // Click to upload
            dropZone.addEventListener('click', () => fileInput.click());

            // Drag and drop handlers
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults (e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('dragover');
            }

            function unhighlight(e) {
                dropZone.classList.remove('dragover');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                updateFileList(files);
            }

            fileInput.addEventListener('change', function() {
                updateFileList(this.files);
            });

            function updateFileList(files) {
                fileList.innerHTML = '';
                if (files.length > 0) {
                    Array.from(files).forEach(file => {
                        const div = document.createElement('div');
                        div.className = 'file-entry';
                        div.innerHTML = `
                            <span><i class="far fa-file-pdf"></i> ${file.name}</span>
                            <small>${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                        `;
                        fileList.appendChild(div);
                    });
                }
            }
        });
    </script>
<?php 
$extraScripts = ob_get_clean();

include 'header.php'; 
?>

    <!-- Upload Hero Section -->
    <section class="upload-hero">
        <div class="container">
            <h1>Upload PDF Contracts</h1>
            <p>Multiple PDFs upload karo — har PDF ka alag Excel generate hoga</p>
        </div>
    </section>

    <!-- Main Upload Section -->
    <section class="upload-container">
        <div class="container">
            
            <!-- Upload Card -->
            <div class="upload-card">
                <form action="process-upload.php" method="POST" enctype="multipart/form-data" id="upload-form">
                    <div class="drop-zone" id="drop-zone">
                        <span class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></span>
                        <h3>PDF Files Select Karo</h3>
                        <p>Drag & drop karo ya <span class="highlight">click karo</span></p>
                        <p class="meta">Multiple PDFs select kar sakte ho • Max 10MB each</p>
                        <input type="file" name="pdfs[]" id="file-input" multiple accept=".pdf" style="display: none;">
                    </div>
                    
                    <div id="file-list"></div>

                    <div class="btn-convert-wrap">
                        <button type="submit" class="btn-convert">Convert to Excel</button>
                    </div>
                </form>
            </div>

            <!-- Features Strip -->
            <div class="features-strip">
                <h4>Why Choose Our Platform?</h4>
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Fast and accurate data extraction</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Har PDF ka alag Excel file generate hoga</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Multiple PDFs — ZIP mein download</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php include 'footer.php'; ?>
