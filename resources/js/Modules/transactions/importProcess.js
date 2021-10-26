export const importProcess = {
    namespaced: true,

    state: () => ({
        step: 1,
        account: '',
        transactions: [],
    }),

    actions: {
        
    },

    mutations: {
        setAccount( state, account ){
            state.account = account;
        },

        setStep( state, step ){
            state.step = step;
        },

        setTransactions( state, transactions ){
            state.transactions = transactions;
        }
    },

    getters: {
        getAccount( state ){
            return state.account;
        },

        getStep( state ){
            return state.step;
        },

        getTransactions( state ){
            return state.transactions;
        }
    }
}