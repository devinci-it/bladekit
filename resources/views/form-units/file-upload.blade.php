<!-- resources/views/components/file-upload.blade.php -->

<div {{ $attributes->merge(['class' => 'file-upload-component']) }} data-name="{{ $name }}" data-show-preview="{{ $showPreview }}">
    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" id="file-input-{{ $name }}" name="{{ $name }}[]" multiple>

        <div class="file-drop-area" id="file-drop-area-{{ $name }}">
            <svg width="147" height="125" viewBox="0 0 147 125" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.376953" y="1.96289" width="146.038" height="119.582" rx="6" fill="#CCCCCC" fill-opacity="0.752941"/>
                <path d="M0 4C0 1.79086 1.79086 0 4 0L34.5856 0C35.4461 0 36.2837 0.277535 36.974 0.791396L61.1824 18.8121C61.8727 19.326 62.7104 19.6035 63.5709 19.6035L142.038 19.6035C144.247 19.6035 146.038 17.8127 146.038 15.6035V0V120.54C146.038 122.749 144.247 124.54 142.038 124.54L4 124.54C1.79086 124.54 0 122.749 0 120.54L0 4Z" fill="#24292F"/>
                <path d="M70.5303 90V55H76.4697V90H70.5303ZM56 75.4697V69.5303H91V75.4697H56Z" fill="#D9D9D9"/>
                </svg>

            <p class="caption-text">Drag & drop files here or click to select files</p>
        </div>

        <div class="upload-progress">
            <!-- Upload progress will be displayed here -->
        </div>

        <button type="submit" class="upload-button">Upload Files</button>
    </form>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileUploadComponents = document.querySelectorAll('.file-upload-component');
                for (let component of fileUploadComponents) {
                    new FileUploadComponent(component);
                }
            });

            class FileUploadComponent {
                constructor(element) {
                    this.element = element;
                    this.name = element.dataset.name;
                    this.showPreview = element.dataset.showPreview === 'true';
                    this.fileInput = this.element.querySelector('input[type="file"]');
                    this.fileDropArea = this.element.querySelector('.file-drop-area');
                    this.filePreview = this.element.querySelector('.file-preview tbody');

                    // Bind event handlers
                    this.fileInput.addEventListener('change', this.handleFiles.bind(this));
                    this.fileDropArea.addEventListener('drop', this.handleDrop.bind(this));
                    this.fileDropArea.addEventListener('dragover', this.handleDragOver.bind(this));
                    this.fileDropArea.addEventListener('click', () => {
                        this.fileInput.click();
                    });
                }

                handleFiles(event) {
                    const files = event.target.files;
                    if (this.showPreview) {
                        this.displayFiles(files);
                    }
                }

                handleDrop(event) {
                    event.preventDefault();
                    const files = event.dataTransfer.files;
                    this.addFilesToInput(files);
                    if (this.showPreview) {
                        this.displayFiles(files);
                    }
                }

                handleDragOver(event) {
                    event.preventDefault();
                }

                addFilesToInput(files) {
                    const dataTransfer = new DataTransfer();
                    for (let file of files) {
                        dataTransfer.items.add(file);
                    }
                    this.fileInput.files = dataTransfer.files;
                }

                displayFiles(files) {
                    this.filePreview.innerHTML = '';
                    for (let file of files) {
                        const fileElement = document.createElement('tr');
                        const fileNameCell = document.createElement('td');
                        fileNameCell.textContent = file.name;
                        fileElement.appendChild(fileNameCell);
                        this.filePreview.appendChild(fileElement);
                    }
                }
            }
        </script>
    @endpush
@endonce

@push('styles')
    <style>
        .file-upload-component {
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 5px;
            position: relative;
            width: 100%;
            max-width: 300px;
            margin: auto;
        }

        .upload-button {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f8f8;
            cursor: pointer;
        }

        .file-drop-area {
            cursor: pointer;
            border: 1px dashed var(--border-color);
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
            margin-top: 1rem;
        }

        .file-preview {
            margin-top: 1rem;
        }

        .file-preview table {
            width: 100%;
            border-collapse: collapse;
        }

        .file-preview th, .file-preview td {
            padding: 0.5rem;
            border: 1px solid #ccc;
            text-align: left;
        }

        .remove-file {
            cursor: pointer;
            color: red;
        }

        .upload-progress {
            margin-top: 1rem;
        }

        .progress-bar {
            width: 0;
            height: 1rem;
            background-color: #5cb85c;
            border-radius: 5px;
        }
    </style>
@endpush
