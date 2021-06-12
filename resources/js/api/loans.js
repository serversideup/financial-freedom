import axios from 'axios';

export default {
    show( id ){
        return axios.get('/api/v1/loans/'+id);
    },

    update( id, data ){
        return axios.put('/api/v1/loans/'+id, data);
    },

    transactions( id, params ){
        return axios.get('/api/v1/loans/'+id+'/transactions', {
            params: params
        });
    }
}