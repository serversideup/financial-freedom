import axios from 'axios';

export default {
    show( id ){
        return axios.get('/api/v1/gift-cards/'+id);
    }
}