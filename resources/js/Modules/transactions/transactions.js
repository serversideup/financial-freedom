export const transactions = {
    namespaced: true,

    state: () => ({
        transactions: [],
    }),

    actions: {
        
    },

    mutations: {
        setTransactions( state, transactions ){
            state.transactions = transactions;
        }
    },

    getters: {
        getTransactions( state ){
            return state.transactions;
        }
    }
}