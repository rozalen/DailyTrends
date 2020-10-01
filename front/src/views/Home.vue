<template>
  <div class="home">
    <News
      :news="news"
    />
  </div>
</template>

<script>
// @ is an alias to /src
import feedService from '@/services/api/article';
import News from '../components/News.vue';

export default {
  name: 'Home',
  data() {
    return {
      news: [],
    };
  },
  components: {
    News,
  },
  mounted() {
    feedService.getArticles()
      .then((res) => {
        this.news = res.response;
      })
      .catch(() => {
      });
  },
};
</script>
