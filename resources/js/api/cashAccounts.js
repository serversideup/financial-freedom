import axios from 'axios';

export default {
    show( id ){
        return axios.get( '/api/v1/cash-accounts/'+id );
    },

    update( id, data ){
        return axios.put( '/api/v1/cash-accounts/'+id, data );
    },

    store( data ){
        return axios.post( '/api/v1/cash-accounts', data );
    },

    getAllocations( id ){
        return axios.get( '/api/v1/cash-accounts/'+id+'/allocations' );
    },

    addAllocation( id, data ){
        return axios.post( '/api/v1/cash-accounts/'+id+'/allocations', data);
    },

    transactions( id, params ){
        return axios.get('/api/v1/cash-accounts/'+id+'/transactions', {
            params: params
        });
    }
}