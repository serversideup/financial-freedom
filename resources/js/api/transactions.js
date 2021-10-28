import axios from 'axios';

export default {
    index( params ){
        return axios.get('/api/v1/transactions', {
            params: params 
        });
    },

    show( transaction ){
        return axios.get('/api/v1/transactions/'+transaction);
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

    split( transaction, split ){
        return axios.post( '/api/v1/transactions/'+transaction+'/splits', split );
    },

    removeSplit( transaction, split ){
        return axios.delete('/api/v1/transactions/'+transaction+'/splits/'+split);
    },

    store( transaction ){
        return axios.post('/api/v1/transactions', transaction );
    }
}