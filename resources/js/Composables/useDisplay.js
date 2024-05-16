import { ref } from 'vue';

const minimizeSidebar = ref(false);

export const useDisplay = () => {

    return {
        minimizeSidebar
    }
}