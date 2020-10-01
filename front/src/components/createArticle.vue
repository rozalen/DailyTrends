<template>
    <v-card>
        <v-card-text>
            <v-container>
                <v-row>
                     <v-col cols="12">
                        <v-text-field
                            v-model="title"
                            label="Title"
                            color=primary
                            auto-grow
                        >
                        </v-text-field>
                    </v-col>
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
                            @click="createArticle"
                        >
                            <v-icon>mdi-grease-pencil</v-icon>
                            Create
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
  name: 'createArticle',
  components: {
    imageUpload,
  },
  data: () => ({
    title: '',
    body: '',
    publisher: '',
    image: '',
  }),
  methods: {
    createArticle() {
      const params = {
        title: this.title,
        body: this.body,
        publisher: this.publisher,
        source: 'Avantio',
        image: this.image,
      };

      feedService.createArticle(params)
        .then((res) => {
          this.cleanValues();
          this.$emit('closeDialog', { id: res.response.id });
        })
        .catch(() => {
        });
    },
    getImage(val) {
      const image = val[0];
      this.image = image.url;
    },
    cleanValues() {
      this.title = '';
      this.body = '';
      this.publisher = '';
      this.image = '';
    },
  },
  mounted() {
  },
};
</script>

<style scoped>
</style>
