import axios from 'axios';

export default {
    index( params ){
        return axios.get('/api/v1/accounts', {
            params: params 
        });
    },

    store( data ){
        return axios.post('/api/v1/accounts', data );
    }
}