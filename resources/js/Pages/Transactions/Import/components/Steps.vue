<template>
    <nav aria-label="Progress" class="w-full">
        <ol role="list" class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
            <li v-for="(step, stepIdx) in steps" :key="step.name" class="relative md:flex-1 md:flex">
                <a v-if="step.status === 'complete'" :href="step.href" class="group flex items-center w-full">
                    <span class="px-6 py-4 flex items-center text-sm font-medium">
                        <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 rounded-full group-hover:bg-blue-800">
                            <CheckIcon class="w-6 h-6 text-white" aria-hidden="true" />
                        </span>
                        <span class="ml-4 text-sm font-medium text-gray-900">{{ step.name }}</span>
                    </span>
                </a>
                <a v-else-if="step.status === 'current'" :href="step.href" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
                    <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-blue-600 rounded-full">
                        <span class="text-blue-600">{{ step.id }}</span>
                    </span>
                    <span class="ml-4 text-sm font-medium text-blue-600">{{ step.name }}</span>
                </a>
                <a v-else :href="step.href" class="group flex items-center">
                    <span class="px-6 py-4 flex items-center text-sm font-medium">
                        <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                            <span class="text-gray-500 group-hover:text-gray-900">{{ step.id }}</span>
                        </span>
                        <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ step.name }}</span>
                    </span>
                </a>
                <template v-if="(stepIdx !== steps.length - 1)">
                    <!-- Arrow separator for lg screens and up -->
                    <div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </template>
            </li>
        </ol>
    </nav>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid'
import { mapState } from 'vuex';

export default {
    computed: {
        steps(){
            return [
                { id: 1, name: 'Select Account', href: '#', status: this.determineStatus( 1 ) },
                { id: 2, name: 'Upload File', href: '#', status: this.determineStatus( 2 ) },
                { id: 3, name: 'Import', href: '#', status: this.determineStatus( 3 ) },
            ];
        },

        ...mapState('transactions/importProcess', {
            step: state => state.step
        })
    },

    components: {
        CheckIcon,
    },

    methods: {
        determineStatus( id ){
            if( this.step == id ){
                return 'current';
            }else if( this.step < id ){
                return 'upcoming';
            }else{
                return 'complete';
            }
        }
    }
}
</script>