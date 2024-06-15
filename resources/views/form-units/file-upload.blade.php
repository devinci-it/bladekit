<div {{ $attributes->merge(['class' => 'file-upload-component grid']) }} data-name="{{ $name }}"
    data-show-preview="{{ $showPreview ? 'true' : 'false' }}" data-multiple="{{ $multiple ? 'true' : 'false' }}"
    data-accepted-types="{{ $acceptedTypes }}" data-max-size="{{ $maxSize }}">

    <form style="paddi"action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="file" id="file-input-{{ $name }}" name="{{ $name }}[]"
            {{ $multiple ? 'multiple' : '' }} style="display: none;" accept="{{ $acceptedTypes }}">

        <div class="file-drop-area" id="file-drop-area-{{ $name }}">
            @bladekitAsset('upload')

            {{-- @bladekitSVG('upload', 50, '#6c757d') --}}
            <p class="caption-text" style="padding-top: 20px; font-size:.8rem;">Drag & drop or click to select files</p>
        </div>

        <div class="selected-files" id="selected-files-{{ $name }}">
            <ul id="file-list-{{ $name }}"></ul>
        </div>

        <div class="file-footer" id="file-footer-{{ $name }}">
            <p class="footer-text"></p>
        </div>

        <button type="submit" class="btn" style="display: none;">Upload</button>
    </form>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                class FileUploadComponent {
                    constructor(element) {
                        this.element = element;
                        this.name = element.dataset.name;
                        this.showPreview = element.dataset.showPreview === 'true';
                        this.multiple = element.dataset.multiple === 'true';
                        this.acceptedTypes = element.dataset.acceptedTypes || '';
                        this.maxSize = element.dataset.maxSize || '';
                        this.fileInput = element.querySelector('input[type="file"]');
                        this.fileDropArea = element.querySelector('.file-drop-area');
                        this.fileList = element.querySelector(`#file-list-${this.name}`);
                        this.fileFooter = element.querySelector(`#file-footer-${this.name} .footer-text`);

                        this.fileInput.addEventListener('change', this.handleFiles.bind(this));
                        this.fileDropArea.addEventListener('drop', this.handleDrop.bind(this));
                        this.fileDropArea.addEventListener('dragover', this.handleDragOver.bind(this));
                        this.fileDropArea.addEventListener('click', () => this.fileInput.click());

                        this.fileList.addEventListener('click', this.handleFileClick.bind(this));

                        this.updateFooter();
                    }

                    handleFiles(event) {
                        const files = event.target.files;
                        this.displayFiles(files);
                    }

                    handleDrop(event) {
                        event.preventDefault();
                        const files = event.dataTransfer.files;
                        this.fileInput.files = files;
                        this.displayFiles(files);
                    }

                    handleDragOver(event) {
                        event.preventDefault();
                    }
                    displayFiles(files) {
    Array.from(files).forEach(file => {
        const listItem = document.createElement('li');
        listItem.classList.add('file-list-item');
        listItem.dataset.fileName = file.name;

        let icon;
        if (file.type.startsWith('image/')) {
            icon = '@bladekitIcon('image.svg')';
        } else if (file.type.startsWith('audio/')) {
            icon = '@bladekitIcon('audio.svg')';
        } else if (file.type.startsWith('video/')) {
            icon = '@bladekitIcon('video.svg')';
        } else {
            icon = '@bladekitIcon('file.svg')';
        }
        const trashIcon = '@bladekitAsset("del")';


        listItem.innerHTML = `
            <div class="file-info" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="file-icon">${icon}</div>
                    <span class="file-name">${file.name}</span>
                    <span class="file-size">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                </div>
            </div>
        <button class="remove-file-btn btn">${trashIcon}</button>

        `;
        
        this.fileList.appendChild(listItem);

        // Add event listener to the "Remove" button
        const removeButton = listItem.querySelector('.remove-file-btn');
        removeButton.addEventListener('click', () => this.removeFile(file.name));
    });
}

                    handleFileClick(event) {
                        const fileListItem = event.target.closest('.file-list-item');
                        if (fileListItem) {
                            const fileName = fileListItem.dataset.fileName;
                            const confirmDelete = confirm(`Remove file ${fileName}?`);
                            if (confirmDelete) {
                                this.removeFile(fileName);
                            }
                        }
                    }




                    removeFile(fileName) {
                        const listItem = this.fileList.querySelector(`[data-file-name="${fileName}"]`);
                        if (listItem) {
                            this.fileList.removeChild(listItem);
                        }
                    }

                    updateFooter() {
                        let footerText = 'Accepted file types: ';
                        if (this.acceptedTypes) {
                            footerText += this.acceptedTypes.split(',').map(type => type.trim()).join(', ');
                        } else {
                            footerText += 'All types';
                        }
                        if (this.maxSize) {
                            footerText += ` | Max size: ${this.maxSize} MB`;
                        }
                        this.fileFooter.textContent = footerText;
                    }
                }

                const fileUploadComponentElements = document.querySelectorAll('.file-upload-component');
                fileUploadComponentElements.forEach(element => new FileUploadComponent(element));
            });
        </script>
    @endpush
@endonce

@once
    @push('styles')
        <style>
            .file-upload-component {
                display: grid;
                grid-template-rows: 2fr 3fr 1fr;
                gap: 10px;
                padding: 20px;
                border: 1px solid #e1e4e8;
                border-radius: 12px;
                background-color: #f9f9f9;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin: 20px auto;
                max-width: 600px;
                font-family: 'Arial', sans-serif;
            }

            .file-drop-area {
                width: 100%;
                border: 2px dashed #6c757d1e;
                border-radius: 8px;
                text-align: center;
                /* padding: 30px; */
                transition: background-color 0.3s ease;
                cursor: pointer;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                aspect-ratio: 2;
                margin: 20px 0;
            }

            .file-drop-area:hover {
                background-color: #e9ecef;
            }

            .file-drop-area svg {
                margin-bottom: 10px;
                color: #6c757d;
            }

            .caption-text {
                color: #6c757d;
                font-size: 16px;
                margin: 0;
            }



            .btn:hover {
                background-color: #0056b3;
            }

            .selected-files {
                width: 100%;
                overflow-y: auto;
            }

            .selected-files ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .file-list-item {
                display: flex;
                align-items: center;
                padding: 10px;
                border: 1px solid #e1e4e8;
                border-radius: 8px;
                margin-bottom: 10px;
                background-color: #ffffff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                cursor: pointer;
            }

            .file-icon {
                margin-right: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 4px;
                background-color: #f1f3f5;
            }

            .file-info {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .file-name {
                font-size: 14px;
                font-weight: 500;
                color: #343a40;
            }

            .file-size {
                font-size: 12px;
                color: #6c757d;
            }

            .file-footer {
                width: 100%;
                text-align: center;
            }

            .footer-text {
                font-size: 14px;
                color: #6c757d;
            }

            @media (max-width: 768px) {
                .file-upload-component {
                    padding: 15px;
                    margin: 10px;
                }

                .btn {
                    padding: 10px 15px;
                    font-size: 14px;
                }

                .file-list-item {
                    padding: 8px;
                }

                .file-icon {
                    width: 30px;
                    height: 30px;
                }

                .file-name {
                    font-size: 12px;
                }

                .file-size {
                    font-size: 10px;
                }

                .footer-text {
                    font-size: 12px;
                }
            }
        </style>
    @endpush
@endonce
