import axios from 'axios';

export default {
    show( id ){
        return axios.get('/api/v1/savings-accounts/'+id);
    },

    update( id, data ){
        return axios.put('/api/v1/savings-accounts/'+id, data);
    },
}