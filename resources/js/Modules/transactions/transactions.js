export const transactions = {
    namespaced: true,

    state: () => ({
        transactions: [],
        loading: false
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