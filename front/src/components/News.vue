<template>
  <v-container>
    <h1 class="display-2 mb-3 text-center">
      Daily Trends - Breaking News
    </h1>
    <v-row
      class="text-center"
    >
      <v-col
        md="4"
        sm="6"
        xs="12"
      >
        <v-img
          :src="require('../assets/pais.jpg')"
          contain
          height="100"
        />
        <new
          v-for="n in 5"
          :key="'p'+n"
          class="mt-3"
        />
      </v-col>
      <v-col
        md="4"
        sm="6"
        xs="12"
      >
        <v-img
          :src="require('../assets/elmundo.jpg')"
          contain
          height="100"
        />
        <new
          v-for="n in 5"
          :key="'m'+n"
          class="mt-3"
        />
      </v-col>
       <v-col
        md="4"
        sm="12"
        xs="12"
      >
        <v-img
          :src="require('../assets/avantio.jpg')"
          contain
          height="100"
        />
        <new
          v-for="n in 5"
          :key="'a'+n"
          class="mt-3"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import New from './New.vue';

export default {
  name: 'News',

  data: () => ({
    ecosystem: [
      {
        text: 'vuetify-loader',
        href: 'https://github.com/vuetifyjs/vuetify-loader',
      },
      {
        text: 'github',
        href: 'https://github.com/vuetifyjs/vuetify',
      },
      {
        text: 'awesome-vuetify',
        href: 'https://github.com/vuetifyjs/awesome-vuetify',
      },
    ],
    importantLinks: [
      {
        text: 'Documentation',
        href: 'https://vuetifyjs.com',
      },
      {
        text: 'Chat',
        href: 'https://community.vuetifyjs.com',
      },
      {
        text: 'Made with Vuetify',
        href: 'https://madewithvuejs.com/vuetify',
      },
      {
        text: 'Twitter',
        href: 'https://twitter.com/vuetifyjs',
      },
      {
        text: 'Articles',
        href: 'https://medium.com/vuetify',
      },
    ],
    whatsNext: [
      {
        text: 'Explore components',
        href: 'https://vuetifyjs.com/components/api-explorer',
      },
      {
        text: 'Select a layout',
        href: 'https://vuetifyjs.com/getting-started/pre-made-layouts',
      },
      {
        text: 'Frequently Asked Questions',
        href: 'https://vuetifyjs.com/getting-started/frequently-asked-questions',
      },
    ],
  }),
  components: {
    New,
  },
};
</script>
