

<div {{ $attributes->merge(['class' => 'file-upload-component table-component flex']) }} 
    data-name="{{ $name }}" 
    data-show-preview="{{ $showPreview? 'true' : 'false'}}" 
    data-multiple="{{ $multiple ? 'true' : 'false' }}" 
    data-accepted-types="{{ $acceptedTypes }}">
   <form action="{{ $action }}" method="post" enctype="multipart/form-data">
       @csrf

       <!-- Hidden input for file upload -->
       <input type="file" id="file-input-{{ $name }}" name="{{ $name }}[]" {{ $multiple ? 'multiple' : '' }} style="display: none;" accept="{{ $acceptedTypes }}">

       <!-- Custom file input label -->
       <label for="file-input-{{ $name }}" class="file-input-label" id="file-input-label-{{ $name }}">Upload File</label>

       <!-- File drop area -->
       <div class="file-drop-area" id="file-drop-area-{{ $name }}">
        <svg width="71" height="102" viewBox="0 0 71 102" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M71 99.4426C71 100.547 70.1046 101.443 69 101.443L2.00001 101.443C0.895439 101.443 7.5944e-06 100.547 7.55124e-06 99.4426L3.74329e-06 1.99994C3.70013e-06 0.895374 0.895434 -5.49064e-05 2 -5.5003e-05L50.9933 -5.92861e-05L71 14.6818L71 99.4426Z" fill="#C7C7C7"/>
            <path d="M51.352 16.9072L51.352 0.00011399L70.7128 14.5219L51.352 16.9072Z" fill="#E9E2E2"/>
            </svg>

           <p class="caption-text">Drag & drop files here or click to select files</p>

           <!-- Footer displaying accepted file types and size -->
           <div class="file-drop-footer">
               <p class="caption-text">{{ $acceptedTypes }}</p>
               <p class="caption-text">Max file size: 10MB</p>
           </div>
       </div>

    

       <!-- Custom upload button -->
       <button type="submit" class="btn">Upload Files</button>
   </form>
      <!-- File preview and upload area -->
      <div class="file-upload-content">
        <div class="file-preview">
            <table>
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="file-preview-body">
                    <!-- Files will be displayed here -->
                </tbody>
            </table>
        </div>

        <!-- Upload progress bar -->
        <div class="upload-progress">
            <!-- Upload progress will be displayed here -->
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
 
// FileUploadComponent class definition
class FileUploadComponent {
    constructor(element) {
        if (!element) {
            console.error('FileUploadComponent: Element not found. Make sure to provide a valid element.');
            return;
        }

        this.element = element;
        this.name = element.dataset.name;
        this.showPreview = element.dataset.showPreview === 'true';
        this.multiple = element.dataset.multiple === 'true';
        this.acceptedTypes = element.dataset.acceptedTypes || '';
        this.fileInput = this.element.querySelector('input[type="file"]');
        this.fileDropArea = this.element.querySelector('.file-drop-area');
        this.filePreview = this.element.querySelector('.file-preview-body');
        this.fileDropFooter = this.element.querySelector('.file-drop-footer');

        if (!this.fileInput || !this.fileDropArea || !this.filePreview || !this.fileDropFooter) {
            console.error('FileUploadComponent: Required elements not found. Make sure your HTML structure is correct.');
            return;
        }

        // Add a class to the main element
        this.element.classList.add('file-upload-component-initialized');

        // Bind event handlers
        this.fileInput.addEventListener('change', this.handleFiles.bind(this));
        this.fileDropArea.addEventListener('drop', this.handleDrop.bind(this));
        this.fileDropArea.addEventListener('dragover', this.handleDragOver.bind(this));
        this.fileDropArea.addEventListener('click', () => {
            this.fileInput.click();
        });

        // Display accepted file types and size
        this.fileDropFooter.innerHTML = `
            <p>Accepted types: ${this.acceptedTypes}</p>
            <p>Max file size: 10MB</p>
        `;

        console.log('FileUploadComponent initialized:', this.name, this.showPreview, this.multiple, this.acceptedTypes);

        // Initial placeholder if no files are selected
        if (this.showPreview) {
            this.displayPlaceholder();
        }
    }

    handleFiles(event) {
        const files = event.target.files;
        console.log('Files selected:', files);
        if (this.showPreview) {
            this.clearFilePreview();
            if (files.length > 0) {
                this.displayFiles(files);
            } else {
                this.displayPlaceholder();
            }
        }
    }

    handleDrop(event) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        console.log('Files dropped:', files);
        this.addFilesToInput(files);
        if (this.showPreview) {
            this.clearFilePreview();
            if (files.length > 0) {
                this.displayFiles(files);
            } else {
                this.displayPlaceholder();
            }
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
        for (let file of files) {
            this.displayFile(file);
        }
    }

    displayFile(file) {
        const fileElement = document.createElement('tr');
        const fileNameCell = document.createElement('td');
        const actionCell = document.createElement('td');
        const removeButton = document.createElement('span');

        fileNameCell.textContent = file.name;
        removeButton.textContent = 'Remove';
        removeButton.classList.add('remove-file');
        removeButton.addEventListener('click', () => {
            fileElement.remove();
            this.removeFile(file);
        });

        actionCell.appendChild(removeButton);
        fileElement.appendChild(fileNameCell);
        fileElement.appendChild(actionCell);

        this.filePreview.appendChild(fileElement);
    }

    displayPlaceholder() {
        const placeholderElement = document.createElement('tr');
        const placeholderCell = document.createElement('td');

        placeholderCell.textContent = 'No files selected';
        placeholderCell.colSpan = 2; // Merges the cell into both columns
        placeholderElement.appendChild(placeholderCell);

        this.filePreview.appendChild(placeholderElement);
    }

    removeFile(file) {
        // Remove the file from the input
        const updatedFiles = Array.from(this.fileInput.files).filter(f => f !== file);
        const dataTransfer = new DataTransfer();
        updatedFiles.forEach(f => dataTransfer.items.add(f));
        this.fileInput.files = dataTransfer.files;
    }

    clearFilePreview() {
        // Clear existing file preview
        while (this.filePreview.firstChild) {
            this.filePreview.removeChild(this.filePreview.firstChild);
        }
    }
}

// Instantiate FileUploadComponent when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    const fileUploadComponentElement = document.querySelector('.file-upload-component');
    if (fileUploadComponentElement) {
        const fileUploadComponent = new FileUploadComponent(fileUploadComponentElement);
    } else {
        console.error('FileUploadComponent: Element with class "file-upload-component" not found.');
    }
});

</script>
@endpush
@endonce


@once
@push('styles')
<style>
     .table-header {
         background-color: rgba(234, 238, 242, 0.5); /* Header background color */
        border: 1px solid rgb(216, 222, 228); /* Border color */

    }
    /* Container styles */
    .file-upload-component {
        border: 1px solid #ccc;
        padding: 1rem;
        border-radius: 5px;
        width: 100%;
        max-width: 400px; /* Adjust max-width as needed */
        margin: auto;
    }

    /* Upload button */
    .upload-button {
        padding: 0.5rem 1rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f8f8;
        cursor: pointer;
        display: block;
        margin: 1rem auto;
    }

    /* File drop area */
    .file-drop-area {
        cursor: pointer;
        border: 2px dashed #ccc;
        padding: 1rem;
        border-radius: 5px;
        text-align: center;
        margin-top: 1rem;
        position: relative;
    }

    /* File drop area icon */
    .file-drop-area svg {
        width: 80px;
        height: 60px;
        margin: 0 auto;
        display: block;
    }

    /* File drop area caption */
    .caption-text {
        margin-top: 0.5rem;
        color: #777;
    }

    /* File drop area footer */
    .file-drop-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f8f8;
        border-top: 1px solid #ccc;
        padding: 0.5rem;
        border-radius: 0 0 5px 5px;
        text-align: center;
    }

    /* File preview section */
    .file-upload-content {
        margin-top: 1rem;
    }

    /* File preview table */
    .file-preview table {
        width: 100%;
        border-collapse: collapse;
    }

    .file-preview th,
    .file-preview td {
        padding: 0.5rem;
        border: 1px solid #ccc;
        text-align: left;
    }

    /* Remove file button */
    .remove-file {
        cursor: pointer;
        color: red;
        text-decoration: underline;
    }

    /* Upload progress bar */
    .upload-progress {
        margin-top: 1rem;
    }

    .progress-bar {
        width: 0;
        height: 1rem;
        background-color: #5cb85c;
        border-radius: 5px;
    }

    /* Responsive design */
    @media (max-width: 600px) {
        .file-upload-component {
            max-width: 100%;
        }
    }
</style>
@endpush
@endonce
