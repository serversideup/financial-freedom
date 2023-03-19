import { defineConfig, splitVendorChunkPlugin, loadEnv, Plugin } from 'vite';
// import { chunkSplitPlugin } from 'vite-plugin-chunk-split';
import { createHtmlPlugin } from "vite-plugin-html";
import { esbuildCommonjs } from "@originjs/vite-plugin-commonjs";
import eslint from 'vite-plugin-eslint';
import laravel from 'laravel-vite-plugin';
import legacy from "@vitejs/plugin-legacy";
import manifestSRI from "vite-plugin-manifest-sri";
import path from 'path';
import StylelintPlugin from 'vite-plugin-stylelint';
import { viteCommonjs } from "@originjs/vite-plugin-commonjs";
import viteImagemin from "vite-plugin-imagemin";
import { ViteMinifyPlugin } from "vite-plugin-minify";
import vue from '@vitejs/plugin-vue';
import basicSsl from '@vitejs/plugin-basic-ssl';

export default ({ mode }) => {
  // process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };
  return defineConfig({
    optimizeDeps: {
      force: true,
      esbuildOptions: {
        plugins: [esbuildCommonjs()],
      },
    },
    build: {
      ssr: false,
      minify: "esnext",
      reportCompressedSize: true,
      chunkSizeWarningLimit: 1600,
      manifest: true,
      sourcemap: process.env.VITE_APP_ENV == "local" ? true : false,
      rollupOptions: {
        external: ["Vue"],
        output: {
          manualChunks(id, { getModuleInfo }) {
            const match = /.*\.strings\.(\w+)\.js/.exec(id);
            if (match) {
              const language = match[1]; // e.g. "en"
              const dependentEntryPoints = [];
              // we use a Set here so we handle each module at most once. This
              // prevents infinite loops in case of circular dependencies
              const idsToHandle = new Set(getModuleInfo(id).dynamicImporters);
              for (const moduleId of idsToHandle) {
                const { isEntry, dynamicImporters, importers } =
                  getModuleInfo(moduleId);
                if (isEntry || dynamicImporters.length > 0)
                  dependentEntryPoints.push(moduleId);
                // The Set iterator is intelligent enough to iterate over elements that
                // are added during iteration
                for (const importerId of importers) idsToHandle.add(importerId);
              }
              // If there is a unique entry, we put it into a chunk based on the entry name
              if (dependentEntryPoints.length === 1) {
                return `${
                  dependentEntryPoints[0].split("/").slice(-1)[0].split(".")[0]
                }.strings.${language}`;
              }
              // For multiple entries, we put it into a "shared" chunk
              if (dependentEntryPoints.length > 1) {
                return `shared.strings.${language}`;
              }
            }
          },
          globals: {
            vue: "Vue",
          },
        },
      },
      modulePreload: {
        polyfill: true,
      },
      commonjsOptions: {
        include: [/node_modules/],
      },
    },
    plugins: [
      basicSsl(),
      createHtmlPlugin({
        minify: true,
        entry: "resources/js/app.js",
      }),
      laravel({
        input: ['resources/js/app.js', 'resources/css/app.css'],
        refresh: true,
      }),
      StylelintPlugin({
        fix: true,
        quite: false,
        lintOnStart: false,
      }),
      eslint({
        cache: true,
        fix: true,
        lintOnStart: false,
        emitWarning: true,
        emitError: true,
        failOnWarning: false,
        failOnError: true,
      }),
      legacy({
        targets: ["defaults", "not IE 11"],
        polyfills: true,
      }),
      manifestSRI(),
      vue({
        template: {
          transformAssetUrls: {
            base: null,
            includeAbsolute: false,
          },
        },
      }),
      ViteMinifyPlugin({
        minifyCSS: true,
        removeComments: true,
      }),
      viteCommonjs(),
      viteImagemin({
        gifsicle: {
          optimizationLevel: 7,
          interlaced: false,
        },
        optipng: {
          optimizationLevel: 7,
        },
        mozjpeg: {
          quality: 20,
        },
        pngquant: {
          quality: [0.8, 0.9],
          speed: 4,
        },
        svgo: {
          plugins: [
            {
              name: "removeViewBox",
            },
            {
              name: "removeEmptyAttrs",
              active: false,
            },
          ],
        },
      }),
      splitVendorChunkPlugin(),
      // chunkSplitPlugin(),
    ],
    sourcemap: true,
    resolve: {
      alias: {
        '~': path.resolve(__dirname, 'node_modules'),
        '@': path.resolve(__dirname, 'resources/js'),
        ziggy: path.resolve('vendor/tightenco/ziggy/dist.vue'),
      },
    },
    server: {
      port: 8080,
      hot: true,
    },
  });
};
