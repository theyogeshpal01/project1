// Theme Toggle
const themeToggle = document.getElementById('theme-toggle');
const body = document.body;
const icon = themeToggle.querySelector('i');

// Check for saved theme
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    body.setAttribute('data-theme', savedTheme);
    if (savedTheme === 'dark') {
        icon.classList.replace('fa-moon', 'fa-sun');
    }
}

themeToggle.addEventListener('click', () => {
    if (body.getAttribute('data-theme') === 'dark') {
        body.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
        icon.classList.replace('fa-sun', 'fa-moon');
    } else {
        body.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        icon.classList.replace('fa-moon', 'fa-sun');
    }
});

// Header scroll effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        const menuIcon = mobileMenuBtn.querySelector('i');
        if (navLinks.classList.contains('active')) {
            menuIcon.classList.replace('fa-bars', 'fa-times');
        } else {
            menuIcon.classList.replace('fa-times', 'fa-bars');
        }
    });
}

// Close mobile menu when a link is clicked
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('active');
        const menuIcon = mobileMenuBtn.querySelector('i');
        if (menuIcon) menuIcon.classList.replace('fa-times', 'fa-bars');
    });
});

// File Upload Logic
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('file-input');
const fileList = document.getElementById('file-list');
const uploadForm = document.getElementById('upload-form');

if (dropZone && fileInput) {
    // Click to select
    dropZone.addEventListener('click', () => fileInput.click());

    // Drag and drop handlers
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('dragover');
            dropZone.classList.add('drag-over'); // for compatibility with index.php
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('dragover');
            dropZone.classList.remove('drag-over');
        }, false);
    });

    dropZone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        updateFileList(files);
    }, false);

    fileInput.addEventListener('change', function() {
        updateFileList(this.files);
    });

    function updateFileList(files) {
        if (!fileList) return;
        fileList.innerHTML = '';
        
        if (files.length > 0) {
            // Style the drop zone to show files are selected
            dropZone.style.borderColor = 'var(--primary-color)';
            
            Array.from(files).forEach((file, index) => {
                if (file.type === 'application/pdf') {
                    const item = document.createElement('div');
                    item.className = 'file-entry file-item'; // compatibility for both pages
                    item.style.display = 'flex';
                    item.style.alignItems = 'center';
                    item.style.justifyContent = 'space-between';
                    item.style.gap = '15px';
                    item.style.padding = '12px 15px';
                    item.style.background = 'var(--bg-color)';
                    item.style.borderRadius = '8px';
                    item.style.marginBottom = '10px';
                    item.style.border = '1px solid var(--glass-border)';
                    item.style.borderLeft = '4px solid var(--primary-color)';
                    
                    item.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-file-pdf" style="color: #e74c3c;"></i>
                            <span style="font-weight: 600; font-size: 0.9rem; color: var(--text-color);">${file.name}</span>
                        </div>
                        <small style="color: var(--text-light);">${(file.size / 1024).toFixed(1)} KB</small>
                    `;
                    fileList.appendChild(item);
                } else {
                    alert(`${file.name} is not a PDF file.`);
                }
            });
        }
    }
}

// Global Form Submit Handler for Processing Overlay
if (uploadForm) {
    uploadForm.addEventListener('submit', function(e) {
        const overlay = document.getElementById('processing-overlay');
        const statusText = document.getElementById('status-text');
        const progressFill = document.getElementById('progress-fill');
        
        if (overlay) {
            overlay.style.display = 'flex';
            
            const statuses = [
                'Initializing Secure Parser...',
                'Reading PDF Binary Data...',
                'Analyzing Contract Structure...',
                'Extracting Organisation Details...',
                'Identifying Financial Approvals...',
                'Parsing Service Provider Info...',
                'Generating Professional Sheets...',
                'Finalizing Excel Workbook...'
            ];
            
            let i = 0;
            const interval = setInterval(() => {
                if (i < statuses.length) {
                    if (statusText) statusText.textContent = statuses[i];
                    if (progressFill) progressFill.style.width = ((i + 1) / statuses.length * 100) + '%';
                    i++;
                } else {
                    clearInterval(interval);
                }
            }, 800);
        }
    });
}

// Smooth scroll for nav links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            window.scrollTo({
                top: target.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});
