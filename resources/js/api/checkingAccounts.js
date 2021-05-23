import axios from 'axios';

export default {
    show( id ){
        return axios.get('/api/v1/checking-accounts/'+id);
    },

    update( id, data ){
        return axios.put('/api/v1/checking-accounts/'+id, data);
    },

    getAllocations( id ){
        return axios.get('/api/v1/checking-accounts/'+id+'/allocations');
    },

    addAllocation( id, data ){
        return axios.post('/api/v1/checking-accounts/'+id+'/allocations', data);
    }
}