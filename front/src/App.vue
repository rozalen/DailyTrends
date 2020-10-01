<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <div class="d-flex align-center">
        <v-img
          alt="DailyTrends Logo"
          class="shrink mr-2"
          contain
          src="@/assets/logo.jpeg"
          transition="scale-transition"
          width="40"
        />
      </div>

      <v-spacer></v-spacer>
      <v-dialog v-model="dialog"  max-width="600px">
          <template v-slot:activator="{ on, attrs }">
              <v-btn
                text
                v-bind="attrs"
                v-on="on"
              >
                <span class="mr-2">Create new</span>
                <v-icon>mdi-newspaper</v-icon>
              </v-btn>
          </template>
          <createArticle
            @closeDialog = "closeDialog"
          ></createArticle>
      </v-dialog>
    </v-app-bar>

    <v-main class="mb-15">
      <v-container fluid>
        <v-row class="fill-height">
          <v-col>
            <transition name="fade">
              <router-view></router-view>
            </transition>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <v-footer
      absolute
      color="primary"
      dark
      class="font-weight-medium"
    >
      <v-col
        class="text-center"
        cols="12"
      >
        {{ new Date().getFullYear() }} — <strong>DailyTrends</strong>
      </v-col>
    </v-footer>
  </v-app>
</template>

<script>
import createArticle from './components/createArticle.vue';

export default {
  name: 'App',
  components: {
    createArticle,
  },
  data() {
    return {
      dialog: false,
    };
  },
  methods: {
    closeDialog($event) {
      this.dialog = false;
      this.$router.push({ name: 'Article', params: { id: $event.id } });
    },
  },
  watch: {
    $route: {
      immediate: true,
      handler(to) {
        document.title = to.meta.title || 'Daily Trends';
      },
    },
  },
};
</script>
