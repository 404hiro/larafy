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
      <v-form @submit.prevent="submit">
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="Name"
                  required
                  v-model="form.name"
                  :error-messages="form.errors.name ? form.errors.name : []"
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="Title"
                  v-model="form.title"
                  hint="あなたを表す肩書きを書いてください。"
                  :error-messages="form.errors.title ? form.errors.title : []"
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-select
                  :items="roles"
                  v-model="form.role"
                  label="Role"
                  item-text="title"
                  item-value="role"
                  :error-messages="form.errors.role ? form.errors.role : []"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="Email*"
                  required
                  v-model="form.email"
                  :error-messages="form.errors.email ? form.errors.email : []"
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-textarea
                  name="input-7-1"
                  label="Default style"
                  :error-messages="form.errors.bio ? form.errors.bio : []"
                  v-model="form.bio"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
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
          <v-btn
            color="blue darken-1"
            text
            type="submit"
            :disabled="form.processing"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-form>
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
  data() {
    return {
      form: this.$inertia.form({
        _method: "POST",
        name: this.account.name,
        email: this.account.email,
        title: this.account.title,
        bio: this.account.bio,
        role: this.account.role,
      }),
    };
  },
  methods: {
    submit() {
      //ログイン処理
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(route("admin.account.update", { id: this.account.id }), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
};
</script>
