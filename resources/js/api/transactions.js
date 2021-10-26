import axios from 'axios';

export default {
    index( params ){
        return axios.get('/api/v1/transactions', {
            params: params 
        });
    },

    update( transaction, data ){
        return axios.post('/api/v1/transactions/'+transaction, data);
    },

    import( account, transactions ){
        return axios.post('/api/v1/transactions/import', {
            transactions: transactions,
            account: account
        });
    },

    store( transaction ){
        return axios.post('/api/v1/transactions', transaction );
    }
}