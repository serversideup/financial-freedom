import axios from 'axios';

export default {
    index( params ){
        return axios.get('/api/v1/budgets', {
            params: params
        });
    },

    store( data ){
        return axios.post( '/api/v1/budgets', data);
    },

    delete( id ){
        return axios.delete( '/api/v1/budgets/'+id );
    },

    update( allocations ){
        return axios.put( '/api/v1/budgets', allocations );
    }
}