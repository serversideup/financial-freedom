export const table = {
    namespaced: true,

    state: () => ({
        transactions: [],
        selectedTransactions: [],
        loading: false,
        startDate: '',
        endDate: '',
        currentTime: '',
        search: '',
        order: {
            column: 'date',
            direction: 'desc'
        },
        filters: {
            category: '',
            tags: [],
            direction: 'all'
        }
    }),

    actions: {
        
    },

    mutations: {
        setTransactions( state, transactions ){
            state.transactions = transactions;
        },

        setLoading( state, loading ){
            state.loading = loading;
        }
    },

    getters: {
        getTransactions( state ){
            return state.transactions;
        },

        getLoading( state ){
            return state.loading;
        }
    }
}