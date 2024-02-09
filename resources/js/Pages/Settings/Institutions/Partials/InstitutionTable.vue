<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-xl border border-[#1F242F]">
                    <table class="min-w-full divide-y divide-[#1F242F]">
                        <thead class="bg-[#161B26]">
                            <tr>
                                <th scope="col" class="py-4 pl-4 pr-3 text-left text-xs font-medium text-[#94969C]">Name</th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-[#94969C]">URL</th>
                                <th scope="col" class="relative py-4 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr v-for="(institution) in institutions.data" :key="institution.id">
                                <td class="py-3 pl-4 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                    {{ institution.name }}
                                </td>
                                <td class="py-3 pl-4 font-sans text-sm text-[#94969C] font-medium border-b border-[#1F242F]">
                                    {{ institution.url  }}
                                </td>
                                <td class="py-3 px-4 font-sans font-medium border-b border-[#1F242F] text-right">
                                    <button @click="deleteInstitution(institution)" class="text-[#94969C] font-sans text-sm font-semibold">Delete</button>
                                    <button @click="editInstitution(institution)" class="text-[#CECFD2] ml-3 font-sans text-sm font-semibold">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="py-[14px] px-4">
                                    <div class="w-full flex items-center justify-between">
                                        <button @click="previous()" class="text-sm inline-flex items-center px-3 py-2 rounded-lg border border-[#333741] font-sans font-semibold text-[#CECFD2] bg-[#161B26]">
                                            <div class="w-5 h-5 flex items-center justify-center mr-1">
                                                <ArrowLeftIcon/>
                                            </div>
                                            
                                            Previous
                                        </button>

                                        <div class="flex items-center">
                                            <button
                                                v-for="link in paginationNumbers" 
                                                @click="link.url != null ? toPage( link.url ) : null"
                                                v-text="link.label"
                                                class="w-8 h-8 flex items-center justify-center font-sans text-sm font-medium hover:text-[#ECECED]"
                                                :class="link.active 
                                                    ? 'text-[#ECECED] bg-[#1F242F] rounded-lg' 
                                                    : 'text-[#94969C]'">
                                            </button>
                                        </div>
                                        

                                        <button @click="next()" class="text-sm inline-flex items-center px-3 py-2 rounded-lg border border-[#333741] font-sans font-semibold text-[#CECFD2] bg-[#161B26]">
                                            Next
                                            
                                            <div class="w-5 h-5 flex items-center justify-center ml-1">
                                                <ArrowRightIcon/>
                                            </div>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ArrowLeftIcon from '@/Components/Icons/LeftArrowIcon.vue';
import ArrowRightIcon from '@/Components/Icons/RightArrowIcon.vue';
import { router, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { useEventBus } from '@vueuse/core'

const bus = useEventBus('ff-prompt-event-bus')

const institutions = computed( () => usePage().props.institutions );
const paginationNumbers = computed(() => {
    return institutions.value.links 
        ? institutions.value.links.splice(1, institutions.value.links.length - 2) 
        : [];
});

const url = ref('/settings/institutions');
const loading = ref(false);

const previous = () => {
    if( institutions.value.prev_page_url == null ){
        return;
    }

    url.value = institutions.value.prev_page_url;
    getInstitutions();
}

const next = () => {
    if( institutions.value.next_page_url == null ){
        return;
    }

    url.value = institutions.value.next_page_url;
    getInstitutions();
}

const toPage = ( page ) => {
    url.value = page;
    getInstitutions();
}

const getInstitutions = () => {
    loading.value = true;

    let params = buildParams();

    router.visit(url.value, {
        only: ['institutions'],
        data: params,
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            loading.value = false
        }
    })
}

const buildParams = () => {
    let params = {};

    return params;
}

const deleteInstitution = ( institution ) => {
    bus.emit('prompt-delete-institution', institution);
}

const editInstitution = ( institution ) => {
    bus.emit('prompt-edit-institution', institution);
}
</script>