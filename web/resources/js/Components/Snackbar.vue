<template>
  <div class="text-center">
    <v-snackbar v-model="snackbar" :timeout="timeout" top right>
      {{ text }}

      <template v-slot:action="{ attrs }">
        <v-btn color="blue" icon v-bind="attrs" @click="snackbar = false">
          mdi-checkbox-marked-circle
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  data: () => ({
    snackbar: false,
    text: "My timeout is set to 2000.",
    timeout: 5000,
  }),
};
</script>
