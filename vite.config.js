import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import Vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        Vue({
            template:{
                transformAssetUrls:{
                    base:null,
                    includeAbsolute:false,
                },
            },
        }),
    ],
    resolve:{
        'Vue' : 'vue/dist/vue.esm-bundler.js',
    }
});
