<template>
    <div class="article">
        <v-row
            class="article d-flex justify-center"
        >
            <v-col
                cols="12"
            >
                <div
                    class="text-h2 text-center"
                >
                    <b>{{ article.title }}</b>
                </div>
            </v-col>
        </v-row>
        <v-row
            class="d-flex justify-center"
            v-if="article.image"
        >
            <v-col
                xs="12"
                cols="6"
            >
                <v-img
                    :src="article.image"
                    class="text-center"
                ></v-img>
            </v-col>
        </v-row>
        <v-divider
            width="75%"
        >
        </v-divider>
        <v-row
            class="d-flex justify-center"
        >
            <v-col
                xs="12"
                cols="6"
            >
                <p>
                    {{ article.body }}
                </p>
            </v-col>
        </v-row>
        <v-row
            class="d-flex justify-center"
        >
            <v-col
                xs="12"
                cols="6"
            >
                <p>
                    <b>{{article.created_at}}</b> | <i>{{article.publisher}}</i>
                </p>
            </v-col>
        </v-row>
        <v-divider
            width="75%"
        >
        </v-divider>
        <v-row
            class="d-flex justify-center"
        >
            <v-col
                sm="2"
                cols="6"
            >
                <v-dialog v-model="dialog"  max-width="600px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            block
                            dark
                            color="#e85c40"
                            v-bind="attrs"
                            v-on="on"
                        >
                            <v-icon>mdi-grease-pencil</v-icon>
                            Edit
                        </v-btn>
                    </template>
                    <editArticle
                        :article = "article"
                        @closeDialog = "closeDialog"
                    ></editArticle>
                </v-dialog>
            </v-col>
            <v-col
                sm="2"
                cols="6"
            >
                <v-btn
                    block
                    dark
                    color="#33393f"
                    @click="removeArticle"
                >
                    <v-icon>mdi-delete</v-icon>
                    Remove
                </v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col
            >
                <v-img
                    :src="this.sourceImage"
                    contain
                    height="100"
                />
            </v-col>
        </v-row>
    </div>
</template>

<script>
import feedService from '@/services/api/article';
import editArticle from '../components/editArticle.vue';

export default {
  name: 'Article',
  components: {
    editArticle,
  },
  data() {
    return {
      dialog: false,
      article: [],
      sourceImage: '',
    };
  },
  methods:
    {
      getArticle() {
        const { id } = this.$route.params;
        feedService.getArticle(id)
          .then((res) => {
            this.article = res.response;
            if (this.article) {
              this.setImageSource();
              this.formatDate();
            } else this.$router.push('/');
          })
          .catch(() => {
          });
      },
      removeArticle() {
        feedService.removeArticle(this.article.id)
          .then(() => {
            this.$router.push('/');
          })
          .catch(() => {
          });
      },
      setImageSource() {
        switch (this.article.source) {
          case 'ElMundo':
            // eslint-disable-next-line global-require
            this.sourceImage = require('../assets/elmundo.jpg');
            break;
          case 'ElPais':
            // eslint-disable-next-line global-require
            this.sourceImage = require('../assets/pais.jpg');
            break;
          case 'Avantio':
            // eslint-disable-next-line global-require
            this.sourceImage = require('../assets/avantio.jpg');
            break;
          default:
            break;
        }
      },
      formatDate() {
        const date = new Date(this.article.created_at);
        this.article.created_at = date.toDateString();
      },
      closeDialog() {
        this.dialog = false;
        this.getArticle();
      },
    },
  mounted() {
    this.getArticle();
  },
  watch: {
    $route: {
      handler(to, from) {
        if (to.params.id !== from.params.id) {
          this.getArticle();
        }
      },
    },
  },
};
</script>

<style scoped>
    .article .v-divider {
        margin: 0 auto;
        border-color: rgb(232 92 64) !important;
    }
</style>
