import axios from 'axios';

const API_URL = process.env.VUE_APP_API_HOST + process.env.VUE_APP_API_URL;

const api = axios.create({
  baseURL: API_URL,
});

export default api;
