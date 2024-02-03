import Papa from 'papaparse';
import { ref } from 'vue';

const account = ref(null);
const file = ref(null);
const parsing = ref(false);
const transactions = ref([]);

export const useImportTransactions = () => {

    const parseUpload = () => {
        parsing.value = true;

        Papa.parse(file.value, {
            header: true,
            skipEmptyLines: true,
            complete: (results) => {
                transactions.value = results.data;
                parsing.value = false;
            }
        })
    }

    return {
        account,
        file,
        parsing,
        transactions,

        parseUpload,
    }
}