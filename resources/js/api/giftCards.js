import axios from 'axios';

export default {
    show( id ){
        return axios.get('/api/v1/gift-cards/'+id);
    },

    store( data ){
        return axios.post('/api/v1/gift-cards', data);
    }
}