<template>
  <app-layout>
    <v-row>
      <v-col cols="3">
        <v-card ref="card" flat class="mb-3" color="rgba(0,0,255,0)">
          <v-card-text>
            <div class="layout ma-0 align-center column">
              <v-avatar size="96" color="primary">
                <img
                  src="https://cdn.vuetifyjs.com/images/john.png"
                  alt="name"
                />
              </v-avatar>
              <div class="flex text-sm-center">
                <v-list-item-title class="text-h6">
                  John Leider
                </v-list-item-title>
                <v-list-item-subtitle>john@vuetifyjs.com</v-list-item-subtitle>
              </div>
            </div>
          </v-card-text>
        </v-card>

        <home-menu />
      </v-col>
      <v-col cols="9">
        <v-card color="rgba(0,0,255,0)" flat class="mb-2">
          <v-tabs background-color="rgba(0,0,255,0)">
            <v-tab>アカウント</v-tab>
            <v-tab>プロフィール</v-tab>
          </v-tabs>
        </v-card>
        <v-card class="mx-auto" flat>
          <v-card-title>
            <v-icon large left> mdi-twitter </v-icon>
            <span class="text-h6 font-weight-light">Twitter</span>
          </v-card-title>

          <v-card-text class="text-h5 font-weight-bold">
            <div></div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import DeleteUserForm from "@/Pages/Profile/DeleteUserForm";
import HomeMenu from "@/Components/HomeMenu";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/LogoutOtherBrowserSessionsForm";
import TwoFactorAuthenticationForm from "@/Pages/Profile/TwoFactorAuthenticationForm";
import UpdatePasswordForm from "@/Pages/Profile/UpdatePasswordForm";
import UpdateProfileInformationForm from "@/Pages/Profile/UpdateProfileInformationForm";

export default {
  components: {
    AppLayout,
    HomeMenu,
    DeleteUserForm,
    JetSectionBorder,
    LogoutOtherBrowserSessionsForm,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  },
  props: ["sessions"],
  data: () => ({}),
};
</script>
