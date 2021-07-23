import axios from 'axios';

export default {
    index( params ){
        return axios.get('/api/v1/allocations', {
            params: params
        });
    },

    store( data ){
        return axios.post( '/api/v1/allocations', data);
    },

    delete( id ){
        return axios.delete( '/api/v1/allocations/'+id );
    },

    update( allocations ){
        return axios.put( '/api/v1/allocations', allocations );
    }
}