import axios from 'axios';

export default {
    index(){
        return axios.get('/api/v1/rules');
    },

    update( id, data ){
        return axios.put('/api/v1/rules/'+id, data);
    },

    store( data ){
        return axios.post('/api/v1/rules', data );
    }
}