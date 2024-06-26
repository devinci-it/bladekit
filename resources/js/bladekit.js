
// Initialize Prism for syntax highlighting
import Prism from "prismjs";

// Import all files from specified directories
import './bootstrap.js';

import.meta.glob('../images/**');
import.meta.glob('../fonts/**');
import.meta.glob('../icons/**');
import.meta.glob('../css/**');

document.addEventListener('DOMContentLoaded', function () {
    Prism.highlightAll();
});