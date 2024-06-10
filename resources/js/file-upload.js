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
    }

    handleFiles(event) {
        const files = event.target.files;
        console.log('Files selected:', files);
        if (this.showPreview) {
            this.displayFiles(files);
        }
    }

    handleDrop(event) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        console.log('Files dropped:', files);
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
        for (let file of files) {
            const fileElement = document.createElement('tr');
            const fileNameCell = document.createElement('td');
            const actionCell = document.createElement('td');
            const removeButton = document.createElement('span');

            fileNameCell.textContent = file.name;
            removeButton.textContent = 'Remove';
            removeButton.classList.add('remove-file');
            removeButton.addEventListener('click', () => {
                fileElement.remove();
            });

            actionCell.appendChild(removeButton);
            fileElement.appendChild(fileNameCell);
            fileElement.appendChild(actionCell);

            this.filePreview.appendChild(fileElement);
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
