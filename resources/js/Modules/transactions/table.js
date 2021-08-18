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
        },

        setStartDate( state, startDate ){
            state.startDate = startDate;
        },

        setEndDate( state, endDate ){
            state.endDate = endDate;
        },

        setCurrentTime( state, time ){
            state.currentTime = time;
        },

        setSearch( state, value ){
            state.search = value;
        }
    },

    getters: {
        getTransactions( state ){
            return state.transactions;
        },

        getLoading( state ){
            return state.loading;
        },

        getStartDate( state ){
            return state.startDate;
        },

        getEndDate( state ){
            return state.endDate;
        },

        getCurrentTime( state ){
            return state.currentTime;
        },
        
        getSearch( state ){
            return state.search;
        }
    }
}