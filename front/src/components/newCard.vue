<template>
  <v-card
    class="mx-auto"
    :title = "article.title"
  >
    <v-img
      :src="(article.image != '' ? article.image : require('../assets/defaultNewImage.jpg'))"
      height="200px"
    ></v-img>

    <v-card-title    >
      {{ article.title.slice(0, 80) }}...
    </v-card-title>

    <v-card-subtitle>
      {{ article.created_at }} | {{ article.publisher.slice(0, 20) }}...
    </v-card-subtitle>

    <v-card-actions>
      <v-btn
        color="primary"
        text
        @click="goArticle"
      >
        View Article
      </v-btn>

      <v-spacer></v-spacer>

      <v-btn
        icon
        @click="show = !show"
      >
        <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>

        <v-card-text>
          {{ article.body }}
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>

<script>
export default {
  name: 'newCard',
  props:[
    "article"
  ],
  data() {
    return {
      show: false,
      date: new Date(),
    };
  },
  computed: {
    getDate() {
      return this.date.toISOString().slice(0, 10);
    },
  },
  mounted() {
    let date = new Date(this.article.created_at);
    this.article.created_at = date.toDateString();
  },
  methods: {
    goArticle() {
      this.$router.push({ name: 'Article', params: { id: this.article.id } });
    },
  },
};
</script>

<style scoped>
  .v-card__title {
    word-break: break-word !important;
  }
</style>
