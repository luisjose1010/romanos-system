import axios from 'axios';
import env from '../env';

const API_URL = env.API_HOST + env.API_URL;

const api = axios.create({
  baseURL: API_URL,
});

export default api;
