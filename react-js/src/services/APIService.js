import axios from 'axios';

const fetchData = async () => {
  return axios.get('/sv/api/product');
}

export { fetchData }