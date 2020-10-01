import axios from 'axios';

const ARTICLE_ROUTE = '/feed';

export default {
  getArticles() {
    return axios.get(`${ARTICLE_ROUTE}/today`)
      .then((res) => res.data);
  },
  getArticle(id) {
    return axios.get(`${ARTICLE_ROUTE}/${id}`)
      .then((res) => res.data);
  },
  createArticle(params) {
    return axios.post(ARTICLE_ROUTE, params);
  },
  removeArticle(id) {
    return axios.delete(`${ARTICLE_ROUTE}/${id}`);
  },
  editArticle(id, params) {
    return axios.put(`${ARTICLE_ROUTE}/${id}`, params);
  },
};
