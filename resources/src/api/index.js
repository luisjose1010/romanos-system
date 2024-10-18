/* eslint-disable no-param-reassign */
import axios from 'axios';

const API_URL = import.meta.env.VITE_API_HOST + import.meta.env.VITE_API_URL;

const api = axios.create();

// Autenticación
api.interceptors.request.use(
  (config) => {
    if (localStorage.getItem('user')) {
      const user = JSON.parse(localStorage.getItem('user'));
      config.headers = { Authorization: `Bearer ${user.token}` };
      config.baseURL = API_URL;
    } else {
      config.baseURL = API_URL;
    }
    return config;
  },
);

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response.status === 401 && error.response.data.errorName === 'token_expired') {
      window.location.href = '/logout';
    }
    return Promise.reject(error);
  },
);

export default api;
