<template>
  <v-app id="inspire">
    <v-main>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card max-width="340px" class="mx-auto" outlined>
              <v-form @submit.prevent="submit">
                <v-card-title style="margin-top: -36px">
                  <v-row justify="center">
                    <v-btn fab x-large depressed :href="route('welcome')">
                      <v-avatar color="white" size="72">
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
                    </v-btn>
                  </v-row>
                </v-card-title>

                <v-card-text>
                  <v-text-field
                    placeholder="Name"
                    id="name"
                    type="name"
                    v-model="form.name"
                    autofocus
                    required
                    :error-messages="form.errors.name ? form.errors.name : []"
                  />
                  <v-text-field
                    placeholder="E-mail"
                    id="email"
                    type="email"
                    v-model="form.email"
                    autofocus
                    required
                    :error-messages="form.errors.email ? form.errors.email : []"
                  />
                  <v-text-field
                    placeholder="New-Password"
                    id="password"
                    type="password"
                    v-model="form.password"
                    ref="username"
                    required
                    :error-messages="
                      form.errors.password ? form.errors.password : []
                    "
                  />
                  <v-text-field
                    placeholder="New-Password"
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    ref="username"
                    required
                    :error-messages="
                      form.errors.password_confirmation
                        ? form.errors.password_confirmation
                        : []
                    "
                  />
                </v-card-text>

                <v-card-text>
                  <v-list-item class="grow px-0">
                    <a :href="route('login')" class="link"
                      >Already registered?</a
                    >

                    <v-row align="center" justify="end" class="pr-3">
                      <v-btn
                        type="submit"
                        class="mt-2 mb-1"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        color="primary"
                        depressed
                        rounded
                      >
                        LOGIN
                      </v-btn>
                    </v-row>
                  </v-list-item>
                </v-card-text>
              </v-form>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
