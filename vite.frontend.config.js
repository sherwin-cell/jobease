import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
    ],
    build: {
        outDir: 'public',
        emptyOutDir: true,
        rollupOptions: {
            input: 'index.html',  // Create a simple index.html in root
        }
    }
});