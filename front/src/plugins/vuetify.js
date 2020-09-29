import Vue from 'vue';
import Vuetify from 'vuetify/lib';

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
    themes: {
      light: {
        primary: '#E85C40',
        secondary: '#303E47',
        accent: '#FF783B',
        error: '#FF3F3B',
      },
    },
  },
});