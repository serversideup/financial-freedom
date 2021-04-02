import axios from 'axios';

export default {
    index( params ){
        return axios.get('/api/v1/transactions', {
            params: params 
        });
    },

    import( account, transactions ){
        return axios.post('/api/v1/transactions/import', {
            transactions: transactions,
            account: account
        });
    }
}