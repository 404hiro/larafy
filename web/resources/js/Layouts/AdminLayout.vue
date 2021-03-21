<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app　mobile-breakpoint="960">
      <v-list height="48" class="text-center py-0">
        <v-list-item link>
          <v-list-item-content>
            <v-list-item-title><h2>Dashboard</h2></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-divider></v-divider>
      <list-link :subheader="'ユーザー管理'" :items="account_menu" />
      <list-link :subheader="'システム管理'" :items="system_menu" />
    </v-navigation-drawer>

    <v-app-bar app color="#6777ef" flat dark dense class="mx-0">
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Laravel</v-toolbar-title>

      <v-spacer></v-spacer>
      <v-menu bottom left max-width="200px" rounded offset-y>
        <template v-slot:activator="{ on }">
          <v-btn fab small v-on="on" depressed>
            <v-avatar color="brown" size="40">
              <img
                :src="$page.props.user.profile_photo_url"
                :alt="$page.props.user.name"
              />
            </v-avatar>
          </v-btn>
        </template>
        <v-card min-width="150px">
          <v-list dense>
            <v-list-item>
              <v-list-item-avatar>
                <img
                  :src="$page.props.user.profile_photo_url"
                  :alt="$page.props.user.name"
                />
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>{{
                  $page.props.user.name
                }}</v-list-item-title>
                <v-list-item-subtitle>Founder of Vuetify</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <inertia-link
              as="v-list-item"
              v-if="($page.props.user.role = 1)"
              :href="route('admin')"
            >
              <v-list-item-title> Admin</v-list-item-title>
            </inertia-link>
            <inertia-link as="v-list-item" :href="route('profile.show')">
              <v-list-item-title> Profile</v-list-item-title>
            </inertia-link>
            <v-list-item @click="logout">
              <v-list-item-title> Logout </v-list-item-title>
            </v-list-item>
          </v-list>
        </v-card>
      </v-menu>
    </v-app-bar>
    <v-main class="grey lighten-3">
      <v-sheet color="#6777ef" flat height="40" width="100%" app></v-sheet>
      <v-container>
        <v-card
          style="margin-top: -44px"
          v-if="$slots.header"
          class="mb-5"
          flat
        >
          <v-toolbar flat>
            <slot name="header"></slot>
          </v-toolbar>
        </v-card>
        <slot></slot>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import ListLink from "@/components/ListLink";
export default {
  components: {
    ListLink,
  },
  data: () => ({
    drawer: null,
    account_menu: [
      {
        title: "Accounts",
        icon: "mdi-account-group",
        link: "admin.account",
      },
      {
        title: "Roles",
        icon: "mdi-card-account-details",
        link: "admin.log",
      },
    ],
    system_menu: [
      {
        title: "Logs",
        icon: "mdi-math-log",
        link: "admin.log",
      },
    ],
    right: null,
  }),

  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
};
</script>
