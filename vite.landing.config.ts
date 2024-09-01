import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/landing.ts',
            refresh: true,
            buildDirectory: 'build/landing'
        })
    ],
    build: {
        minify: 'esbuild',
        sourcemap: true,
        manifest: true
    }
})
