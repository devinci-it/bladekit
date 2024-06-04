// vite.config.js
import { defineConfig } from 'vite';

export default defineConfig({
  // Other configuration options
  optimizeDeps: {
    include: ['prismjs'],
  },
});
