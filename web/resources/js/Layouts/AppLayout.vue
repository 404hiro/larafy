<template>
  <v-app id="inspire">
    <v-app-bar app color="white" flat dense>
      <v-container class="py-0 fill-height">
        <inertia-link as="v-btn" small fab depressed :href="route('welcome')">
          <v-avatar color="white" size="40">
            <svg
              viewBox="0 0 48 48"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z"
                fill="#6875F5"
              />
              <path
                d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z"
                fill="#6875F5"
              />
            </svg>
          </v-avatar>
        </inertia-link>
        <inertia-link :href="route('dashboard')" as="v-btn" text class="ml-2">
          Dahsboard
        </inertia-link>

        <v-spacer></v-spacer>
        <v-menu
          bottom
          left
          max-width="200px"
          rounded
          offset-y
          v-if="$page.props.user"
        >
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
                  <v-list-item-subtitle
                    >Founder of Vuetify</v-list-item-subtitle
                  >
                </v-list-item-content>
              </v-list-item>
              <inertia-link as="v-list-item" :href="route('profile.show')">
                <v-list-item-title> Profile</v-list-item-title>
              </inertia-link>
              <v-list-item @click="logout">
                <v-list-item-title> Logout </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-card>
        </v-menu>
        <template v-else>
          <inertia-link as="v-btn" outlined :href="route('register')">
            Register
          </inertia-link>
          <inertia-link as="v-btn" text class="ml-1" :href="route('login')">
            Login
          </inertia-link>
        </template>
      </v-container>
    </v-app-bar>
    <v-main class="grey lighten-3">
      <v-container>
        <slot></slot>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
};
</script>
