import 'prismjs';
import 'prismjs/themes/prism.css';

// Optional: Import additional Prism.js plugins and components
import 'prismjs/plugins/line-numbers/prism-line-numbers.js';
import 'prismjs/plugins/line-numbers/prism-line-numbers.css';
import 'prismjs/components/prism-php.js';

// Initialize Prism
document.addEventListener('DOMContentLoaded', () => {
    Prism.highlightAll();
});
