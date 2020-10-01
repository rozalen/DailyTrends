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

      <v-btn
        text
      >
        <span class="mr-2">Managing news</span>
        <v-icon>mdi-newspaper</v-icon>
      </v-btn>
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
export default {
  name: 'App',

  components: {
  },

  data: () => ({
  }),
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
