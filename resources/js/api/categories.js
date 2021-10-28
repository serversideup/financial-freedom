import axios from 'axios';

export default {
    async index( params ){
        return axios.get('/api/v1/categories', {
            params: params
        });
    },

    async update( id, data ){
        return axios.put('/api/v1/categories/'+id, data);
    }
}