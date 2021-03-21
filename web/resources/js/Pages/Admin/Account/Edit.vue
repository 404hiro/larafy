<template>
  <admin-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Account</h2>
    </template>
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
              <v-text-field label="Name" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="Title"></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-select :items="roles" label="Role"></v-select>
            </v-col>

            <v-col cols="12" sm="6" md="6">
              <v-text-field label="Email*" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="12">
              <v-textarea
                name="input-7-1"
                label="Default style"
                value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                hint="Hint text"
              ></v-textarea>
            </v-col>
          </v-row>
        </v-container>
        <small>*indicates required field</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <inertia-link
          as="v-btn"
          :href="route('admin.account')"
          color="blue darken-1"
          text
          >Cancel
        </inertia-link>
        <v-btn color="blue darken-1" text> Save </v-btn>
      </v-card-actions>
    </v-card>
  </admin-layout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";

export default {
  components: {
    AdminLayout,
  },
  props: ["account", "roles"],
};
</script>
