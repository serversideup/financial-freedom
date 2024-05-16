import Papa from 'papaparse';
import { computed, reactive, ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const step = ref('select-account');
const form = useForm({
    account: null,
    transactions: []
});
const file = ref(null);
const parsing = ref(false);
const fieldMap = reactive({
    name: '',
    date: '',
    amount: ''
});
const rules = ref([]);
const header = ref([]);
const csvData = ref([]);
const transactions = ref([]);
const importing = ref(false);

export const useImportTransactions = () => {
    

    const groups = computed(() => usePage().props.groups);

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
            form.transactions.push({
                name: csvData.value[i][fieldMap.name],
                raw_name: csvData.value[i][fieldMap.name],
                description: '',
                amount: csvData.value[i][fieldMap.amount],
                direction: parseFloat( csvData.value[i][fieldMap.amount] ) > 0 ? 'credit' : 'debit',
                date: csvData.value[i][fieldMap.date],
                category: null,
                potential_duplicate: null,
                imported: false,
                matched_rule: false
            });
        }

        applyRules();

        parsing.value = false;
    }

    const importTransactions = () => {
        if( !importing.value ){
            importing.value = true;

            form.post('/transactions/import', {
                onSuccess: () => {
                    importing.value = false;
                    reset();
                }
            });
        }
    }

    const applyRules = () => {
        // Iterate over all transactions
        for( let i = 0; i < form.transactions.length; i++ ){
            // Iterate over all rules
            for( let j = 0; j < rules.value.length; j++ ){
                // Check if the search string is in the transaction name
                if( form.transactions[i].name.includes( rules.value[j].search_string ) ){
                    // Replace the name with the replace string
                    form.transactions[i].name = form.transactions[i].name = rules.value[j].replace_string;
                    
                    // Flag the transaction as matched by a rule
                    form.transactions[i].matched_rule = true;

                    // Check if a category is set in the rule
                    if( rules.value[j].category_id != null ){
                        // Iterate over all groups and categories to find the category
                        groups.value.forEach((group) => {
                            group.categories.forEach((category) => {
                                // If the category id matches the rule category id, set the category on the transaction
                                if( category.id === rules.value[j].category_id ){
                                    form.transactions[i].category = category;
                                }
                            });
                        });
                    }
                }
            }
        }
    }

    const reset = () => {
        step.value = 'select-account';
        file.value = null;
        parsing.value = false;
        fieldMap.name = '';
        fieldMap.date = '';
        fieldMap.amount = '';
        rules.value = [];
        header.value = [];
        csvData.value = [];
        importing.value = false;
        form.reset();
    }

    return {
        step,
        form,
        rules,
        file,
        parsing,
        importing,
        
        fieldMap,
        header,
        csvData,
        
        parseUpload,
        convertTransactions,
        importTransactions,
        applyRules
    }
}