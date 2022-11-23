import axios from 'axios';

const API_URL = process.env.VUE_APP_API_HOST + process.env.VUE_APP_API_URL;

const config = {
  baseURL: API_URL,
};

// Autenticación
if (localStorage.getItem('user')) {
  const user = JSON.parse(localStorage.getItem('user'));
  config.headers = { Authorization: `Bearer ${user.token}` };
}

const api = axios.create(config);

export default api;
