import axios from 'axios';

export default {
    async index( params ){
        return axios.get('/api/v1/tags', {
            params: params
        });
    }
}