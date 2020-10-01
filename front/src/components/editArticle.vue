<template>
    <v-card>
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <imageUpload
                            @getImage = "getImage"
                        ></imageUpload>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            v-model="body"
                            label="Body"
                            color=primary
                            auto-grow
                        >
                        </v-textarea>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            v-model="selectSource"
                            :items="sourceList"
                            label="Source"
                            color=primary
                            item-color=primary
                        ></v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="publisher"
                            label="Publisher"
                            color=primary
                        >
                        </v-text-field>
                    </v-col>
                    <v-col>
                        <v-btn
                            block
                            color=primary
                            dark
                            @click="editArticle"
                        >
                            <v-icon>mdi-grease-pencil</v-icon>
                            Edit
                        </v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
import feedService from '@/services/api/article';
import imageUpload from './imageUpload.vue';

export default {
  name: 'editArticle',
  components: {
    imageUpload,
  },
  props: [
    'article',
  ],
  data: () => ({
    id: '',
    body: '',
    publisher: '',
    selectSource: '',
    image: '',
    sourceList: [
      'ElMundo',
      'ElPais',
      'Avantio',
    ],
  }),
  methods: {
    editArticle() {
      const params = {
        body: this.body,
        publisher: this.publisher,
        source: this.selectSource,
        image: this.image,
      };

      feedService.editArticle(this.id, params)
        .then(() => {
          this.$emit('closeDialog');
        })
        .catch(() => {
        });
    },
    getImage(val) {
      const image = val[0];
      this.image = image.url;
    },
  },
  mounted() {
    const { article } = this.$props;
    this.id = article.id;
    this.body = article.body;
    this.selectSource = article.source;
    this.publisher = article.publisher;
  },
};
</script>

<style scoped>
</style>
