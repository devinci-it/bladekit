import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Prism from 'prismjs';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/reset.css','resources/css/index.css', 'resources/js/bladekit.js','resources/scss/index.scss'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                entryFileNames: 'js/[name].[hash].js',
                chunkFileNames: 'js/chunks/[name].[hash].js',
                assetFileNames: (assetInfo) => {
                    if (/\.css$/.test(assetInfo.name)) return 'css/[name].[hash][extname]';
                    if (/\.js$/.test(assetInfo.name)) return 'js/[name].[hash][extname]';
                    if (/\.(png|jpe?g|gif|svg)$/.test(assetInfo.name)) return 'images/[name].[hash][extname]';
                    if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) return 'assets/[name].[hash][extname]';
                    if (/\.(ico|webp)$/.test(assetInfo.name)) return 'icons/[name].[hash][extname]';
                    return 'assets/[name].[hash][extname]';
                }
            }
        },
        assetsInclude: ['**/*.css', '**/*.js', '**/*.png', '**/*.jpg', '**/*.svg', '**/*.woff', '**/*.woff2', '**/*.ttf', '**/*.eot']
    }
});