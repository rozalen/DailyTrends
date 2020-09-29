<template>
  <v-card
    class="mx-auto"
  >
    <v-img
      src="https://picsum.photos/200/300"
      height="200px"
    ></v-img>

    <v-card-title>
      Top western road trips
    </v-card-title>

    <v-card-subtitle>
      {{ getDate }} / Publisher
    </v-card-subtitle>

    <v-card-actions>
      <v-btn
        color="primary"
        text
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
          I'm a thing. But, like most politicians, he promised more than he could deliver.
          You won't have time for sleeping, soldier, not with all the bed making you'll be doing.
          Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk!
           You're going to do his laundry? I've got to find a way to escape.
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>

<script>
export default {
  name: 'New',
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
};
</script>

<style>
</style>
