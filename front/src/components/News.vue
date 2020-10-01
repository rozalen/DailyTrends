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
        <newCard
          v-for = "article in elMundoNews"
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
        <newCard
          v-for = "article in elPaisNews"
          :key = "article.id"
          :article = "article"
          class="mt-3"
        />
      </v-col>
    </v-row>
    <v-row>
      <v-col
        xs="12"
      >
        <v-img
          :src="require('../assets/avantio.jpg')"
          contain
          height="100"
        />
        <newCard
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
import newCard from './newCard'

export default {
  name: 'News',
  props: ['news'],
  data: () => ({
    elMundoNews:[],
    elPaisNews:[],
    avantioNews:[],
  }),
  components: {
    newCard,
  },
  methods: 
  {
    setNews()
    {
      this.elMundoNews = this.news.filter(article => article.source == "ElMundo");
      this.elPaisNews = this.news.filter(article => article.source == "ElPais");
      this.avantioNews = this.news.filter(article => article.source == "Avantio");
    }
  },
  watch: {
    news: [{
        handler: 'setNews',
    }],
  }
}
</script>
