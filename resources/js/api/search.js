import axios from 'axios';

export default {
    index( term ){
        return axios.post('/api/v1/search', {
            term: term 
        } );
    }
}