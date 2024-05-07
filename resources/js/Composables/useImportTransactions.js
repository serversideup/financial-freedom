import Papa from 'papaparse';
import { reactive, ref } from 'vue';

const step = ref('select-account');
const account = ref(null);
const file = ref(null);
const parsing = ref(false);
const fieldMap = reactive({
    name: '',
    date: '',
    amount: ''
});
const header = ref([]);
const csvData = ref([]);
const transactions = ref([]);

export const useImportTransactions = () => {

    const parseUpload = () => {
        parsing.value = true;

        Papa.parse(file.value, {
            header: true,
            skipEmptyLines: true,
            complete: (results) => {
                header.value = results.meta.fields;
                csvData.value = results.data;
                step.value = 'map-fields';
            }
        })
    }

    const convertTransactions = () => {
        parsing.value = true;

        for( let i = 0; i < csvData.value.length; i++ ){
            transactions.value.push({
                import: true,
                name: csvData.value[i][fieldMap.name],
                raw_name: csvData.value[i][fieldMap.name],
                description: '',
                amount: csvData.value[i][fieldMap.amount],
                direction: parseFloat( csvData.value[i][fieldMap.amount] ) > 0 ? 'credit' : 'debit',
                date: csvData.value[i][fieldMap.date],
                category: '',
                potential_duplicate: null,
                imported: false,
            });
        }

        parsing.value = false;
    }

    return {
        step,
        account,
        file,
        parsing,

        fieldMap,
        header,
        csvData,
        transactions,

        parseUpload,
        convertTransactions
    }
}