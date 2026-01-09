<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Footer Widget</title>
    <style>
        :root {
            --primary-color: #ffcc00;
            --text-color: #333;
            --light-gray: #f5f5f5;
            --border-color: #ddd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: var(--text-color);
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .admin-panel {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .admin-panel h2 {
            margin-bottom: 20px;
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 16px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .social-icons-container {
            margin-top: 20px;
        }

        .social-icon-item {
            background-color: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
        }

        .icon-preview {
            width: 30px;
            height: 30px;
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #e6b800;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
        }

        .footer-preview {
            background-color: #222;
            color: white;
            padding: 40px 0;
            border-radius: 10px;
        }

        .tp-footer-widget {
            max-width: 400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .tp-footer-logo {
            margin-bottom: 40px;
        }

        .tp-footer-logo img {
            max-width: 108px;
        }

        .tp-footer-dec {
            margin-bottom: 15px;
            color: #aaa;
        }

        .tp-footer-subscribe {
            position: relative;
            margin-bottom: 30px;
        }

        .tp-input {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
        }

        .tp-footer-subscribe button {
            position: absolute;
            right: 5px;
            top: 5px;
            bottom: 5px;
            padding: 0 15px;
            background-color: var(--primary-color);
            color: #222;
            border: none;
            border-radius: 3px;
            font-weight: 600;
            cursor: pointer;
        }

        .tp-footer-social {
            display: flex;
            gap: 15px;
        }

        .tp-footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #333;
            color: white;
            transition: all 0.3s ease;
        }

        .tp-footer-social a:hover {
            background-color: var(--primary-color);
            color: #222;
        }

        .tp-footer-social svg {
            width: 18px;
            height: 18px;
        }

        .upload-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .upload-btn {
            background-color: #f0f0f0;
            border: 1px solid var(--border-color);
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .upload-btn:hover {
            background-color: #e0e0e0;
        }

        .preview-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="admin-panel">
            <h2>Footer Widget Settings</h2>

            <div class="form-group">
                <label for="logo-upload">Logo Upload</label>
                <div class="upload-container">
                    <input type="file" id="logo-upload" class="hidden" accept="image/*">
                    <button class="upload-btn" id="logo-upload-btn">Choose Logo</button>
                    <span id="logo-file-name">No file chosen</span>
                </div>
                <div id="logo-preview-container"></div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" placeholder="Enter footer description">Subscribe for our Newsletter</textarea>
            </div>

            <div class="social-icons-container">
                <label>Social Icons</label>
                <div id="social-icons-list">
                    <!-- Social icons will be added here dynamically -->
                </div>
                <button id="add-social-icon" class="btn btn-secondary">Add Social Icon</button>
            </div>

            <div class="form-group" style="margin-top: 30px;">
                <button id="save-footer" class="btn btn-primary">Save Footer Settings</button>
            </div>
        </div>

        <div class="footer-preview">
            <div class="tp-footer-widget mb-40 mr-70 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
                <div class="tp-footer-logo mb-40">
                    <a href="index.html"><img id="preview-logo" data-width="108" src="assets/img/logo/logo-yellow.png" alt=""></a>
                </div>
                <p id="preview-description" class="tp-footer-dec mb-15">Subscribe for our Newsletter</p>
                <div class="tp-footer-subscribe p-relative mb-30">
                    <form action="#">
                        <input class="tp-input" type="text" placeholder="Email address...">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
                <div id="preview-social-icons" class="tp-footer-social">
                    <!-- Social icons will be previewed here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logo upload functionality
            const logoUpload = document.getElementById('logo-upload');
            const logoUploadBtn = document.getElementById('logo-upload-btn');
            const logoFileName = document.getElementById('logo-file-name');
            const logoPreviewContainer = document.getElementById('logo-preview-container');
            const previewLogo = document.getElementById('preview-logo');

            logoUploadBtn.addEventListener('click', function() {
                logoUpload.click();
            });

            logoUpload.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const fileName = this.files[0].name;
                    logoFileName.textContent = fileName;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Clear previous preview
                        logoPreviewContainer.innerHTML = '';

                        // Create new preview
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'preview-image';
                        logoPreviewContainer.appendChild(img);

                        // Update preview in footer
                        previewLogo.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Description update
            const descriptionInput = document.getElementById('description');
            const previewDescription = document.getElementById('preview-description');

            descriptionInput.addEventListener('input', function() {
                previewDescription.textContent = this.value;
            });

            // Social icons functionality
            const socialIconsList = document.getElementById('social-icons-list');
            const addSocialIconBtn = document.getElementById('add-social-icon');
            const previewSocialIcons = document.getElementById('preview-social-icons');

            let socialIconCount = 0;

            // Function to add a new social icon form
            function addSocialIconForm(iconData = {}) {
                const id = socialIconCount++;
                const iconItem = document.createElement('div');
                iconItem.className = 'social-icon-item';
                iconItem.innerHTML = `
                    <div class="form-group">
                        <label>Icon Upload</label>
                        <div class="upload-container">
                            <input type="file" class="icon-upload hidden" accept="image/svg+xml, image/png, image/jpeg">
                            <button class="upload-btn icon-upload-btn">Choose Icon</button>
                            <span class="icon-file-name">${iconData.fileName || 'No file chosen'}</span>
                        </div>
                        <div class="icon-preview-container"></div>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control icon-url" placeholder="https://example.com" value="${iconData.url || ''}">
                    </div>
                    <button class="btn btn-danger btn-sm remove-icon">Remove</button>
                `;

                socialIconsList.appendChild(iconItem);

                // Set up event listeners for the new icon form
                const iconUpload = iconItem.querySelector('.icon-upload');
                const iconUploadBtn = iconItem.querySelector('.icon-upload-btn');
                const iconFileName = iconItem.querySelector('.icon-file-name');
                const iconPreviewContainer = iconItem.querySelector('.icon-preview-container');
                const iconUrlInput = iconItem.querySelector('.icon-url');
                const removeBtn = iconItem.querySelector('.remove-icon');

                iconUploadBtn.addEventListener('click', function() {
                    iconUpload.click();
                });

                iconUpload.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const fileName = this.files[0].name;
                        iconFileName.textContent = fileName;

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Clear previous preview
                            iconPreviewContainer.innerHTML = '';

                            // Create new preview
                            const iconPreview = document.createElement('div');
                            iconPreview.className = 'icon-preview';

                            if (fileName.endsWith('.svg')) {
                                // For SVG files, we can display the content directly
                                iconPreview.innerHTML = e.target.result;
                            } else {
                                // For other image types, create an img element
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.maxWidth = '100%';
                                img.style.maxHeight = '100%';
                                iconPreview.appendChild(img);
                            }

                            iconPreviewContainer.appendChild(iconPreview);
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                // If we have initial data, set up the preview
                if (iconData.preview) {
                    iconPreviewContainer.innerHTML = iconData.preview;
                }

                iconUrlInput.addEventListener('input', updateSocialIconsPreview);

                removeBtn.addEventListener('click', function() {
                    iconItem.remove();
                    updateSocialIconsPreview();
                });

                updateSocialIconsPreview();
            }

            // Function to update the social icons preview
            function updateSocialIconsPreview() {
                previewSocialIcons.innerHTML = '';

                const iconItems = document.querySelectorAll('.social-icon-item');
                iconItems.forEach(item => {
                    const iconPreviewContainer = item.querySelector('.icon-preview-container');
                    const iconUrl = item.querySelector('.icon-url').value;

                    if (iconPreviewContainer.innerHTML.trim() !== '') {
                        const link = document.createElement('a');
                        link.href = iconUrl || '#';
                        link.target = '_blank';
                        link.innerHTML = iconPreviewContainer.innerHTML;
                        previewSocialIcons.appendChild(link);
                    }
                });
            }

            // Add initial social icon form
            addSocialIconForm();

            // Add new social icon when button is clicked
            addSocialIconBtn.addEventListener('click', function() {
                addSocialIconForm();
            });

            // Save footer settings
            document.getElementById('save-footer').addEventListener('click', function() {
                // In a real application, you would send this data to a server
                // For this demo, we'll just show an alert
                alert('Footer settings saved successfully!');

                // Collect all data
                const footerData = {
                    logo: previewLogo.src,
                    description: descriptionInput.value,
                    socialIcons: []
                };

                const iconItems = document.querySelectorAll('.social-icon-item');
                iconItems.forEach(item => {
                    const iconPreviewContainer = item.querySelector('.icon-preview-container');
                    const iconUrl = item.querySelector('.icon-url').value;

                    if (iconPreviewContainer.innerHTML.trim() !== '') {
                        footerData.socialIcons.push({
                            icon: iconPreviewContainer.innerHTML,
                            url: iconUrl
                        });
                    }
                });

                console.log('Footer data to save:', footerData);
            });
        });
    </script>
</body>

</html>