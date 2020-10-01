<template>
  <v-container>
    <h1 class="display-2 mb-3 text-center">
      Daily Trends - Breaking News
    </h1>
    <v-row
      class="text-center"
    >
      <v-col
        md="6"
        sm="12"
      >
        <v-img
          :src="require('../assets/pais.jpg')"
          contain
          height="100"
        />
        <v-progress-circular
          v-if="loadingElPais"
          indeterminate
          color="primary"
        >
        </v-progress-circular>
        <NewCard
          v-else
          v-for = "article in elPaisNews"
          :key = "article.id"
          :article = "article"
          class="mt-3"
        />
      </v-col>
      <v-col
          md="6"
          sm="12"
      >
        <v-img
          :src="require('../assets/elmundo.jpg')"
          contain
          height="100"
        />
         <v-progress-circular
          v-if="loadingElMundo"
          indeterminate
          color="primary"
        >
        </v-progress-circular>
        <NewCard
          v-else
          v-for = "article in elMundoNews"
          :key = "article.id"
          :article = "article"
          class="mt-3"
        />
      </v-col>
    </v-row>
    <v-row
      class="text-center"
    >
      <v-col
        xs="12"
      >
        <v-img
          :src="require('../assets/avantio.jpg')"
          contain
          height="100"
        />
        <v-progress-circular
          v-if="loadingAvantio"
          indeterminate
          color="primary"
        >
        </v-progress-circular>
        <NewCard
          v-else
           v-for = "article in avantioNews"
          :key = "article.id"
          :article = "article"
          class="mt-3"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import NewCard from './NewCard.vue';

export default {
  name: 'News',
  props: ['news'],
  data: () => ({
    elMundoNews: [],
    elPaisNews: [],
    avantioNews: [],
    loadingElMundo: true,
    loadingElPais: true,
    loadingAvantio: true,
  }),
  components: {
    NewCard,
  },
  methods:
  {
    setNews() {
      this.elMundoNews = this.news.filter((article) => article.source === 'ElMundo');
      this.loadingElMundo = false;
      this.elPaisNews = this.news.filter((article) => article.source === 'ElPais');
      this.loadingElPais = false;
      this.avantioNews = this.news.filter((article) => article.source === 'Avantio');
      this.loadingAvantio = false;
    },
  },
  watch: {
    news: [{
      handler: 'setNews',
    }],
  },
};
</script>
