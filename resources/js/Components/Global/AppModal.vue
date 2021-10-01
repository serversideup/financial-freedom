<template>
    <div 
        class="fixed top-0 right-0 left-0 bottom-0 flex items-center justify-center z-modal bg-modal-background" 
        v-show="show" 
        @click="close()">
        <div class="rounded bg-white w-4/5"
            v-bind:class="{
                'max-w-md': size == 'small',
                'max-w-2xl': size == 'medium',
                'max-w-5xl': size == 'large'
            }" @click.stop>
            <div class="flex items-center px-4 pt-5 pb-4">
                <slot name="image"></slot>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <slot name="header"></slot>
                    </h3>
                </div>
            </div>
            <div class="px-4 pb-4">
                <slot name="body"></slot>
            </div>
            <div class="flex justify-end items-center p-5" v-show="footer">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from '@/event-bus.js';

    export default {
        props: {
            show: Boolean, 
            size: {
                default: 'small'
            },
            footer: {
                default: true
            }
        },

        mounted(){
            document.addEventListener("keydown", (e) => {
                if (this.show && e.keyCode == 27) {
                    this.close();
                }
            });
        },

        methods: {
            close(){
                EventBus.emit('close-modal');
            }
        }
    }
</script>