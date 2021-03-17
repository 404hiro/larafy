<template>
  <v-dialog v-model="dialog" persistent max-width="700px" v-if="form">
    <v-card>
      <v-card-title>
        <span class="headline" v-if="account">{{ account.uuid }}</span>
        <span class="headline" v-else>User Profile</span>
        <v-spacer></v-spacer>
        <v-btn v-if="account" icon color="red">
          <v-icon dark>mdi-trash-can-outline </v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="6">
              <v-text-field
                label="Legal first name*"
                required
                v-model="form.name"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="Title" v-model="form.title"> </v-text-field>
            </v-col>

            <v-col cols="12">
              <v-text-field
                label="Email*"
                required
                v-model="form.email"
              ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
              <v-autocomplete
                :items="[
                  'Skiing',
                  'Ice hockey',
                  'Soccer',
                  'Basketball',
                  'Hockey',
                  'Reading',
                  'Writing',
                  'Coding',
                  'Basejump',
                ]"
                label="Role"
                multiple
              ></v-autocomplete>
            </v-col>
          </v-row>
        </v-container>
        <small>*indicates required field</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="dialog = false">
          Close
        </v-btn>
        <v-btn color="blue darken-1" text @click="dialog = false"> Save </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    form: null,
    account: null,
  }),
  props: {
    envs: {
      type: Array,
    },
    app_name: String,
  },

  methods: {
    open(account = null) {
      this.dialog = true;
      this.form = account;
      this.account = account;
    },
  },
};
</script>
