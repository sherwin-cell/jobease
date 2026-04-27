import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'; // or react plugin if using React
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        vue(), // Change to react() if using React
        tailwindcss(),
    ],
    build: {
        outDir: 'public',
        emptyOutDir: true,
        rollupOptions: {
            input: 'resources/js/app.js', // Your main JS entry point
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]'
            }
        }
    },
    server: {
        watch: {
            ignored: ['**/storage/**', '**/vendor/**'],
        },
    },
});