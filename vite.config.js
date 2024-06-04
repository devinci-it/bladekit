import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/bladekit.js',
        'resources/css/index.css',
        'resources/scss/index.scss',
      ],
      refresh: true,
    }),
  ],
  build: {
    rollupOptions: {
      output: {
        dir:'dist',
        entryFileNames: 'js/[name].[hash].js',
        chunkFileNames: 'js/[name].[hash].js',
        assetFileNames: ({ name }) => {
          if (/\.css$/.test(name ?? '')) {
            return 'css/[name].[hash].[ext]';
          }
          if (/\.svg$/.test(name ?? '')) {
            return 'images/[name].[hash].[ext]';
          }
          return 'assets/[name].[hash].[ext]';
        },
      },
    },
  },
});
