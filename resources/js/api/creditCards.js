import axios from 'axios';

export default {
    show( id ){
        return axios.get('/api/v1/credit-cards/'+id);
    },

    update( id, data ){
        return axios.put('/api/v1/credit-cards/'+id, data);
    },

    store( data ){
        return axios.post('/api/v1/credit-cards', data);
    },

    transactions( id, params ){
        return axios.get('/api/v1/credit-cards/'+id+'/transactions', {
            params: params
        });
    }
}